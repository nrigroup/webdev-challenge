## Project Setup

PHP version - 7.2.26 or above
Database - MySql Server
Install composer and run "composer install" command from cmd in the project directory to install all the dependencies.

Create .env file after pulling project from git
Configure the database in .env, take .env.example as example which you can find in the project directory
Execute command php artisan key:generate to generate the application key
Execute command php artisan config:cache to cache the config
Set mysql 'strict' to 'false' in database.php, since laravel supports ONLY_FULL_GROUP_BY  when strict is set to false;
Run command "php artisan serve" to start the server on port 8000.

excel_sql.sql - Find this file in the project diretcory and execute the sql script to generate the tables
data.csv - Find this file in the project directory to load the .csv file into the database.


#Implementation

