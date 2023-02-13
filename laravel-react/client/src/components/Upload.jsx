import React, {useState} from 'react'
import { useCSVReader } from 'react-papaparse'
import axios from 'axios';
import axiosClient from '../axios-client'

const Upload = () => {
    const [data, setData] = useState({})

    const Submit = () => {
        const payload = data;
        console.log(payload);
        axios({
            url:'http://127.0.0.1:8000/api/save',
            method:'POST',
            data: JSON.stringify(payload)
        // }, {
        //     headers: {
        //       'Content-Type': 'application/x-www-form-urlencoded'
        //     }
        })
        .then(()=>{
            console.log("Data has been sent to the server");
        })
        .catch((error) => {
            console.log(error.response.data);
        });

        // axiosClient.post('/save', payload)
        // .then(()=>{
        //     console.log("Data has been sent to the server");
        // })
        // .catch(() => {
        //     console.log("Internal server error");
        // });
    }
    
    const handleLog= () => {
        console.log(data)
        data.shift();//gets rid of headers
        data.pop();//gets rid of empty last row
        //maps through and creates a new JSON object for each entry and sends it the server as a post request
        data.map((log, i) => {
        
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
            console.log(Lotlog);
            
            axios({
                url:'http://127.0.0.1:8000/api/lotlog',
                method:'POST',
                data: Lotlog
            }).then(()=>{
                console.log("Data has been sent to the server");
            })
            .catch((error) => {
                console.log(error.response.data);
            });
        })
    }

    //https://react-papaparse.js.org/docs#local-files
    const { CSVReader } = useCSVReader();

  return (
    <div>
       <CSVReader
            onUploadAccepted={(results) => {
                setData(results.data)
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