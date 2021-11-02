## Setup instruction
1. Checkout the project.
2. Create a `.env` file under the project folder.
3. Run `composer update` to install laravel 3rd party library
4. Generate App_Key by `php artisan key:generate`.
5. Setup local database connection parameter. For example, in my laptop, the setting is
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nri_app
DB_USERNAME="YOUR DATABASE USERNAME"
DB_PASSWORD="YOUR DATABASE PASSWORD"
```
6. Update `SESSION_DRIVER=cookie`, since I am using ReactJS to build frontend app.
7. Run `npm install` to install ReactJS dependency library.
8. Run `php artisan serve` to start local server.

## Data file 
* Based on challenge description, _Column names may or may not exist and may nota be in that order specified above (there will always be a headline/row)_, the following data file is regarded as invalid since the number of headline column does not match with dataset.
```
date,category,lot title,lot location,lot condition,pre-tax amount,,
12/01/2013,Construction,Hauling Transfer Trailers,"783 Park Ave, New York, NY 10021",Brand New,350,NY Sales tax,31.06
12/15/2013,Construction,Roll-of trucks,"1 Infinite Loop, Cupertino, CA 95014",Like Brand New,235,CA Sales tax,17.63
```