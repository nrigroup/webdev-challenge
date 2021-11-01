import React, { useMemo } from "react";
import { Pie } from "react-chartjs-2";
import { scaleOrdinal } from "d3-scale";
import { schemeSet3 } from "d3-scale-chromatic";


const PieChart = (props) => {
  
  const pieData = useMemo(() => {

    const { data, label } = props;
    const amt_pie_lbl = Object.keys(data);
    const amt_pie_val = Object.values(data);    

    const intp_fn = scaleOrdinal().domain(amt_pie_lbl).range(schemeSet3);    
    const total_val = amt_pie_val.reduce((sum, item) => sum += item, 0);    
    const color = amt_pie_val.map(val => intp_fn(val / total_val) + "99");    

    return {
      labels: amt_pie_lbl,
      datasets: [
        {
          label,
          data: amt_pie_val,
          backgroundColor: color,
          borderColor: color,
          borderWidth: 1,
        }
      ]
    };
  }, [props.data]);

  return <div className="flex-1 text-center px-4 py-2 m-2">
    <Pie data={pieData} />
  </div>
}

export default PieChart;