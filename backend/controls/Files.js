const fs = require('fs');
const pool = require('../db');
const csv = require('csvtojson');
var results = [];

exports.uploadFile = async (req, res) => {
	const fileToBeSaved = await req.files[0].data;

	//chcek if the file being uploaded ends with .csv extension
	if (req.files[0].name.split('.').reverse()[0] !== 'csv') {
		return res.status(400).json({
			error: 'Please upload a csv file.',
		});
	}

	results = await csv().fromString(fileToBeSaved.toString('utf8'));

	if (results.length === 0) {
		return res.status(400).json({
			error: 'Something went wrong. Please try again.',
		});
	}

	//Check if all the required fileds are present
	let checkKeyPresenceInArray = (key) =>
		results.some((item) => item.hasOwnProperty(key));

	if (
		!checkKeyPresenceInArray('date') ||
		!checkKeyPresenceInArray('category') ||
		!checkKeyPresenceInArray('lot title') ||
		!checkKeyPresenceInArray('lot location') ||
		!checkKeyPresenceInArray('lot condition') ||
		!checkKeyPresenceInArray('pre-tax amount')
	) {
		return res.status(501).json({
			error: 'Please make sure you have provided all the required fields.',
		});
	}
	try {
		results.map(async (record) => {
			await pool.query(
				'INSERT INTO files (date_info, category, lot_title, lot_location,lot_condition, pre_tax_amount,tax_name, tax_amount) VALUES($1,$2,$3,$4,$5,$6,$7,$8)',
				[
					new Date(record.date).toISOString().split('T')[0],
					record.category,
					record['lot title'],
					record['lot location'],
					record['lot condition'],
					record['pre-tax amount'],
					record['tax name'],
					record['tax amount'],
				]
			);
		});
		return res.status(200).json({
			message: 'Data inserted successfully',
		});
	} catch (error) {
		return res.status(400).json({
			error: 'Something went wrong. Please try again.',
		});
	}
};

exports.getGraphInfo = async (req, res) => {
	const { rows } = await pool.query(
		'SELECT pre_tax_amount, date_info from files'
	);

	if (rows.length === 0) {
		return res.status(400).json({
			error: '404 | No Records Found.',
		});
	}
	return res.status(200).json({
		data: rows,
	});
};

exports.getPieChartPerCategory = async (req, res) => {
	const { rows } = await pool.query(
		'SELECT category, SUM(pre_tax_amount) AS total from files GROUP BY category'
	);

	if (rows.length === 0) {
		return res.status(400).json({
			error: 'Something went wrong. Please try again.',
		});
	}

	return res.status(200).json({
		data: rows,
	});
};

exports.getPieChartPerCondition = async (req, res) => {
	const { rows } = await pool.query(
		'SELECT lot_condition, SUM(pre_tax_amount) AS total from files GROUP BY lot_condition'
	);

	if (rows.length === 0) {
		return res.status(400).json({
			error: 'Something went wrong. Please try again.',
		});
	}
	return res.status(200).json({
		data: rows,
	});
};
