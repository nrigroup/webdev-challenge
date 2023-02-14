import React, { useState, useEffect } from 'react'
import {BarChart, Bar, XAxis, YAxis, CartesianGrid, Tooltip, Legend, PieChart, Pie, Sector, ResponsiveContainer} from 'recharts';

const Chart = ({chartData}) => {
    
    //bar graph - total amount(pre tax) per day
    //pie chart - total amount(pre tax) per category
    //pie chart - total per condition

    const [data, setData] = useState([])
    const [categoryData, setCategoryData] = useState([]);
    const [conditionData, setConditionData] = useState([]);
    
    //creates data for Category based pie chart
    const updateCategoryAmount = () => {
        const tempCategoryA = [];
        const tempCategoryB = [];

        //loops through data and sums all pre-tax total based on category.
        //creates an unlabled JSON object in tempCategoryA
        //format=category: pre-tax total"
        chartData.forEach(e => tempCategoryA[e.category] ? tempCategoryA[e.category] += +e.pre_tax_amount : tempCategoryA[e.category] = +e.pre_tax_amount); 
        
        //loops through the unlabed object and creates a new labelled JSON object in tempCategoryB
        for(var key in tempCategoryA) {
            const CategoryAmount = {
                "name": key,
                "value": tempCategoryA[key]
            }
            tempCategoryB.push(CategoryAmount);
        }

        //sets conditionalData to tempConditionB object
        setCategoryData(tempCategoryB);

        // console.log(categoryData);
    }

    //creates data for condition based pie chart
    const updateConditionAmount = () => {
        const tempConditionA = [];
        const tempConditionB = [];

        //loops through data and sums all pre-tax total based on lot_condition.
        //creates an unlabled JSON object in tempConditionA 
        //format = lot_condition: pre-tax total
        chartData.forEach(e => tempConditionA[e.lot_condition] ? tempConditionA[e.lot_condition] += +e.pre_tax_amount : tempConditionA[e.lot_condition] = +e.pre_tax_amount); 
        
        //loops through the unlabed object and creates a new labelled JSON object in tempConditionB
        for(var key in tempConditionA) {
            const ConditionAmount = {
                "name": key,
                "value": tempConditionA[key]
            }
            tempConditionB.push(ConditionAmount);
        }
        
        //sets conditionalData to tempConditionB object
        setConditionData(tempConditionB);

        // console.log(conditionData);
    }

    //sets new data whenever chartData prop updates
    useEffect(()=>{
        setData(chartData);

        updateCategoryAmount();
        updateConditionAmount();
        
    },[chartData])



  return (
    <div>
        <ResponsiveContainer width={'100%'} height={400}>
            <BarChart
            data={data}
            margin={{
                top: 5,
                right: 30,
                left: 20,
                bottom: 5,
            }}
            >
                <CartesianGrid strokeDasharray="3 3" />
                <XAxis dataKey={"date"}/>
                <YAxis />
                <Tooltip cursor={{fill: 'transparent'}} />
                <Legend />
                <Bar name="Total Pre-Tax Amount" dataKey={"pre_tax_amount"} fill="#8884d8" />
            </BarChart>
        </ResponsiveContainer>

        <ResponsiveContainer width={'100%'} height={400}>
            <PieChart width={400} height={400}>
                <Pie data={categoryData} dataKey={"value"} cx="50%" cy="50%" outerRadius={90} fill="#8884d8" label />
            </PieChart>
        </ResponsiveContainer>

        <ResponsiveContainer width={'100%'} height={400}>
            <PieChart width={400} height={400}>
                <Pie data={conditionData} dataKey={"value"} cx="50%" cy="50%" outerRadius={90} fill="#8884d8" label />
            </PieChart>
        </ResponsiveContainer>
    </div>
    
  )
}

export default Chart