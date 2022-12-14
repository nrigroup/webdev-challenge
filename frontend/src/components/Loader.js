import React from 'react';
import { Spinner, Center } from '@chakra-ui/react';
const Loader = () => {
	return (
		<Center minH='100%' w='100%'>
			<Spinner thickness='4px' h='20px' w='20px' size='xl' />
		</Center>
	);
};

export default Loader;
