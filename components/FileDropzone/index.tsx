import { useState } from "react"
import { Button } from "react-bootstrap"
import { useDropzone } from "react-dropzone"
import styles from "./index.module.scss"

const FileDropzone = ({
  onDrop,
  fileDropped,
}: {
  onDrop: (acceptedFiles: File[]) => void
  fileDropped: boolean
}) => {
  const { getRootProps, getInputProps, isDragActive } = useDropzone({ onDrop })

  return (
    <Button {...getRootProps()} className={styles.button}>
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
