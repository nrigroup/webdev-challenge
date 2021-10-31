import React, { useMemo } from "react";
import { Pie } from "react-chartjs-2";
import { interpolateRgb } from "d3-interpolate";


const PieChart = (props) => {
  console.log(props);
  const pieData = useMemo(() => {

    const { data, label } = props;
    const amt_pie_lbl = Object.keys(data);
    const amt_pie_val = Object.values(data);    

    const interpolate = interpolateRgb("steelblue", "brown");
    const total_val = amt_pie_val.reduce((sum, item) => sum += item, 0);
    // console.log(total_val);
    const color = amt_pie_val.map(val => interpolate(val / total_val));
    console.log(color);    

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