import React, { useState, useEffect } from 'react'
import {BarChart, Bar, XAxis, YAxis, CartesianGrid, Tooltip, Legend, PieChart, Pie, Sector, ResponsiveContainer, Cell} from 'recharts';
import Card from '../Card/Card';
import './Chart.scss'

const Chart = ({chartData}) => {
    //bar graph - total amount(pre tax) per day
    //pie chart - total amount(pre tax) per category
    //pie chart - total per condition

    const [data, setData] = useState([])
    const [categoryData, setCategoryData] = useState([]);
    const [conditionData, setConditionData] = useState([]);
    
    //creates and sets data for Category based pie chart
    //loops through data and sums all pre-tax totals based on category
    const updateCategoryAmount = () => {
        const tempCategoryA = [];
        const tempCategoryB = [];

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

        setCategoryData(tempCategoryB);

    }

    //creates and sets data for condition based pie chart
    //loops through data and sums all pre-tax total based on lot_condition.
    const updateConditionAmount = () => {
        const tempConditionA = [];
        const tempConditionB = [];

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

    }

    //sets new data whenever chartData prop updates
    useEffect(()=>{
        setData(chartData);

        updateCategoryAmount();
        updateConditionAmount();
        
    },[chartData])

    //https://recharts.org/en-US/examples/PieChartWithCustomizedLabel
    const COLORS = ['#bd93f9', '#ff79c6', '#ffb86c', '#50fa7b', '#8be9fd', '#f1fa8c','#ff5555','#6272a4','#f8f8f2','#282a36'];
    const RADIAN = Math.PI / 180;
    const renderCustomizedLabel = ({ cx, cy, midAngle, innerRadius, outerRadius, percent, index }) => {
        const radius = innerRadius + (outerRadius - innerRadius) * 0.5;
        const x = cx + radius * Math.cos(-midAngle * RADIAN);
        const y = cy + radius * Math.sin(-midAngle * RADIAN);

        return (
            <text x={x} y={y} fill="#44475a" textAnchor={x > cx ? 'start' : 'end'} dominantBaseline="central">
                {`${(percent * 100).toFixed(0)}%`}
            </text>
        );
    };

  return (
    <div>
        <Card>
            <ResponsiveContainer width={'99%'} height={400}>
                <BarChart
                data={data}
                >
                    <CartesianGrid strokeDasharray="3 3" />
                    <XAxis dataKey={"date"} tick={{fill: "#6272a4"}} tickLine={{stroke: "#6272a4"}}/>
                    <YAxis tick={{fill: "#6272a4"}} tickLine={{stroke: "#6272a4"}}/>
                    <Tooltip cursor={{fill: 'transparent'}} />
                    <Legend />
                    <Bar name="Total Pre-Tax Amount" dataKey={"pre_tax_amount"} fill="#bd93f9" />
                </BarChart>
            </ResponsiveContainer>
        </Card>

        <div className='pie-container'>
            <Card>
                <h3>Total Amount(Pre Tax) Per Category</h3>
                <ResponsiveContainer width={'99%'} height={250} className="text-center pie-chart">
                    <PieChart>
                        <Legend verticalAlign="bottom" align="center" />
                        <Pie
                            data={categoryData}
                            cx="50%"
                            cy="50%"
                            labelLine={true}
                            label
                            outerRadius={'90%'}
                            fill="#8884d8"
                            dataKey="value"
                        >
                            {categoryData.map((entry, index) => (
                                <Cell key={`cell-${index}`} fill={COLORS[index % COLORS.length]} />
                            ))}
                        </Pie>
                    </PieChart>
                </ResponsiveContainer>
            </Card>

            <Card>
                <h3>Total Amount(Pre Tax) Per Condition</h3>
                <ResponsiveContainer width={'99%'} height={250} className="text-center pie-chart">
                    <PieChart >
                        <Legend className="legend" verticalAlign="bottom" align="center"/>
                        <Pie
                            data={conditionData}
                            cx="50%"
                            cy="50%"
                            labelLine={true}
                            label
                            outerRadius={'90%'}
                            fill="#8884d8"
                            dataKey="value"
                        >
                            {conditionData.map((entry, index) => (
                                <Cell key={`cell-${index}`} fill={COLORS[index % COLORS.length]} />
                            ))}
                        </Pie>
                    </PieChart>
                </ResponsiveContainer>
            </Card>
        </div>
        
        
    </div>
    
  )
}

export default Chart