import Image from "next/image"
import { Button } from "react-bootstrap"
import { useDropzone } from "react-dropzone"
import styles from "./index.module.scss"

const FileDropzone = ({
  onDrop,
  file,
  onSubmit,
}: {
  onDrop: (acceptedFiles: File[]) => void
  file: File | undefined
  onSubmit: () => void
}) => {
  const { getRootProps, getInputProps, isDragActive } = useDropzone({ onDrop })

  return (
    <div className={styles.container}>
      {file ? (
        <>
          <div className={styles.file}>
            <Image
              className={styles.icon}
              src="https://img.icons8.com/material-outlined/96/null/happy-file.png"
              alt="happy file icon"
              width={96}
              height={96}
            />
            <span>{file.name}</span>
          </div>
          <Button onClick={onSubmit} className={styles.button}>
            Upload file
          </Button>
        </>
      ) : (
        <Button {...getRootProps()} className={styles.button}>
          <input {...getInputProps()} />
          {isDragActive ? (
            <p>{"Drop the files here ..."}</p>
          ) : (
            <p>{"Drag 'n' drop some files here, or click to select files"}</p>
          )}
        </Button>
      )}
    </div>
  )
}

export default FileDropzone
