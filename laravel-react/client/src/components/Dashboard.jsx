import React, { useState } from 'react'
import Chart from './Chart'
import Upload from './Upload'

//dashboard components acts as a warper for all other components.
const Dashboard = () => {

    //state used to take data from upload component to be used elsewhere 
    const [chartData, setChartData] = useState([])

  return (
    <div>
        <div>
            <Upload setChartData={setChartData}/>
        </div>
        <div>
            <Chart chartData={chartData}/>
        </div>
    </div>
  )
}

export default Dashboard