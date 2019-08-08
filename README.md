## About Project

This project is to import the items in CSV to database and then it displays the total spending amount per-month and per-category. I have used laravel, bootstrap, jquery. I have created two tables,one for categories and one for the items and i have made one to many relation between these two tables. When user uploads CSV file, first i am inserting all categories(unique) into categories table and then adding items to items table with category_id as foreign key. I have used chunk method to import the records in case if CSV contains huge data. 

For front end, i have bootstrap and datatables to show amount per month per category. 



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
    
