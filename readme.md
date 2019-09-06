This app accepts a csv file, parse it, and then save it into a database table. 

It only includes the basic functionality with clean and simple logic and code.

Follow the following instructions to set up the project:

1. Download the csv.zip file into your local drive and unzip it
2. Copy the project into your local development environment, such as xampp/htdocs
3. Access your project folder in command line and Run composer update --no-scripts
4. Run copy .env.example .env
5. Run php artisan key:generate
6. Setup database configurations in .evn file, include:DB_DATABASE, DB_USERNAME, DB_PASSWORD
7. Run php artisan migrate

Now you are ready to use and run the app.

(I also included the controller as a separate file if you want to review it before installing the package)
