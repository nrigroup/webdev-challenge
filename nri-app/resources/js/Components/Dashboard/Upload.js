import React, { memo, useEffect, useState } from "react";
import { FileUploader } from "react-drag-drop-files";
import axios from "axios";
import { Bar } from "react-chartjs-2";

const options = {
  // scales: {
  //   yAxes: [
  //     {
  //       ticks: {
  //         beginAtZero: true,
  //       },
  //     },
  //   ],
  // },
};

export default function Upload(props) {
  const [data, setData] = useState(null);  

  useEffect(() => {
    axios.get('/fetch_data').then(response => {
      console.log(response);
      setData({
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [
          {
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)',
            ],
            borderColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
            ],
            borderWidth: 1,
          },
        ],
      });
    })
  }, []);

  const handleChange = async (file) => {
    const formData = new FormData();
    formData.append("file", file);
    const response = await axios.post("/upload", formData);
    console.log(response);
  }

  return <div className="py-12">
    <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div className="p-6 bg-white border-b border-gray-200">
          <FileUploader name="file" handleChange={handleChange} type={["csv"]} />
        </div>        
        <div className="p-6 bg-white border-b border-gray-200">
          {data && <Bar data={data} options={options} />}
        </div>
      </div>
    </div>
  </div>
}