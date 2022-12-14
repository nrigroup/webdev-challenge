const Pool = require('pg').Pool;

const pool = new Pool({
	user: 'postgres',
	password: 'Me@13876459',
	host: 'localhost',
	port: 5432,
	database: 'CsvFiles',
});

module.exports = pool;
