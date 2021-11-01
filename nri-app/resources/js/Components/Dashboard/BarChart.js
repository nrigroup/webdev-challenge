import React, { useMemo, useState } from "react";
import { Bar, Chart } from "react-chartjs-2";
import { scaleLog } from "d3-scale";
import zoomPlugin from "chartjs-plugin-zoom";

Chart.register(zoomPlugin);

const BarChart = (props) => {
  console.log("Bar chart update?");
  const [currentPos, setCurrentPos] = useState(0);
  const [panDir, setPanDir] = useState(1);

  const barData = useMemo(() => {
    const { data } = props;
    const amt_date_lbl = Object.keys(data).slice(currentPos, currentPos + 5);
    const amt_date_val = Object.values(data).slice(currentPos, currentPos + 5);
    const amt_date_len = Object.values(data).length;
    const lineScale = scaleLog();

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
            domain: [0, 5]
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
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
                const { dataset: { label }, dataIndex } = tooltipItems;
                return `${label}: ${amt_date_val[dataIndex]}`;
              }
            }
          },
          zoom: {
            pan: {
              enabled: true,
              mode: "x",
              speed: 20,
              threshold: 20,
              onPanStart: ({ chart, event, point }) => {
                if (event.additionalEvent === "panleft") {
                  setPanDir(1);
                } else {
                  setPanDir(-1);
                }
              },
              onPanComplete: ({ chart }) => {
                const temp = currentPos + 5 * panDir;

                if (temp >= 0 && temp < amt_date_len) {
                  setCurrentPos(temp);
                }
              }
            },
          }
        }
      }
    }
  }, [props.data, currentPos, panDir]);

  return <div className="p-6 bg-white border-b border-gray-200">
    <Bar data={barData.data} options={barData.options} />
  </div>
}

export default BarChart;