import { useCallback } from "react"
import { useDropzone } from "react-dropzone"
import { useAddItemSales } from "../../hooks/mutations"

const FileDropzone = ({ refreshData }: { refreshData: () => void }) => {
  const addItemSales = useAddItemSales()

  const onDrop = useCallback(
    async (acceptedFiles: File[]) => {
      const formData = new FormData()
      formData.append("dataFile", acceptedFiles[0])
      await addItemSales.mutateAsync(formData)
      refreshData()
    },
    [refreshData, addItemSales],
  )
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
