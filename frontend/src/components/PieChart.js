import React, { useEffect, useState } from 'react';
import { Pie } from 'react-chartjs-2';
import { Chart, registerables } from 'chart.js';
import { VStack, Text } from '@chakra-ui/react';
import Loader from './Loader';

const PieChart = ({ pieChartInfo, type }) => {
	Chart.register(...registerables);
	const [chartData, setChartData] = useState({});

	// eslint-disable-next-line react-hooks/exhaustive-deps
	const chart = () => {
		const data = pieChartInfo?.data.data.map((item) => {
			return item.total;
		});
		const labels = pieChartInfo?.data.data.map((item) => {
			if (type === 'condition') {
				return item.lot_condition;
			}
			return item.category;
		});
		setChartData({
			responsive: true,
			labels: labels,
			datasets: [
				{
					label: 'Pre Tax Amount Total: ',
					data: data,
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
				},
			],
		});
	};
	useEffect(() => {
		chart();
		// eslint-disable-next-line react-hooks/exhaustive-deps
	}, []);

	return chartData.labels && chartData.datasets ? (
		<VStack w={['100%', '30%']} mt={['10', '0']} textAlign='center'>
			<Pie data={chartData} />
			<Text as='p'>
				{type === 'condition'
					? 'Overall Total (pre tax amount) Per Condition'
					: 'Overall Total (pre tax amount) Per Category'}
			</Text>
		</VStack>
	) : (
		<Loader />
	);
};

export default PieChart;
