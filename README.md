### Readme
## What I'm Proud of
What I'm particularly proud of in my implementation is learning how to use laravel for the first time. I've used php a little bit when trying out Wordpress, but I've never used Laravel or php to this extent. While most of the heavy lifting is done in javascript im still proud that I was able to make a simple server and api in php. I'm also proud of how I was able to use regex to sort the data when there are no headers present. I knew that was going to be a bit tricky to figure out while reading through the instructions. 


## Stack
- Laravel // for the server
- SQLite // for the database
- ReactJS // for the frontend
- SCSS // for styling

### ReactJS Dependencies
- Axios
- Recharts
- React-papaparse

## Main Files To Look AT
### Server
- app\Http\Controllers\LotlogController.php
- app\Http\Resources\LotlogResource.php
- app\Models\Lotlog.php
- routes\api.php
- database\migrations\2023_02_12_190638_create_lotlogs_table.php
- database\database.sqlite

### Client
- basically everything in client/src/components

## How To Setup & Run
1. you will need 2 terminal instances, 1 for the server and 1 for the client.
    - ( if you're on VS Code you can split your terminal using Ctrl + SHIFT + 5 on windows)
2. cd into laravel-react in both terminals 
```  
  cd laravel-react
```  
3. cd into client on whichever terminal you want to be for the client
```  
  cd client
```
4. download the dependencies on both.
    - for the server
    ```
	  composer install
    ```       
    - for the client
    ```
      npm install
    ```       
5. make sure to have a fresh database instance by running the following command on the server teminal
```  
php artisan migrate:refresh
```   
7. start them both up 
    - on the server
    ```
    php artisan serve
    ```
    - on the client
    ```
    npm run dev
    ```

client uses this address and port- http://127.0.0.1:3000/

## How to Use
1. Simply check the checkbox if the csv file has no headers and leave it empty if it does
2. Click "Browse file" and select your csv file.
3. Hit "Submit"


## How To View Database
I used a VS code extention called "SQLite Viewer" to see the Database straight in VS Code.

You can view the raw data by going to http://127.0.0.1:8000/api/lotlogs while the server is running.

You can also use postman to view the data in a prettier format, but you may need the desktop agent for postman since this is a local database.  
-Ensure the server is running  
-On postman set the method to GET and the request url to http://127.0.0.1:8000/api/lotlogs
