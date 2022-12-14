const express = require('express');
const router = express.Router();
const {
	uploadFile,
	getGraphInfo,
	getPieChartPerCondition,
	getPieChartPerCategory,
} = require('../controls/Files');

router.post('/uploadFile', uploadFile);
router.get('/getGraphInfo', getGraphInfo);
router.get('/getPieChartPerCondition', getPieChartPerCondition);
router.get('/getPieChartPerCategory', getPieChartPerCategory);

module.exports = router;
