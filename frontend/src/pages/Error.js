import React from 'react';
import { Text, Button, VStack } from '@chakra-ui/react';
import { useNavigate } from 'react-router-dom';

const Error = () => {
	const navigate = useNavigate();
	return (
		<VStack h='100%' minW='100%' justifyContent='center' spacing={10}>
			<Text as='p' fontSize='2xl'>
				404 | No Records Found.
			</Text>
			<Button variant='blueButton' onClick={() => navigate('/')}>
				Let's upload a file
			</Button>
		</VStack>
	);
};

export default Error;
