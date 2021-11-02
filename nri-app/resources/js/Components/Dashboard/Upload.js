import React, { useEffect, useState } from "react";
import { FileUploader } from "react-drag-drop-files";
import axios from "axios";

import BarChart from "./BarChart";
import PieChart from "./PieChart";
import MessageBar from "./MessageBar";

import "./styles.css";

export default function Upload(props) {
  const [barData, setBarData] = useState(null);
  const [cateData, setCateData] = useState(null);
  const [condData, setCondData] = useState(null);
  const [newData, setNewData] = useState(false);

  useEffect(() => {
    axios.get('/fetch_data').then(response => {      
      const { data } = response;
      if (data.status === "ok") {
        const { amt_date, amt_category, amt_condition } = data.result;
        setBarData(amt_date);
        setCateData(amt_category);
        setCondData(amt_condition);
      }

    })
  }, [newData]);

  const handleChange = async (file) => {
    const formData = new FormData();
    formData.append("file", file);
    const response = await axios.post("/api/upload", formData);
    if (response.data.status === "ok") {
      setNewData(!newData);
    }
  }

  return <div className="py-12">
    <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div className="md:p-6 bg-white border-b border-gray-200">
          <FileUploader name="file" handleChange={handleChange} type={["csv"]} />
        </div>
        <div className="p-6 bg-white border-b border-gray-200 ">
          {barData && <BarChart data={barData} />}
          {!barData && <MessageBar lbl="You haven't uploaded any data file." />}
        </div>
        <div className="p-6 bg-white border-b border-gray-200 grid sm:gap-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
          {cateData && <PieChart data={cateData} label="the overall total (pre tax amount) per category" />}
          {condData && <PieChart data={condData} label="the overall total (pre tax amount) per condition" />}
        </div>
      </div>
    </div>
  </div>
}