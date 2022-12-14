import React from 'react';
import { Box, Button, Flex, VStack } from '@chakra-ui/react';
import { useNavigate } from 'react-router-dom';
import Graph from '../components/Graph';
import PieChart from '../components/PieChart';
import Loader from '../components/Loader';
import Header from '../components/Header';
import Error from './Error';
import {
	useGetDataForGraph,
	useGetPieChartPerCondition,
	useGetPieChartPerCategory,
} from '../queries/Queries';

const DisplayData = () => {
	const navigate = useNavigate();
	const {
		isLoading: graphDataLoading,
		data: graphData,
		isError: graphDataError,
		isSuccess: s,
	} = useGetDataForGraph();
	console.log(graphDataLoading, s);
	const {
		isLoading: pieChartPerConditionLoading,
		data: pieChartPerConditionData,
		error: pieChartPerConditionDataError,
	} = useGetPieChartPerCondition();
	const {
		isLoading: pieChartPerCategoryLoading,
		data: pieChartPerCategoryData,
		error: pieChartPerCategoryDataError,
	} = useGetPieChartPerCategory();

	const displayDataContent = () => {
		return (
			<VStack h='fit-content' w='100%' spacing={10} p='10'>
				<Header />
				<Graph graphInfo={graphData} />
				<Flex
					direction={['column', 'row']}
					w='100%'
					justifyContent='space-between'
				>
					<PieChart pieChartInfo={pieChartPerConditionData} type='condition' />
					<PieChart pieChartInfo={pieChartPerCategoryData} type='category' />
				</Flex>
				<Button onClick={() => navigate('/')} variant='blueButton'>
					Let's upload a file
				</Button>
			</VStack>
		);
	};
	return graphDataLoading ||
		pieChartPerConditionLoading ||
		pieChartPerCategoryLoading ? (
		<Box w='100%' h='100%'>
			<Loader />
		</Box>
	) : graphDataError ||
	  pieChartPerCategoryDataError ||
	  pieChartPerConditionDataError ? (
		<Error />
	) : (
		displayDataContent()
	);
};

export default DisplayData;
