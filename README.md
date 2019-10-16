# NRI Web Development Challenge


## Laravel 6

### Setup

```
composer install
```

This command will take care of installing the necessary libraries to run Laravel 6 on a PHP7 platform.

### Configuration
Please copy .env.example to .env and modify the necessary variables such as:
```
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

#### Application Key
The next thing you should do after installing Laravel is set your application key to a random string by running. 
```php artisan key:generate``` command.

Once the database is configured, you need to run database migration by entering :
```
php artisan migrate
```
This command will create tables and their necessary fields to run this application.

You can view the website by using build in PHP server by running the command below
```
php artisan serve
```
#### Directory Permissions
After installing Laravel, you may need to configure some permissions. Directories within the storage and the bootstrap/cache directories should be writable by your web server or Laravel will not run.

Please note : CSV file gets uploaded to ``` storage/app/uploads ``` folder. This folder is not accessible via the public and will be ignored by git, make sure this folder has appropriate permission to read/write by the application.

### Development
For development, clone this repository and run the following commands.

```composer install```
This command will install the necessary PHP libraries to run the laravel framework.

```npm install && npm run watch```
This command will install necessary javascript libraries to work with the Vue frontend framework and listen for any changes to javascript or SCSS files.
