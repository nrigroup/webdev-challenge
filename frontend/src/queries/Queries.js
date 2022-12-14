import axios from 'axios';
import { useQuery, useMutation } from 'react-query';
const BACKEND_URL = process.env.REACT_APP_BACKEND_URL;

//QUERY TO UPLOAD FILE
export const saveNewFile = async (fileInfo) => {
	const postRetrieved = await axios.post(
		`${BACKEND_URL}/file/uploadFile`,
		fileInfo,
		{
			headers: {
				'Content-Type': 'multipart/form-data',
			},
		}
	);
	return postRetrieved;
};

export const useSaveNewFile = () => {
	return useMutation(['createPost'], (fileInfo) => saveNewFile(fileInfo), {
		retry: false,
	});
};

//----------------------------------------------------------------------------------

//QUERY TO GET DATA FOR GRAPH
export const getDataForGraph = async () => {
	const dataRetrieved = await axios.get(`${BACKEND_URL}/file/getGraphInfo`);
	return dataRetrieved;
};

export const useGetDataForGraph = () => {
	return useQuery(['garphInfo'], () => getDataForGraph(), {
		refetchOnWindowFocus: false,
		retry: false,
	});
};

//----------------------------------------------------------------------------------

//QUERY TO GET DATA FOR PIE CHARTS
export const getPieChartPerCondition = async () => {
	const dataRetrieved = await axios.get(
		`${BACKEND_URL}/file/getPieChartPerCondition`
	);

	return dataRetrieved;
};

export const useGetPieChartPerCondition = () => {
	return useQuery(
		['getPieChartPerCondition'],
		() => getPieChartPerCondition(),
		{
			refetchOnWindowFocus: false,
			retry: false,
		}
	);
};

export const getPieChartPerCategory = async () => {
	const dataRetrieved = await axios.get(
		`${BACKEND_URL}/file/getPieChartPerCategory`
	);

	return dataRetrieved;
};

export const useGetPieChartPerCategory = () => {
	return useQuery(['getPieChartPerCategory'], () => getPieChartPerCategory(), {
		refetchOnWindowFocus: false,
		retry: false,
	});
};
