import React, {useState} from 'react'
import { useCSVReader } from 'react-papaparse'
import axios from 'axios';
import axiosClient from '../axios-client'

const Upload = ({setChartData}) => {

    const [input, setInput] = useState({});
    const [data, setData] = useState([]);

    const [noHeaders, setNoHeaders] = useState(false);

    const headerOrder = ['date', 'category', 'lot title', 'lot location', 'lot condition', 'pre-tax amount', 'tax name', 'tax amount'];

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

    const sortWithHeaders = (input) => {
        const data = [];

        const dateIndex=input[0].indexOf("date");
        const categoryIndex=input[0].indexOf("category");
        const titleIndex=input[0].indexOf("lot title");
        const locationIndex=input[0].indexOf("lot location");
        const conditionIndex=input[0].indexOf("lot condition");
        const preTaxIndex=input[0].indexOf("pre-tax amount");
        const taxNameIndex=input[0].indexOf("tax name");
        const taxAmountIndex=input[0].indexOf("tax amount");

        input.shift();

        input.forEach(log =>{
        
            if(!log.includes("")){
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
                data.push(Lotlog);
            }
        })
            
        setData(data);
    }


    const SortInput = (input) => {

        let dateIndex;
        let categoryIndex;
        let titleIndex;
        let locationIndex;
        let conditionIndex;
        let preTaxIndex;
        let taxNameIndex;
        let taxAmountIndex;
        
        const datePattern = /\d{1,2}\/\d{1,2}\/\d{4}/; // regex pattern for date in "mm/dd/yyyy" format
        const categoryPattern = /(Construction|Mining|Plastic & Rubber|Computer - Hardware|Computer-Software)/i;
        const locationPattern = /.*,/; // regex pattern for a location in the format of "123 Main St, City, State 12345"
        const conditionPattern = /(Brand New|Like Brand New|Used|For parts or not working)/i;
        const taxNamePattern = /.*(?:tax).*/i;

        const taxNumbersPattern =/^\d+(\.\d+)?$/;
        
        // const matches = input[0].join(' ').match(taxNumbersPattern);
        // const numbers = matches.map(parseFloat);
        // console.log(numbers);

        const taxNumbers = [];
        let lastIndexCount = 28;
        input[0].forEach(function(element,index) {
            if(taxNumbersPattern.test(element)){
                taxNumbers.push(element);
                console.log(taxNumbers);
                lastIndexCount-=index;
            }
            if(datePattern.test(element)){
                console.log("date:" +index);
                dateIndex=index;
                lastIndexCount-=index;
            }
            if(categoryPattern.test(element)){
                console.log("category:" +index);
                categoryIndex=index;
                lastIndexCount-=index;
            }
            if(locationPattern.test(element)){
                console.log("location:" +index);
                locationIndex=index;
                lastIndexCount-=index;
            }
            if(conditionPattern.test(element)){
                console.log("condition:" +index);
                conditionIndex=index;
                lastIndexCount-=index;
            }
            if(taxNamePattern.test(element)){
                console.log("taxname:" +index);
                taxNameIndex=index;
                lastIndexCount-=index;
            }

        })
        const preTaxAmount = Math.max(...taxNumbers);
        const taxAmount = Math.min(...taxNumbers);
        preTaxIndex = input[0].indexOf(preTaxAmount.toString());
        console.log("pretax:"+preTaxIndex);
        taxAmountIndex = input[0].indexOf(taxAmount.toString());
        console.log("taxAmount:"+taxAmountIndex);
        titleIndex = lastIndexCount;
        

        input.forEach(log =>{
        
            if(!log.includes("")){
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
                data.push(Lotlog);
            }
        })
            
        setData(data);
    }

    const handleOnChange = () => {
        setNoHeaders(!noHeaders);
    }

    //iterates through each entry in input array and creates a labled JSON object for that entry 
    //adds the labled entry to data array and calls Post function using the current entry as its payload
    //setChartData state as data array to be used in Chart Component.
    const handleLog = () => {
        console.log(input)
        
        // sortWithHeaders(input);
        if(noHeaders){
            sortWithHeaders(input);
            console.log(data);
        }else{
            SortInput(input);
            console.log(data);
        }
        

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
                    <input type="checkbox" checked={!noHeaders} onChange={() => {setNoHeaders(!noHeaders); console.log(noHeaders)}}/>Input File has no Headers
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