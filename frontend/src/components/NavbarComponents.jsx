/*
* inbuilt / framework imports
* */
import React, {useEffect, useState} from "react";
import { useLocation } from "react-router-dom";

/*
* Third party components
* OPEN SOURCE
* */
import { PlusOutlined, UploadOutlined } from '@ant-design/icons';

/*
* Theme class to change theme
* */
import Theme from "../utils/Theme.js";

/*
* loading api connection classes
* */
import AuctionItemService from "../api/AuctionItemService.js";


export const SearchBar = (props) => {

  /**
   * Filters Data sing Regex
   * @return Array
   * @returns Filtered Data
   * */
  const FilterData = (searchValue) => {
    let filter_list = []
    let pattern = new RegExp(searchValue, 'i')

    for (const element of props.data) {
      let values = Object.values(element)
      values = values.toString();

      /*
      * Using regex to filter down the list
      * */
      if (values.toLowerCase().match(pattern)) {
        filter_list.push(element);
      }
    }
    return filter_list;
  }

  /*
  * Function triggers everytime input changes
  * */
  const InputChange = (e) => {
    props.filter(FilterData(e.target.value));
  }

  return <div className={"search-bar"}>
    <input
        type={"text"}
        placeholder={"search..."}
        onChange={InputChange}
    />
  </div>
}

export const AddData = (props) => {
  // creating instance of class to connect with api
  const auctionItemService = new AuctionItemService();

  /*
  * Variables to store file Information
  * */
  // Mimic the file object
  // So it will not throw error
  const [FileSelected, setFileSelected] = useState({name: ""});
  const [FileContent, setFileContent] = useState("");

  /*
  * State variable for managing
  * display and errors of add Data
  * */
  const [isActive, setActive] = useState(false);
  const [Error, setError] = useState("");

  /*
  * Reset File
  * TO upload new one
  * */

  const Reset = () => {
    setFileSelected({name: ""})
    setFileContent("")
    setError("");
  }

  /* Creating instance of file reader
  *  To Read file*/
  let reader = new FileReader();
  reader.onload = function (ev) {
    setFileContent(ev.target.result.toString());
  }

  const uploadFile = (input) => {
    reader.readAsText(input.target.files[0]);
    setFileSelected(input.target.files[0]);

    // Checking File for errors // if it is csv or not
    let fileName = input.target.files[0].name;
    fileName = fileName.substring(fileName.lastIndexOf("."))

    if (fileName !== ".csv") {
      setError("Please upload csv file")
    }
  }

  const sendDataToServer = () => {
    setActive(false);
    auctionItemService.UploadData(FileContent)
        .then((result) => {
          console.log(result);
          if (!result) {
            // if error
            setError("Something went wrong")
          } else {
            Reset();
          }
          location.reload();
        })
  }

  return <div>
    <button
        className={"primary add-data"}
        onClick={()=>{
          setActive((prevState)=>!prevState);
        }}
    >
      <PlusOutlined />
    </button>

    <div className={`add-data center-child ${isActive ? "active": ""}`}>
      <button
          className={"background-close-button"}
          onClick={()=>{
            setActive(false);
          }}
      >
      </button>
        <div className={`${FileContent === "" ? "upload" : "uploaded"} center-child`}>
          <div className={"controls"}>
            <button
                onClick={()=>{
                  setActive((prevState)=>!prevState);
                }}
            >x</button>
          </div>

          <label className={"center-child upload"}>
            <input
                type={"file"}
                onChange={uploadFile}
            />

            <UploadOutlined className={"icon"} />
            <p>Select or Drag and Drop file</p>
          </label>

          <div className={"center-child uploaded"}>
            <p>File Selected: <strong>{FileSelected.name}</strong></p>
            <p className={"danger"}>{Error}</p>

            <div className={"content"}>
              <code>
                {FileContent}
              </code>
            </div>


            <div className={"main-controls"}>
              {/*TODO: upload data to server, create spinner*/}
              <button
                  disabled={Error !== ""}
                  onClick={sendDataToServer}
              ><p>Continue, Upload</p></button>
              <button
                  className={"danger"}
                  onClick={Reset}
              ><p>Cancel, Upload Another</p></button>
            </div>

          </div>
        </div>
    </div>
  </div>
}

export const DisplayPageName = (props) => {
  let location = useLocation().pathname;
  location = location.substring(1);
  if (location === "") {
    location = "dashboard"
  }
  return <>
    <h2 key={location} className={"display-page-name"}>{location}</h2>
  </>
}

export const ThemeSwitch = (props) => {
  let theme = new Theme();
  let currentTheme = theme.DetectWindowTheme();

  const [isDarkMode, setDarkMode] = useState(currentTheme === "dark")

  useEffect(() => {
    theme.ChangeWindowTheme(isDarkMode ? "dark" : "light");
  }, [isDarkMode])

  return <>
    <button
        className={`theme-switch ${isDarkMode ? "active" : ""}`}
        onClick={()=>{setDarkMode((prevState)=>!prevState)}}
    >
      <div>
        <div></div>
      </div>
    </button>
  </>
}