1. To set up the MySQL database, you can either use the command docker-compose up -d to run it as a Docker container, or set it up locally as a server on a local machine.
   The password and other configurations are stored in the .env file (which is included for this purpose).

2. Run npm install to install the required dependencies for the application.

3. Start the server with the command npm start. The server has routes set up to handle uploading of a .csv file, parsing it, and saving the data to a relational database management system (RDB) using an ORM (Object-Relational Mapping) library called Sequelize.

4. The backend of the application includes separate configurations for the database schema, routers (dashboard, index, and a middle 'result' path to handle database requests), and the server. The app is ready for deployment, and if needed, I can share a link to the public IP of an AWS EC2 instance running the application on port 3000. However, I prefer to do it later, because of the weekend, let me know and I will turn on the EC2 and share the link.

5. The frontend of the application is built with Bootstrap, and the Chart.js library is used for creating graphs. I didn't use React or Angular due to the time limit of 2 hours.
   Please reach out to serputoff@gmail.com if you have any questions or would like to have more parts of the application finished or explained.
