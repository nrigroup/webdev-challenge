import React, { useState } from 'react';
import { Image, Box, Text, VStack, Input, Button } from '@chakra-ui/react';
import { useNavigate } from 'react-router-dom';
import FileInfo from '../components/FileInfo';
import Loader from '../components/Loader';
import MessageToast from '../components/MessageToast';
import Header from '../components/Header';
import Upload from '../images/Upload.png';
import { useSaveNewFile } from '../queries/Queries';

const Home = () => {
	const saveFile = useSaveNewFile();
	const navigate = useNavigate();
	const [fileUploaded, setFileUploaded] = useState([]);

	const handleFile = (e) => {
		const newFile = e.target.files[0];
		if (newFile) {
			setFileUploaded([newFile]);
		}
	};

	const removeFile = () => {
		setFileUploaded([]);
		return;
	};

	const displayMessage = () => {
		return (
			<MessageToast
				toastId='error-id'
				title='Following error occured.'
				description={saveFile.error}
				successStatus={false}
			/>
		);
	};
	const submitHandler = (e) => {
		e.preventDefault();
		saveFile.mutate(fileUploaded);
	};

	const homeContent = () => {
		return (
			<VStack>
				<Box
					border='2px dashed #4267b2'
					bgColor='#f5f8ff'
					minH='300px'
					maxH='300px'
					w='400px'
					borderRadius='5%'
					pos='relative'
					overflow='clip'
					alignSelf='center'
					textAlign='center'
				>
					<Image src={Upload} alt='upload logo' m='auto' />
					<Input
						type='file'
						value={''}
						position='absolute'
						left='0'
						right='0'
						top='0'
						bottom='0'
						minH='100%'
						opacity='0'
						onChange={handleFile}
						style={{ cursor: 'pointer' }}
					/>
					<Text as='p' color='gray'>
						Drag and Drop your files or click to upload.
					</Text>
				</Box>
				<Button variant='blueButton' onClick={() => navigate('/displayData')}>
					{' '}
					View data for already uploaded file
				</Button>
				{fileUploaded.length > 0 ? (
					<FileInfo
						fileUploaded={fileUploaded}
						removeFile={removeFile}
						submitHandler={submitHandler}
					/>
				) : (
					''
				)}
			</VStack>
		);
	};
	return saveFile.isLoading ? (
		<Loader />
	) : (
		<VStack h='fit-content' w='100%' p='10'>
			<Header />
			{!saveFile.isSuccess && homeContent()}
			{saveFile.error && displayMessage()}
			{saveFile.isSuccess && navigate(`/displayData`)}
		</VStack>
	);
};

export default Home;
