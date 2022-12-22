import React, { useState } from 'react';
import Papa from 'papaparse';
import { BarChart, Bar, XAxis, YAxis } from 'recharts';

function App() {
  const [data, setData] = useState(null);

  const handleFileUpload = (event) => {
    const file = event.target.files[0];

    Papa.parse(file, {
      complete: (results) => {
        setData(results.data);
      },
    });
  };

  return (
    <div className='container-fluid'>
      <div className="jumbotron">
        <h1 className='display-4'>NRI .csv visualizer</h1>
        <p className="lead">You can use this app to upload a .csv file and view its data in a bar graph📊</p>
        <hr className='my-4' />
        <p>Please use the button below to upload your .csv file</p>

      </div>
      <form>
        <div className="form-group">
        <input className='form-control btn btn-outline-success' type="file"  onChange={handleFileUpload} />
        </div>
      </form>
      <br />
      {data ? (
        <BarChart width={900} height={600} data={data.map((row) => ({ name: row[0], value: row[5] }))}>
          <XAxis tickCount={10} tickFormatter={(label) => label.substring(0, 4)} dataKey="name" />
          <YAxis tickCount={10} />
          <Bar dataKey="value" fill="#3cba9f" />
        </BarChart>) : null}
    </div>
  );
}





export default App;
