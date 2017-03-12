# NRI code Challenge
# Author
  - Shisun(Leo) Xia
  - Date: 2017-03-12

# Technical Specifications
  - BackEnd
    * Framework: Laravel
    * Version: 4.6.*
    * PHP version: 5.6.10
    * Database: MySQL
  - Database Structure
    * user
    * lot
    * lot_category
    * file
    * tax
  - Third-party packages
    * Laravel Excel
  - Tools used
    * Navicat for MySQL
    * MAMP
    * Sublime
    * dilinger.io online MD file editor
  - FrontEnd
    * Jquery
    * Bootstrap
    * Html5

# Deployment
  - Redirect the root of server to public/
  - Create a .env file acording to .env.example file
  - Config config/database.php
  - Run php composer.phar update
  - Run php artisan migrate Or Import db from nri.sql

# Known issue
  - Deleting file from disk does not work

# Future phase
  - Improvements
    * Fixing the file deletion bug
    * The effiency of the file import function could be improved
  - Possible new features
    * Batch operations
    * Graphic report
    * Report export to pdf file
    * User roles

# Challenge
  - As a full time student at U of T, I'm taking 6 courses in this term. It's impossible for me to spent too much time on this code challenge. Under such condition, I designed a website which allows users to import a csv file to the database. During the process, the server is able to automatically break the imported data down to several OO objects. This website also provides user authentication functions and clean graphic user interface.
