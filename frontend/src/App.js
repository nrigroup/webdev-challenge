import Home from './pages/Home';
import { VStack } from '@chakra-ui/react';
import DisplayData from './pages/DisplayData';
import { Routes, Route } from 'react-router-dom';
import Error from './pages/Error';

function App() {
	return (
		<VStack h='100vh' w='100%' m='auto'>
			<Routes>
				<Route path='/' element={<Home />} />
				<Route path='/displayData' element={<DisplayData />} />
				<Route path='*' element={<Error />}></Route>
			</Routes>
		</VStack>
	);
}

export default App;
