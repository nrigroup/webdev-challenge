# Julius Mayiga's Solution to NRI Web Development Challenge
I chose to use CodeIgniter to complete this challenge. I also added some mix of CSS and jQuery.

## Setup Instructions
1. Create a new database
2. Import nri.sql
3. In the nri folder go to application/config/database.php and provide your database credentials, i.e host, database, password, username 
4. Upload the entire nri folder to web server you are using. If your server address is http://localhost/ then to access the system you will have to type http://localhost/nri in the address bar of the browser of your choice. The system basically has two pages i.e "Upload" - http://localhost/nri and "expenses" - http://localhost/nri/inventory/expenses

NOTE: If you want to install the system in any other folder then you will have to make some changes to the .htaccess file to match the new location.

## Code Files
1. application/controllers/Inventory.php
2. application/models/Db_nri.php
3. assets/css/nri.css
4. assets/js/nri.js

## What I am Proud of With My Solution
Iam particularly the way I structured the database, well optimized storing data in a way that can easily enable retrieval of data important data that can be used in decision making.
