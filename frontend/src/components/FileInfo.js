import React from 'react';
import { HStack, Image, Text, Tooltip } from '@chakra-ui/react';
import FileImage from '../images/FileImage.png';
import Dustbin from '../images/dustbin.png';
import Send from '../images/send.png';

const FileInfo = ({ fileUploaded, removeFile, submitHandler }) => {
	return (
		<HStack
			w='90%'
			borderRadius='10px'
			backgroundColor='#E2E8F0'
			justifyContent='space-between'
			p='15'
		>
			<HStack>
				<Image src={FileImage} h='70px' w='70px' />
				<Text as='p'>{fileUploaded[0].name}</Text>
			</HStack>

			<HStack>
				<Tooltip label='Remove File' fontSize='10px' hasArrow>
					<Image
						h='30px'
						w='30px'
						src={Dustbin}
						onClick={removeFile}
						cursor='pointer'
					/>
				</Tooltip>
				<Tooltip label='Upload File' fontSize='10px' hasArrow>
					<Image
						h='30px'
						w='30px'
						src={Send}
						cursor='pointer'
						onClick={submitHandler}
					/>
				</Tooltip>
			</HStack>
		</HStack>
	);
};

export default FileInfo;
