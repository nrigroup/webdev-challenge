# NRI Web Development Challenge
Heroku Deployment Link: https://csv-reader-front.herokuapp.com/
## Demo
![](https://github.com/Tez01/webdev-challenge/blob/master/demo.gif)
# Installation instruction
1. Make sure you have node.js installed.
2. Clone the repository from github.
3. The database configuration is taken from an environment file. Which is not available in the repo for security reasons but the .env file is shared in the email. Save this file in the `backend_django/backend/backend/` directory.
4. cd into the clone repository. Go to `frontend_react/frontend` folder. Run `npm install` 
5. Go back to the root folder of repository and run `docker-compose up`.
6. This should set up the frontend and backend at the same time. 
7. By default, frontend can be accessed at `localhost:3000` and backend at `localhost:8000`.

## Things I am proud of
1. I have chosen an architecture so as to separate the development of frontend and backend which reduces complexity and is more scalable design for larger projects. 
2. The frontend is a single page web application developed using React which connects with a django backend and PostgreSQL relational database using endpoints provided through an API. ChartJS library is used to display bar graphs and pie charts.
3. The Model-View-Controller architecture is implemented.
4. The frontend exploits the context API from React to share state between different routes which reduces the complexity to pass states from one route to another.
5. React-routers are used to change views between home page and analytics page without any reload of the page. This enhances application usability.
6. The design is implemented in a responsive manner starting with a mobile-first UI. I used bootstrap extensively  which reduces the need to manage my own css to a great extent. My css file has only 7 lines.
7. The code is developed using functional programming style where I have tried to use pure functions as much as possible. I have also tried to make these functions as generic as possible and achieved the specifics using arguments. This increased reusability of modules, reduced code complexity and would help in further extension of code.
8. The code is well tested. The validation for CSV data is done both at frontend and backend. However, neither frontend and backend rely on validation done by another and all validation checks are present on both frontend and backend. The validation ability of django predefined data types are used extensively. Following checks were implemented:
* File type check
* Presence of required headers and required values.
* Validation for data types in the fields. For example, pre-tax amount can not be negative.
* Proper error reporting for both frontend and backend.
* Avoiding access of analytics page without data.
9. Linters are used for both frontend(ESLint) and backend(Pylint) to ensure a consistent and clean coding conventions. Airbnb Javascript style guide is used for frontend.
10. Automated unit tests were developed for frontend using Jest. These tests are also included in the github actions workflows which automatically runs these tests on every push to the branch. 
11. Docker is used to setup development environment easily. Both frontend and backend have their separate docker files so that developers can setup frontend and backend environment separately. However, a common docker-compose file is also available in the root directory which sets up both frontend and backend at the same time.
12. Frontend and backend applications are hosted on heroku.
