
## Installation
**Clone the repository with git clone**

First We need to download Laravel 5.8 version, and install into our computer.

same as install Composer and Maatwebsite Package 

**Run composer install**

After this we need to make database connection. For this we have to open .env file and under this file we have to define Mysql database configuration details which you can see below.

**Copy .env.example file to .env** and edit database credentials there

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=testing

DB_USERNAME=****

DB_PASSWORD=****

After makiing database configuration, now in next step we will see how to make table.**Launch MySQL Workbench, and create a new schema in the connected server. Schema Name:testing**

For add fake record into Mysql database. First we want to make table in Mysql database from this Laravel 5.8 application.And for migrate data, you have to go command prompt and write following command.

**Run php artisan migrate**

This command will migrate default data from database/migrations folder and it will make user table in define Mysql database.

check Apache root path, for this we have open **app/Http/Middleware/VerifyCsrfToken** . check this class follow :

*protected $except = [
        '/result'
    ];*

Now we are ready

**Run php artisan serve**
This command will start Laravel server and give you base url of Laravel application. For test import data operation we have to write following url in browser.

**http://localhost:8000**

That's it - load the homepage


## My project specialty: ##

In my project, I built the web pages through the blade view template, control template and routing (MVC template) instead of using Laravel Excel. In the control template,do the analyzing and organizing the data, arrange and calculate by array. I’ve researched a lot of information about how to import and export CSV files through Laravel framework, however most of the time on the website, the way is added Laravel Excel third-party library to Laravel application, following service provider and aliase import and export csv xlsx files.In my opinion, although Laravel Excel's method is concise and clear, my project has a more intuitive understanding of data, path, and method in future debugging.

This is my first time  using laravel PHP Web Framework.In the Laravel documentation, I learned the facade (interface) and contract (interface). I also learned about middleware, csrf protection.





