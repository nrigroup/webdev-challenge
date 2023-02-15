import Card from 'react-bootstrap/Card'
import Row from 'react-bootstrap/Row'
import Col from 'react-bootstrap/Col'
import Chart from './Chart'

export default function Reports({ data }) {
  return (
    <Card className="my-5">
      <Card.Header className="text-center">Reports</Card.Header>
      <Row className="m-3">
        <Col>
          <Card>
            <Chart
              chartType="bar"
              title="Total amount (pre tax amount) per day"
              label="Total Amount"
              labels={Object.keys(data?.perDay)}
              amountData={Object.values(data.perDay)}
            />
          </Card>
        </Col>
      </Row>
      <Row>
        <Col>
          <Card>
            <Chart
              chartType="pie"
              title="Total amount (pre tax amount) per category"
              label="Total Amount"
              labels={Object.keys(data?.perCategory)}
              amountData={Object.values(data.perCategory)}
            />
          </Card>
        </Col>
        <Col>
          <Card>
            <Chart
              chartType="pie"
              title="Total amount (pre tax amount) per lot condition"
              label="Total Amount"
              labels={Object.keys(data?.perCondition)}
              amountData={Object.values(data.perCondition)}
            />
          </Card>
        </Col>
      </Row>
    </Card>
  )
}
