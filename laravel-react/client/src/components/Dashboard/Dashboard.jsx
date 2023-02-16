import React, { useState } from 'react'
import Chart from '../Charts/Chart'
import Footer from '../Footer/Footer'
import Upload from '../Upload/Upload'

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
        <Footer/>
    </div>
  )
}

export default Dashboard