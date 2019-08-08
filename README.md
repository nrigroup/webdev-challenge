## About Project

This project is to import the items in CSV to database and then it displays the total spending amount per-month and per-category. I have used laravel, bootstrap, jquery.


## Installation

After cloning the repo, please follow the following steps to install the project:

1. Install dependencies (at the root of the project):

    ```shell
    composer install
    ```
2. copy env file and modify your database details (database name, username, password) in that file (at the root of the project):

    ```shell
    cp .env.example .env
    ```
3. Run this command to create tables in database:
    ```shell
    php artisan migrate
    ```    
4. Run this command to generate key

    ```shell
    php artisan key:generate
    ```
5. Start PHP's built-in development server by running this command:
    ```shell
    php artisan serve
     ```
    
