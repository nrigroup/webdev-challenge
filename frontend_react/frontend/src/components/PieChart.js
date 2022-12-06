import { useEffect, useState } from 'react';
/*eslint-disable */
import { Pie } from 'react-chartjs-2';
/* eslint-enable */
import { Chart as ChartJS } from 'chart.js/auto';

function getRandomColor() {
    const letters = '0123456789ABCDEF'.split('');
    let color = '#';
    for (let i = 0; i < 6; i += 1) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

function PieChart({ title, labels, datasets }) {
    const [chartData, setChartData] = useState({
        labels,
        datasets: [
            {
                label: title,
                data: datasets,
            },
        ],
    });
    useEffect(() => {
        if (
            title !== undefined &&
            labels !== undefined &&
            datasets !== undefined
        ) {
            const backgroundColor = datasets.map(() => getRandomColor());
            const chartParameters = {
                labels,
                datasets: [
                    {
                        label: title,
                        data: datasets,
                        backgroundColor,
                    },
                ],
            };
            setChartData(chartParameters);
        }
    }, [title, labels, datasets]);
    return <Pie data={chartData} />;
}

export default PieChart;
