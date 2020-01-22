## Project Setup

PHP version - 7.2.26 or above <br/>
Database - MySql Server <br/>
Install composer and run "composer install" command from cmd in the project directory to install all the dependencies. <br/>
<br/>
Create .env file after pulling project from git <br/>
Configure the database in .env, take .env.example as example which you can find in the project directory <br/>
Execute command php artisan key:generate to generate the application key <br/>
Execute command php artisan config:cache to cache the config <br/>
Set mysql 'strict' to 'false' in database.php, since laravel supports ONLY_FULL_GROUP_BY  when strict is set to false; <br/>
Run command "php artisan serve" to start the server on port 8000. <br/>
<br/> 
excel_sql.sql - Find this file in the project diretcory and execute the sql script to generate the tables <br/>
data.csv - Find this file in the project directory to load the .csv file into the database. <br/>
<br/>
#Implementation

