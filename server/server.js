const express = require('express')
const pg = require('pg')
const cors = require('cors')
const dotenv = require('dotenv')

dotenv.config()

const app = express()
const port = 3001
app.use(cors())

const pool = new pg.Pool({
  user: process.env.PG_USER,
  host: process.env.PG_HOST,
  database: process.env.PG_DATABASE,
  port: process.env.PG_PORT,
  password: process.env.PG_PASSWORD,
})

const createTableQuery = `
CREATE TABLE IF NOT EXISTS NRIItemLotDetails (
  id SERIAL PRIMARY KEY,
  date DATE NOT NULL ,
  category	TEXT NOT NULL,
  lot_title	TEXT NOT NULL,
  lot_location	TEXT NOT NULL,
  lot_condition	TEXT NOT NULL,
  pre_tax_amount	DECIMAL NOT NULL,
  tax_name	TEXT NOT NULL,
  tax_amount DECIMAL NOT NULL
);`

// Define the SQL query to insert demo data into the table
const insertDataQuery = (
  date,
  category,
  lotTitle,
  lotLocation,
  lotCondition,
  preTaxAmount,
  taxName,
  taxAmount
) => {
  return `INSERT INTO NRIItemLotDetails (date,category,lot_title,lot_location,lot_condition,pre_tax_amount,tax_name,tax_amount)
  VALUES
    ('${date}', '${category}', '${lotTitle}', '${lotLocation}', '${lotCondition}', '${preTaxAmount}', '${taxName}', '${taxAmount}');
`
}

const seed = () => {
  // Connect to the database and execute the queries
  return (async () => {
    const client = await pool.connect()
    try {
      await client.query('BEGIN')
      await client.query(createTableQuery)
      await client.query('COMMIT')
      console.log('Seed script ran successfully')
    } catch (err) {
      await client.query('ROLLBACK')
      console.error('Error running seed script:', err)
    } finally {
      client.release()
    }
  })()
}

seed()

app.use(express.json())

app.get('/api', (req, res) => {
  res.send('Hello World!')
})

app.post('/api/storecsv', (req, res) => {
  req.body.data.forEach((result) => {
    let insertQuery = insertDataQuery(
      result.date,
      result.category,
      result['lot title'],
      result['lot location'],
      result['lot condition'],
      result['pre-tax amount'],
      result['tax name'],
      result['tax amount']
    )

    pool
      .query(insertQuery)
      .then((result) => console.log(result))
      .catch((err) => console.log(err))
  })

  res.sendStatus(201)
})

app.listen(port, () => {
  console.log(`Server is listening on port ${port}`)
})
