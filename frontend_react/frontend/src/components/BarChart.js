/*eslint-disable */
import { Bar } from 'react-chartjs-2';
/* eslint-enable */
import { Chart as ChartJS } from 'chart.js/auto';

function BarChart({ title, labels, datasets }) {
    const chartData = {
        labels,
        datasets: [
            {
                label: title,
                data: datasets,
            },
        ],
    };
    return <Bar data={chartData} />;
}

export default BarChart;
