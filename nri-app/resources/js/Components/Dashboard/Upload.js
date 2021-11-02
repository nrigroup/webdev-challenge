import React, { useEffect, useState } from "react";
import { FileUploader } from "react-drag-drop-files";
import axios from "axios";

import BarChart from "./BarChart";
import PieChart from "./PieChart";
import MessageBar from "./MessageBar";

import "./styles.css";

export default function Upload(props) {
  const [errMsg, setErrMsg] = useState(null);

  const [barData, setBarData] = useState(null);
  const [cateData, setCateData] = useState(null);
  const [condData, setCondData] = useState(null);
  const [newData, setNewData] = useState(false);

  useEffect(() => {
    axios.get('/api/fetch_data').then(response => {
      const { data } = response;
      if (data.status === "ok") {
        const { amt_date, amt_category, amt_condition } = data.result;
        setBarData(amt_date);
        setCateData(amt_category);
        setCondData(amt_condition);
        setErrMsg(null);
      } else {
        setErrMsg(data.result);
      }
    })
  }, [newData]);

  const handleChange = async (file) => {
    const formData = new FormData();
    formData.append("file", file);
    const response = await axios.post("/api/upload", formData);
    const {status, result} = response.data;
    if (status === "ok") {
      setNewData(!newData);
      setErrMsg(null);
    } else if (status === "error") {
      setErrMsg(result);
    }
  }

  return <div className="py-12">
    {errMsg && <div role="alert" className="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-2">
      <div className="bg-red-500 text-white font-bold rounded-t px-4 py-2">
        Oops ...
      </div>
      <div className="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
        <p>{errMsg}</p>
      </div>
    </div>}
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