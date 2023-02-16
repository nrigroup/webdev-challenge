import React, {useState, useEffect} from 'react'
import { useCSVReader } from 'react-papaparse'
import Card from '../Card/Card';
import axios from 'axios';
import axiosClient from '../../axios-client'

import "./Upload.scss";


const Upload = ({setChartData}) => {

    const [input, setInput] = useState({});
    // const [data, setData] = useState([]);

    const [noHeaders, setNoHeaders] = useState(false);

    //clears data whenever new input is given or checkbox checked or unchecked
    // useEffect(() => {
    //     setData([]);
    // }, [input, noHeaders])

    //axios POST request to laravel server to store parsed data into SQLite DB
    const post = ( payload ) => {
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

    //takes the input and all the current indices of data
    //filters data to ensure all required fields are filled (date,category,title,location,condition,pre_tax) 
    //creates a new JSON object in the correct order with keys to be stored in DB and used for graphs 
    const sortData = (input,dateIndex,categoryIndex,titleIndex,locationIndex,conditionIndex,preTaxIndex,taxNameIndex,taxAmountIndex) => {
        const temp = [];

        input.forEach(log =>{
            let count = 0;
            for(let i of [dateIndex,categoryIndex,titleIndex,locationIndex,conditionIndex,preTaxIndex]){
                if(log[i] !== ""){
                    count++
                    if(count === 6){
                        const Lotlog = {
                            "date":log[dateIndex],
                            "category":log[categoryIndex],
                            "lot_title":log[titleIndex],
                            "lot_location":log[locationIndex],
                            "lot_condition":log[conditionIndex],
                            "pre_tax_amount":log[preTaxIndex],
                            "tax_name":log[taxNameIndex],
                            "tax_amount":log[taxAmountIndex]
                        }
                        post(Lotlog)
                        temp.push(Lotlog);
                       
                    }
                }
            }
        })  
        setChartData(temp);
    }

    //searches the first row for the indices of each header
    //shift function to remove headers from the input 
    //call sortData 
    const sortWithHeaders = (input) => {
        const dateIndex=input[0].indexOf("date");
        const categoryIndex=input[0].indexOf("category");
        const titleIndex=input[0].indexOf("lot title");
        const locationIndex=input[0].indexOf("lot location");
        const conditionIndex=input[0].indexOf("lot condition");
        const preTaxIndex=input[0].indexOf("pre-tax amount");
        const taxNameIndex=input[0].indexOf("tax name");
        const taxAmountIndex=input[0].indexOf("tax amount");

        input.shift();

        sortData(input,dateIndex,categoryIndex,titleIndex,locationIndex,conditionIndex,preTaxIndex,taxNameIndex,taxAmountIndex);
    }

    //uses regex patterns to distinguish which data type belongs to which index based on the first row
    //uses a count variable to determine the last remaining index for lot_title
    //pre_tax and tax_amount are stored in a array and uses the min and max value to determine which is which 
    //(pre_tax will always be max, tax_amount will always be min)
    //call sortData 
    const SortWithoutHeaders = (input) => {
        let dateIndex, categoryIndex, titleIndex, locationIndex, conditionIndex, preTaxIndex, taxNameIndex, taxAmountIndex
        let lastIndexCount = 28;

        const datePattern = /\d{1,2}\/\d{1,2}\/\d{4}/; // regex pattern for date in "mm/dd/yyyy" format
        const categoryPattern = /(Construction|Mining|Plastic & Rubber|Computer - Hardware|Computer-Software)/i;
        const locationPattern = /.*,/; // regex pattern for a location in the format of "123 Main St, City, State 12345"
        const conditionPattern = /(Brand New|Like Brand New|Used|For parts or not working)/i;
        const taxNamePattern = /.*(?:tax).*/i;
        const taxNumbersPattern =/^\d+(\.\d+)?$/;

        const taxNumbers = [];

        input[0].forEach(function(element,index) {
            if(taxNumbersPattern.test(element)){
                taxNumbers.push(element);
                lastIndexCount-=index;
            }
            if(datePattern.test(element)){
                dateIndex=index;
                lastIndexCount-=index;
            }
            if(categoryPattern.test(element)){
                categoryIndex=index;
                lastIndexCount-=index;
            }
            if(locationPattern.test(element)){
                locationIndex=index;
                lastIndexCount-=index;
            }
            if(conditionPattern.test(element)){
                conditionIndex=index;
                lastIndexCount-=index;
            }
            if(taxNamePattern.test(element)){
                taxNameIndex=index;
                lastIndexCount-=index;
            }

        })

        preTaxIndex = input[0].indexOf(Math.max(...taxNumbers).toString());
        taxAmountIndex = input[0].indexOf(Math.min(...taxNumbers).toString());
        
        titleIndex = lastIndexCount;
        sortData(input,dateIndex,categoryIndex,titleIndex,locationIndex,conditionIndex,preTaxIndex,taxNameIndex,taxAmountIndex);
        
    }


    //calls sortWithHeaders if checkbox is not checked
    //calls sortWithoutHeaders if checkbox is checked 
    const handleLog = () => {
        if(!noHeaders){
            sortWithHeaders(input);
            // console.log(data);
        }else{
            SortWithoutHeaders(input);
            // console.log(data);
        }
    }
   

  //papa parse used to parse csv file 
  //data is returned as unlabled JSON object and stored in the input array.
  //boilerplate code taken from 
  //https://react-papaparse.js.org/docs#local-files
  const { CSVReader } = useCSVReader();
  return (
    <div>
        <Card>
           
            <CSVReader
                onUploadAccepted={(results) => {
                    console.log(results);
                    setInput(results.data)
                }}
            >
            {({
                getRootProps,
                acceptedFile,
                ProgressBar,
                getRemoveFileProps,
            }) => (
                <>
                    <div className='upload-container'>
                        <div className='input-container'>
                            <input type="checkbox" onChange={() => {setNoHeaders(!noHeaders);console.log(noHeaders)}}/><span className='checkbox-txt'>File Has No Headers</span>
                            <br/>
                            <button type='button' {...getRootProps()} className="btn-browse">Browse file</button>
                            
                        </div>
                        <div className='file-container'>
                            <h4>File Name:</h4>
                            <div className='file-name'>
                                {acceptedFile && acceptedFile.name}
                            </div>
                        </div>
                        <div className='btn-container'>
                            <button {...getRemoveFileProps()} className="btn-remove">Remove</button> 
                            <button onClick={handleLog} className="btn-submit">Submit</button>
                        </div>
                        
                    </div>
                    <ProgressBar />
                </>
            )}
            </CSVReader>
            
        </Card>
    </div>
  )
}

export default Upload