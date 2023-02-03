/*
* inbuilt / framework imports
* */
import { useState } from "react";
import { Link, NavLink } from "react-router-dom";

/*
* Third party components
* OPEN SOURCE
* */
import { HomeOutlined, HomeFilled, SettingOutlined, SettingFilled, DatabaseOutlined, DatabaseFilled } from '@ant-design/icons';

/*
* Importing Navigation Components
* */
import {DisplayPageName, AddData, ThemeSwitch, SearchBar} from "./NavbarComponents";

/**
 * Navigation TopBar
 * Changes According to props given
 *
 * ---can be customizable in future update---
 *
 * props "Left" include what component to display on left side
 * props "Right" include what component to display on right side
 * */
const Navigation = (props) => {
  return <div className={"TopBar Navigation"}>
    <div className={"left container"}>
      <NavElements elementList={props.Left} {...props} />
    </div>
    <div className={"right container"}>
      <NavElements elementList={props.Right} {...props} />
    </div>
  </div>
}

/**
 * for looping through props.elementList
 * and returning list with elements added in it
 * */
const NavElements = (props) => {
  let result = [];

  /*
  * Using for loop to maintain order of elements
  * */
  for (const Element of props.elementList) {
    if (Element === "pageName") {
      result.push(<DisplayPageName key={Element} {...props}/>);
    }
    if (Element === "addData") {
      result.push(<AddData key={Element} {...props} />)
    }
    if (Element === "searchBar") {
      result.push(<SearchBar key={Element} {...props}/>)
    }
  }
  return result;
}


/**
 * `SideBar`
 * Provides user navigation across Website
 * with "NavLink" from react-router-dom
 * */
export const SideBar = () => {
  const [isExpandNavigation, setExpandNavigation] = useState(false);

  return <div className={`SideBar Navigation ${isExpandNavigation ? "expand" : ""}`}>
    <div className={"buttons container"}>
      <button
          className={"hamburger"}
          onClick={()=>{
            setExpandNavigation((prevState)=>!prevState);
          }}
      >
        <div></div>
        <div></div>
        <div></div>
      </button>

      <div>
        <NavLink to={"/"}>
          <HomeOutlined className={"icon"} />
          <HomeFilled className={"active-icon"} />
          <span className={"text"}>
            Dashboard
          </span>
        </NavLink>

        <NavLink to={"/data"}>
          <DatabaseOutlined className={"icon"} />
          <DatabaseFilled className={"active-icon"} />
          <span className={"text"}>

            Table
          </span>
        </NavLink>
      </div>
    </div>

    {/*Only display if implimemt settings*/}
    {/*<NavLink to={"/settings"}>
      <SettingOutlined className={"icon"} />
      <SettingFilled className={"active-icon"} />

      <span className={"text"}>
        Settings
      </span>
    </NavLink>*/}
  </div>
}



export default Navigation;

