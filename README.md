This app accepts a csv file, parse it, save it into a database table, and then display the spending summary by month.

It only includes the basic functionality with clean and simple logic and code.

Follow the following instructions to set up the project:

1. Download the csv.zip file into your local drive and unzip it
2. Copy the project into your local development environment, such as xampp/htdocs
3. Access your project folder in command line and run: composer update --no-scripts
4. Run: copy .env.example .env
5. Run: php artisan key:generate
6. Update database configurations in .evn file, include DB_DATABASE, DB_USERNAME, DB_PASSWORD, etc
7. Run php artisan migrate

Now you are ready to run the app.

