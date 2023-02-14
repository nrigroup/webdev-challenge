import React, {useState} from 'react'
import { useCSVReader } from 'react-papaparse'
import axios from 'axios';
import axiosClient from '../axios-client'

const Upload = ({setChartData}) => {

    const [input, setInput] = useState({});
    const [data, setData] = useState([]);

    //axios POST request to laravel server to store parsed data into SQLite DB
    const Post = ( payload ) => {
        axios({
            url:'http://127.0.0.1:8000/api/lotlog',
            method:'POST',
            data: payload
        }).then(()=>{
            console.log("Data has been sent to the server");
        })
        .catch((error) => {
            console.log(error.response.data);
        });

    }

    //iterates through each entry in input array and creates a labled JSON object for that entry 
    //adds the labled entry to data array and calls Post function using the current entry as its payload
    //setChartData state as data array to be used in Chart Component.
    const handleLog=() => {
        console.log(data)
        input.shift();//gets rid of headers
        input.pop();//gets rid of empty last row

        //iterates through data array and creates a new labled JSON object for each entry and sends it the server as a post request
        input.forEach(log => {
            const Lotlog = {
                "date":log[0],
                "category":log[1],
                "lot_title":log[2],
                "lot_location":log[3],
                "lot_condition":log[4],
                "pre_tax_amount":log[5],
                "tax_name":log[6],
                "tax_amount":log[7]
            }
            data.push(Lotlog);
            //console.log(data);
            //Post(Lotlog);
        });

        setChartData(data);

    }
   
  //papa parse used to parse csv file 
  //data is returned as unlabled JSON object and stored in the input array.
  //boilerplate code taken from 
  //https://react-papaparse.js.org/docs#local-files
  const { CSVReader } = useCSVReader();
  return (
    <div>
       <CSVReader
            onUploadAccepted={(results) => {
                setInput(results.data)
                // console.log('---------------------------');
                // console.log(data); //only show data
                // console.log('---------------------------');
            }}
        >
        {({
            getRootProps,
            acceptedFile,
            ProgressBar,
            getRemoveFileProps,
        }) => (
            <>
                <div>
                    <button type='button' {...getRootProps()}>Browse file</button>
                    <div>
                        {acceptedFile && acceptedFile.name}
                    </div>
                    <button {...getRemoveFileProps()}>Remove</button>
                    <button onClick={handleLog}>Submit</button>
                </div>
                <ProgressBar />
            </>
        )}
        </CSVReader>
    </div>
  )
}

export default Upload