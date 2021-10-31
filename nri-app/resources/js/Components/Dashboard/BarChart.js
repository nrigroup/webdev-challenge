import React, { useMemo } from "react";
import { Bar } from "react-chartjs-2";
import { scaleLinear, scaleLog } from "d3-scale";

const BarChart = (props) => {

  const barData = useMemo(() => {
    const { data } = props;
    const amt_date_lbl = Object.keys(data);
    const amt_date_val = Object.values(data);
    const amt_date_len = amt_date_lbl.length;

    const lineScale = scaleLog();
    console.log(amt_date_val.map(val => lineScale(val)));

    return {
      data: {
        labels: amt_date_lbl,
        datasets: [
          {
            label: 'total amount (pre tax amount) per day',
            data: amt_date_val.map(val => lineScale(val)),
            backgroundColor: Array(amt_date_len).fill('rgba(54, 162, 235, 0.2)'),
            borderColor: Array(amt_date_len).fill('rgba(54, 162, 235, 1)'),
            borderWidth: 1,
          },
        ],
      },
      options: {
        scales: {
          y: {
            type: "logarithmic",
            grace: "5%",
            beginAtZero: true,
            ticks: {
              callback: (value, index, values) => {
                return Math.pow(10, value);
              }
            }
          }
        },
        plugins: {
          tooltip: {            
            events: ['mousemove', 'mouseout', 'click', 'touchstart', 'touchmove'],
            callbacks: {
              label: function (tooltipItems) {                
                const {dataset: {label}, dataIndex} = tooltipItems;
                return `${label}: ${amt_date_val[dataIndex]}`;
              }
            }
          },          
        }
      }
    }
  }, [props.data]);

  return <div className="p-6 bg-white border-b border-gray-200">
    <Bar data={barData.data} options={barData.options} />
  </div>
}

export default BarChart;