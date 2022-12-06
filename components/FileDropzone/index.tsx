import { Button } from "react-bootstrap"
import { useDropzone } from "react-dropzone"

const FileDropzone = ({ onDrop }: { onDrop: (acceptedFiles: File[]) => void }) => {
  const { getRootProps, getInputProps, isDragActive } = useDropzone({ onDrop })

  return (
    <Button {...getRootProps()}>
      <input {...getInputProps()} />
      {isDragActive ? (
        <p>{"Drop the files here ..."}</p>
      ) : (
        <p>{"Drag 'n' drop some files here, or click to select files"}</p>
      )}
    </Button>
  )
}

export default FileDropzone
