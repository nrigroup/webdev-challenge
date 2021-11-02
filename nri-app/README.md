## System requirement
* PHP 8.0.10 
* MySql 8.0.26
## Setup instruction
1. Create a local database schema, i.e. `nri_app`
1. Checkout the project.
1. Create a `.env` file under the project folder.
1. Run `composer update` to install laravel 3rd party libraries.
1. Generate App_Key by `php artisan key:generate`.
1. Setup local database connection parameter. For example,
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nri_app
DB_USERNAME="YOUR DATABASE USERNAME"
DB_PASSWORD="YOUR DATABASE PASSWORD"
```
7. Create app database tables 
```
>> cd nri-app
>> php artisan migrate
```
8. Update `SESSION_DRIVER=cookie`, since I am using ReactJS to build frontend app.
1. Update log setting to use Laravel daily log, `LOG_CHANNEL=daily` (optional)
1. Run `npm install` to install ReactJS dependency library.
1. Run `npm run prod` (optional).
1. Run `php artisan serve` to start local server.

## Features
* Since we don't know the number of date could be presented in data files, we add pagination on bar chart by only showing 5 dates per page, please drag left or right to scroll forward or backward to check more data items.
* We integrate login/registration module by using Laravel authentication facilities. You can click __Register__ on top right corner to create an account. Obviousely, different user should only view his/her own dataset. 

## Data file 
* Based on challenge description, _Column names may or may not exist and may nota be in that order specified above (there will always be a headline/row)_, the following data file is regarded as invalid since the number of headline column does not match with dataset.
```
date,category,lot title,lot location,lot condition,pre-tax amount,,
12/01/2013,Construction,Hauling Transfer Trailers,"783 Park Ave, New York, NY 10021",Brand New,350,NY Sales tax,31.06
12/15/2013,Construction,Roll-of trucks,"1 Infinite Loop, Cupertino, CA 95014",Like Brand New,235,CA Sales tax,17.63
```
However, the optional columns can be ignored. So the following data file is valid, since both column name and column value are truncated. In this example, tax name, tax amount are ignored.
```
category,date,pre-tax amount,lot title,lot location,lot condition
Construction,12/01/2013,350,Hauling Transfer Trailers,"783 Park Ave, New York, NY 10021",Brand New
Construction,12/15/2013,235,Roll-of trucks,"1 Infinite Loop, Cupertino, CA 95014",Like Brand New
```
* Duplicate item. Since there is no requirement mentioned about how to avoid duplicate item in the challenge, we regard all items as unique. Once upload file successfully, we save all data into RDB directly.
