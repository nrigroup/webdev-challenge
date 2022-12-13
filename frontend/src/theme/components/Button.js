const buttonTheme = {
	baseStyle: {
		bg: 'none !important',
		_focus: {
			boxShadow: 'none',
			outline: 'none',
		},
		_hover: {
			_disabled: {
				bg: 'secondary.600',
			},
			_loading: {
				bg: 'secondary.600',
			},
		},
	},
	variants: {
		blueButton: {
			bg: 'lightBlue',
			borderRadius: '10px',
		},
	},

	defaultProps: {
		variants: 'blueButton',
	},
};
export default buttonTheme;
