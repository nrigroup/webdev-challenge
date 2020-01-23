# About the Project

This app can use to import details of the CSV file to the Database
This app accept only CSV file if you try to upload any other file type it will throw an error
A maximum file size set to 2MB 
If you want to change the Maximum file size you can change it in ImportCsvController file
This app only accept a comma separated file with the following columns:
date, category, lot title, lot location, lot condition, pre-tax amount, tax name, tax amount

## I have made the following assumptions

Columns will always be in that order
There will always be data in each column
There will always be a header line

You can use the same file which you have provided as an example input file named data.csv 

I have used bootstrap with some custom styles

## Main Files of the Project

## Controller
ImportCsvsController.php
ImportCsvsController has three methods
1)index() - which displays the file input form
2)showData() - which calls the showData() method of model and pass the records to the records view
3)uploadFile() - which check the file and process the file data and insert them to the table

## Model
Csv.php
Csv Model file has two methods 
1)insertData() - To insert data in to the table
2)showData() - To retrieve data from the table

## Views
Index.blade.php (Home page with file upload form)
records.blade.php (Report Page)
app.blade.php (layout view inside layout folder)

## Step to Setup the Project
1) Create database for the project
2) Change database details in .env file
3) run "php artisan migrate" command to create table
4) set the DocumentRoot and ServerName in httpd-vhosts.conf in apache configuration file
