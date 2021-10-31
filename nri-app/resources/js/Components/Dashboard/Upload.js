import React, { useCallback, useEffect, useState } from "react";
import { FileUploader } from "react-drag-drop-files";
import axios from "axios";

export default function Upload(props) {
  const [file, setFile] = useState(null);

  useEffect(() => {
    axios.get('/sanctum/csrf-cookie').then(response => {
      console.log(response);
    })
  }, []);

  const handleChange = async(file) => {
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
      </div>
    </div>
  </div>
}