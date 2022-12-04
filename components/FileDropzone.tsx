import { useCallback } from "react"
import { useDropzone } from "react-dropzone"
import axios from "axios"
import { BACKEND_URL } from "../config"
import { parse } from "csv-parse/browser/esm"

const csvToArray = (str: string, delimiter = ",") => {
  // get column names
  const headers = str.slice(0, str.indexOf("\n")).split(delimiter)
  // get rows
  const rows = str.slice(str.indexOf("\n") + 1).split("\n")

  const arr = rows
    // filter out empty lines
    .filter((row) => row.length > 0)
    .map((row) => {
      // TODO refactor to ignore delimeters inside of quotation marks for location
      const values = row.split(delimiter)
      const el = headers.reduce((object: { [key: string]: any }, header, index) => {
        object[header] = values[index]
        return object
      }, {})
      return el
    })

  return arr
}

const FileDropzone = () => {
  const onDrop = useCallback(async (acceptedFiles: File[]) => {
    try {
      const reader = new FileReader()
      reader.onload = (e) => {
        const text = e.target?.result
        const data = csvToArray(text as string)
        data.map((row) => {
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
          return row
        })
        console.log(data)
        // axios.post(`${BACKEND_URL}itemSales`, {
        //   data,
        // })
      }
      reader.readAsText(acceptedFiles[0])
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
