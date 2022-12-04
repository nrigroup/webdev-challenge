import { useCallback } from "react"
import { useDropzone } from "react-dropzone"
import axios from "axios"
import { BACKEND_URL } from "../config"
import Papa from "papaparse"

const FileDropzone = () => {
  const onDrop = useCallback((acceptedFiles: File[]) => {
    Papa.parse(acceptedFiles[0], {
      header: true,
      skipEmptyLines: true,
      complete: async (results: { data: { [key: string]: string | Date }[] }) => {
        const parsedResults = results.data.map((row) => {
          if (row.date) {
            row.date = new Date(row.date)
          }
          if (row["lot title"]) {
            row["auctionItem"] = row["lot title"]
            delete row["lot title"]
          }
          if (row["lot location"]) {
            row["location"] = row["lot location"]
            delete row["lot location"]
          }
          if (row["lot condition"]) {
            row["condition"] = row["lot condition"]
            delete row["lot condition"]
          }
          if (row["pre-tax amount"]) {
            row["preTaxAmount"] = row["pre-tax amount"]
            delete row["pre-tax amount"]
          }
          if (row["tax amount"]) {
            row["taxAmount"] = row["tax amount"]
            delete row["tax amount"]
          }
          if (row["tax name"]) {
            row["tax"] = row["tax name"]
            delete row["tax name"]
          }
          // TODO write validation to check for required columns
          return row
        })
        try {
          const res = await axios.post(`${BACKEND_URL}/itemSales`, {
            data: parsedResults,
          })
          console.log(res)
        } catch (err) {
          console.log(err)
        }
      },
    })
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
