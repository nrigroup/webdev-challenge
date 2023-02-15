import { useState } from 'react'
import Card from 'react-bootstrap/Card'
import Button from 'react-bootstrap/Button'
import Form from 'react-bootstrap/Form'
import InputGroup from 'react-bootstrap/InputGroup'
import NriAlert from './NriAlert'
import { isCsvFileValid } from '../utils/functions/isCsvFileValid'
import { parseCsv } from '../utils/functions/parseCsv'

export default function UploadCsv({ setParsedJson }) {
  const [csvFile, setCsvFile] = useState(null)
  const [csvFileError, setCsvFileError] = useState(null)

  const handleSubmit = () => {
    setCsvFileError(null)

    if (!csvFile) {
      setCsvFileError('Please select a csv file')
      return
    }

    if (!isCsvFileValid(csvFile)) {
      setCsvFileError('Please select a valid csv file')
      return
    }

    parseCsv(csvFile, setParsedJson)
  }

  return (
    <Card className="my-5">
      <Card.Header className="text-center">
        Welcome to NRI Inventory
      </Card.Header>
      <Card.Body>
        {csvFileError && <NriAlert text={csvFileError} />}
        <Card.Text>
          Please upload a <code>.csv</code> file received from an auctioneer
        </Card.Text>
        <div style={{ width: '500px' }}>
          <InputGroup className="mb-3">
            <Form.Control
              type="file"
              onChange={(e) => setCsvFile(e.target.files[0])}
            />
            <Button
              variant="outline-secondary"
              id="button-addon2"
              onClick={handleSubmit}
            >
              Upload
            </Button>
          </InputGroup>
        </div>
      </Card.Body>
    </Card>
  )
}
