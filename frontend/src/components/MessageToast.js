import React, { useEffect } from 'react';
import { useToast } from '@chakra-ui/react';

const MessageToast = ({ toastId, title, description, successStatus }) => {
	const toast = useToast();
	const id = toastId;
	console.log(description);
	useEffect(() => {
		if (!toast.isActive(id)) {
			toast({
				id,
				title: title,
				description: successStatus
					? description.data.message
					: description?.response.data.error,
				status: successStatus ? 'success' : 'error',
				duration: 6000,
				isClosable: true,
			});
		}
		// eslint-disable-next-line react-hooks/exhaustive-deps
	}, [toastId]);
	return <></>;
};

export default MessageToast;
