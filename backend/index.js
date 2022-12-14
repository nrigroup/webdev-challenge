const express = require('express');
const app = express();
const cors = require('cors');
const fileupload = require('express-fileupload');

//MIDDLEWARE
app.use(fileupload());
app.use(cors());
app.use(express.json());

app.listen(5000, () => {
	console.log('server has started on port 5000');
});

//ROUTES
const fileRoutes = require('./routes/File');
app.use('/file', fileRoutes);
