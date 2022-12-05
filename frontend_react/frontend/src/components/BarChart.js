/*eslint-disable */
import { Bar } from 'react-chartjs-2';
/* eslint-enable */
import { Chart as ChartJS } from 'chart.js/auto';

function BarChart({ labels, datasets }) {
    const chartData = {
        labels,
        datasets: [
            {
                label: 'Pre-Tax Amount per date',
                data: datasets,
            },
        ],
    };
    return <Bar data={chartData} />;
}

export default BarChart;
