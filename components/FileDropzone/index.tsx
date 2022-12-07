import { RowError } from "csv-file-validator"
import Image from "next/image"
import { Button, FormCheck, Spinner } from "react-bootstrap"
import { useDropzone } from "react-dropzone"
import { REQUEST_STATUS } from "../../types"
import styles from "./index.module.scss"

const FileDropzone = ({
  onDrop,
  fileType,
  fileName,
  fileErrors,
  onSubmit,
  mutationStatus,
}: {
  onDrop: (acceptedFiles: File[]) => void
  fileType: string
  fileName: null | string
  fileErrors: RowError[]
  onSubmit: () => void
  mutationStatus: REQUEST_STATUS
}) => {
  const { getRootProps, getInputProps, isDragActive } = useDropzone({ onDrop })

  return (
    <div className={styles.container}>
      {mutationStatus === REQUEST_STATUS.IDLE &&
        (fileName && fileErrors.length < 1 ? (
          <>
            <div className={styles.file}>
              <Image
                className={styles.icon}
                src="https://img.icons8.com/material-outlined/96/null/happy-file.png"
                alt="happy file icon"
                width={96}
                height={96}
              />
              <span>{fileName}</span>
            </div>
            <Button onClick={onSubmit} className={styles.button}>
              Upload file
            </Button>
          </>
        ) : (
          <Button {...getRootProps()} className={styles.button}>
            <input {...getInputProps()} />
            {isDragActive ? (
              <p>{"Drop the file here ..."}</p>
            ) : fileErrors.length > 0 ? (
              <p>{`Re-drop ${fileType} file`}</p>
            ) : (
              <p>
                {"Drag 'n' drop "}
                <strong>{fileType}</strong>
                {" file here, or click to select file"}
              </p>
            )}
          </Button>
        ))}
      {mutationStatus === REQUEST_STATUS.FETCHING && <Spinner />}
      {mutationStatus === REQUEST_STATUS.ERROR && (
        <p>Oops! There was an error uploading the file.</p>
      )}
      {mutationStatus === REQUEST_STATUS.SUCCESS && <p>Success!</p>}
    </div>
  )
}

export default FileDropzone
