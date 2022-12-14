##### Contents

- [Setup](#setup)
  - [Prerequisite](#prerequisite)
  - [Instructions](#instructions)

# Setup

Please follow the instructions listed below to setup the application in your local environment.

## Prerequisite

There are some basic requirements for the backend to work properly:

- PostgreSQL and pgAdmin (Download from here: https://www.postgresql.org/download/ and https://www.pgadmin.org/download/)
- node version 14 or 16

## Instructions

- Clone the repository
- There will be two folders named frontend and backend, respectively.
  - Cd into each of them, and run command: 'npm install'
- Setup the database and table inside pgAdmin using the commands provided in database.sql file.
  - The application may ask for uername, password and other variables. You can use the same as provided in db.js file or create your own. In case, you use your own values, change the db.js file accordingly.
- In the frontend, create an '.env' file and add environment varible REACT_APP_BACKEND_URL. The value would be http://localhost:5000 (enter different port, in case you will be providing a separate value on the backend, inside index.js)
- Now, you can run the frontend and backend application by running the command 'npm run start', in their respective directories.
- The frontend can be accessed at http://localhost:3000
