# NRI Webdev challenge: Inventory CSV

This is build completely with laravel. I didn't use any frontend js frameworks because I haven't built a full stack app with laravel in some time so I thought it would be best to forego using a js framework and recap my laravel knowledge. I have other projects on my github that display my JS framework knowledge/skills if that needs to be examined.

## Instructions
1. Clone the repo and cd into it
2. make a relational Database (DB) named anything
3. edit ```.env``` to set DB credentials
    * set ```DB_DATABASE``` to the name from step 2
    * set ```DB_USERNAME``` to your DB's username
    * set ```DB_PASSWORD``` to your DB's password
    * set any other DB credentials that may be different from the default
4. run the command ```php artisan migrate``` to migrate the DB ```inventories``` table
5. run the command ```php artisan serve``` to serve the app and go to the address displayed
6. upload a valid ```.csv``` file
7. watch the magic happen

## Key Files
* ```routes/web.php``` : has the endpoints
* ```resources/views/``` : folder with all the pages, layouts, and partials
* ```app/NRI/CsvParser.php``` : the csv parser
* ```app/Http/Controllers/InventoryController.php```: responsible for displaying Inventory data
* ```app/Http/Controllers/UploadController.php```: responsible for uploading csv data to DB
* ```app/Inventory.php```: the Inventory model of the csv data
