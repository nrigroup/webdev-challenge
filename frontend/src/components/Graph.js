import React, { useEffect, useState } from 'react';
import { Bar } from 'react-chartjs-2';
import { Chart, registerables } from 'chart.js';
import Loader from './Loader';
import { HStack } from '@chakra-ui/react';

const Graph = ({ graphInfo }) => {
	Chart.register(...registerables);

	const [chartData, setChartData] = useState({});

	const chart = () => {
		const labels = graphInfo?.data.data.map((item) => {
			return new Date(item.date_info).toLocaleDateString('en-US', {
				weekday: 'long',
			});
		});
		const data = graphInfo?.data.data.map((item) => {
			return item['pre_tax_amount'];
		});
		setChartData({
			responsive: true,
			labels: labels,
			datasets: [
				{
					label: 'Per Tax Amount',
					data: data,

					backgroundColor: [`rgb(75, 192, 192, 0.6)`],
					borderWidth: 2,
				},
			],
		});
	};
	useEffect(() => {
		chart();
		// eslint-disable-next-line react-hooks/exhaustive-deps
	}, []);
	return chartData.labels && chartData.datasets ? (
		<HStack w='100%'>
			<Bar data={chartData} />
		</HStack>
	) : (
		<Loader />
	);
};

export default Graph;
