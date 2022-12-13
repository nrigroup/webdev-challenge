import { extendTheme } from '@chakra-ui/react';
import buttonTheme from './components/Button';

const overrides = {
	components: {
		Button: {
			...buttonTheme,
		},
	},
};

export default extendTheme(overrides);
