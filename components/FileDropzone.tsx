import { useCallback } from "react"
import { useDropzone } from "react-dropzone"
import axios from "axios"
import { BACKEND_URL } from "../config"

const FileDropzone = () => {
  const onDrop = useCallback(async (acceptedFiles: File[]) => {
    const formData = new FormData()
    formData.append("dataFile", acceptedFiles[0])
    try {
      const res = await axios.post(`${BACKEND_URL}/itemSales`, formData, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      })
      console.log(res)
    } catch (err) {
      console.log(err)
    }
  }, [])
  const { getRootProps, getInputProps, isDragActive } = useDropzone({ onDrop })

  return (
    <div {...getRootProps()}>
      <input {...getInputProps()} />
      {isDragActive ? (
        <p>{"Drop the files here ..."}</p>
      ) : (
        <p>{"Drag 'n' drop some files here, or click to select files"}</p>
      )}
    </div>
  )
}

export default FileDropzone
