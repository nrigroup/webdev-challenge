import { useState } from 'react'
import UploadCsv from '../components/UploadCsv'
import Reports from '../components/Reports'
import { calculateTotalAmount } from '../utils/functions/calculateTotalAmount'

export default function Home() {
  const [parsedJson, setParsedJson] = useState(null)

  return (
    <>
      <UploadCsv setParsedJson={setParsedJson} />
      {parsedJson && <Reports data={calculateTotalAmount(parsedJson)} />}
    </>
  )
}
