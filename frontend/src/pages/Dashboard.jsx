/*
* inbuilt / framework imports
* */
import React, {Suspense, lazy, useState, useEffect} from "react";

/*
* Loading Components
* */
import Navigation from "../components/Navigation.jsx";
import Loading from "./loading.jsx";

/*
* loading api connection classes
* */
import AuctionItemService from "../api/AuctionItemService.js";


/*
* Importing Third part libraries
* */
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  BarElement,
  Title,
  Tooltip,
  Legend,
  ArcElement
} from 'chart.js';
import {Bar, Doughnut} from 'react-chartjs-2';

ChartJS.register(
    CategoryScale,
    LinearScale,
    BarElement,
    Title,
    Tooltip,
    Legend,
    ArcElement
);

const Colors = {
  Background: [
    'rgba(255, 99, 132, 0.2)',
    'rgba(54, 162, 235, 0.2)',
    'rgba(255, 206, 86, 0.2)',
    'rgba(75, 192, 192, 0.2)',
    'rgba(153, 102, 255, 0.2)',
    'rgba(255, 159, 64, 0.2)',
    'rgba(255, 99, 132, 0.2)',
    'rgba(54, 162, 235, 0.2)',
    'rgba(255, 206, 86, 0.2)',
    'rgba(75, 192, 192, 0.2)',
    'rgba(153, 102, 255, 0.2)',
    'rgba(255, 159, 64, 0.2)',
  ],
  Border: [
    'rgba(255, 99, 132, 1)',
    'rgba(54, 162, 235, 1)',
    'rgba(255, 206, 86, 1)',
    'rgba(75, 192, 192, 1)',
    'rgba(153, 102, 255, 1)',
    'rgba(255, 159, 64, 1)',
    'rgba(255, 99, 132, 1)',
    'rgba(54, 162, 235, 1)',
    'rgba(255, 206, 86, 1)',
    'rgba(75, 192, 192, 1)',
    'rgba(153, 102, 255, 1)',
    'rgba(255, 159, 64, 1)',
  ]
}

const Dashboard = (props) => {
// creating instance of class to connect with api
  const auctionItemService = new AuctionItemService();

  // Getting data from server
  const [Data, setData] = useState([])

  useEffect(() => {
    // getting data form api server
    auctionItemService.GetData()
        .then((result) => {
          setData(result)
        })
  }, [Data.length])



  let OverallTotalPreTax = 0;
  let OverallTaxAmount = 0;

  let amountPerDay = {};
  let amountPerCategory = {};
  let amountPerCondition = {};

  let labels;
  let values;

  /**
   * Sorting data for
   * Total Amount per day in graph &
   * Overall Total Per Category
   * Overall Total Per Condition
   * */

  // wrapping loop with try and catch to
  // catch errors while data still loading
  try {
    // looping through data
    // to sort
    Data.forEach(item => {

      // If amount of current DATE is not present
      // create one and assign 0
      if (!amountPerDay[item.date]) {
        amountPerDay[item.date] = 0;
      }
      // If amount of current CATEGORY is not present
      // create one and assign 0
      if (!amountPerCategory[item.category]) {
        amountPerCategory[item.category] = 0;
      }
      // If amount of current Condition is not present
      // create one and assign 0
      if (!amountPerCondition[item.lotCondition]) {
        amountPerCondition[item.lotCondition] = 0;
      }

      // Add Pre Tax amount to all the filters
      OverallTotalPreTax += parseFloat(item.preTaxAmount); // adding to overall total pre tax
      OverallTaxAmount += parseFloat(item.taxAmount); // adding to overall tax amount
      amountPerDay[item.date] += item.preTaxAmount;
      amountPerCategory[item.category] += parseFloat(item.preTaxAmount);
      amountPerCondition[item.lotCondition] += parseFloat(item.preTaxAmount);

    })
  } catch (e) {}
  // Format data for the Amount Per Day Bar Chart
  labels = Object.keys(amountPerDay);
  values = Object.values(amountPerDay);

  const PerDayData = {
    labels,
    datasets: [
      {
        label: "",
        data: values,
        backgroundColor: Colors.Background,
        borderColor: Colors.Border,
        borderWidth: 1,
      },
    ]
  }

  // Format data for the Amount Per Category
  labels = Object.keys(amountPerCategory)
  values = Object.values(amountPerCategory)

  const PerCategoryData = {
    labels: labels,
    datasets: [
      {
        label: 'amount',
        data: values,
        backgroundColor: Colors.Background,
        borderColor: Colors.Border,
        borderWidth: 1,
      }
    ]
  }

  // Format data for the Amount Per Category
  labels = Object.keys(amountPerCondition)
  values = Object.values(amountPerCondition)

  const PerConditionData = {
    labels: labels,
    datasets: [
      {
        label: "amount",
        data: values,
        backgroundColor: Colors.Background,
        borderColor: Colors.Border,
        borderWidth: 1,
      }
    ]
  }


  const options = {
    responsive: true,
    plugins: {
      legend: {
        display: false
      },
      title: {
        display: false
      }
    }
  }

  return <Suspense fallback={<Loading />}>
    <div className={"main container"}>

      {/*TODO: props list for components to add in navigation*/}
      <Navigation
          Left={["pageName"]}
          Right={["addData"]}
      />
      <div id={"dashboard"}>
        <div className={"top-half center-child"}>
          <Bar className={"bar-graph"} data={PerDayData} options={options} />
        </div>

        <div className={"bottom-half"}>
          <div>
            <dl>
              <dt><h2>Total Pre-tax Amount</h2></dt>
              <dd><p>{parseFloat(OverallTotalPreTax).toFixed(2)}</p></dd>

              <dt><h2>Total Tax Amount</h2></dt>
              <dd><p>{parseFloat(OverallTaxAmount).toFixed(2)}</p></dd>
            </dl>
          </div>

          <div className={"donuts"}>
            <Doughnut className={"pie-chart"} data={PerConditionData} />
            <Doughnut className={"pie-chart"} data={PerCategoryData} />
          </div>
        </div>
      </div>
    </div>
  </Suspense>
}


export default Dashboard;
