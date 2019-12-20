# Samer NRI Web Challenge

## Lightweight Webapp
I was going to build a simple lightweight web application for this challenge. It was not going to be Laravel as I have not used it in over 5 years. I maintained the seperation of Model View Controller in my lightweight webapp. You can run the index.php file in the root directory for that app. 
App structure:
index.php: The view to take user input
assets/js/main.js: Ajax to send uploaded file to server and process returned data from server to pass to view
src/csv-handler.php: Main backend, establish connection, stores and fetches data from DB

## Laravel Framework
I took 3 hours to learn more about the new version of Laravel. Suprisingly enough I found it very simple to understand. So I continued with another version of the challenge using Laravel. Maybe the greatest challenge I faced was figuring out the DataTypes returned by Laravel API. I managed to create a closure function on the route ('/csv-upload') Where the model Purchase is called to insert and fetch data. The Router closure also prepares the response object to be sent back to the client.
You can find the Laravel version of the challenge in the directory ('/web-challenge'). You can CD into it and run the command ("php artisan serve") to serve the application

I hope you find my code easy to follow

Samer Alotaibi