# Setup instruction
1. Checkout the project.
2. Create a `.env` file under the project folder.
3. Generate App_Key by `php artisan key:generate`.
4. Setup local database connection parameter. For example, in my laptop, the setting is
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nri_app
DB_USERNAME="YOUR DATABASE USERNAME"
DB_PASSWORD="YOUR DATABASE PASSWORD"
```
5. Update `SESSION_DRIVER=cookie`, since I am using ReactJS to build frontend app.