## Project Description
Note: I did not have any prior experience working with Laravel Framework. I set up Homestead locally and created the boilerplate Laravel application and went from there.

In terms of this implementation, I included an 'Uploads' table to identify who was uploading what data and what items were inserted with that specific upload. This is an important feature as it allows staff to audit the data that's coming in. For example, if there was an error in the data for a specific time period, you could easily delete any items that were associated with that specific upload. In addition to that, one can also track which user uploaded the data. For the purposes of this project, I used IP address as the identifier rather than going through the process of user authentication/creation.

Adding onto that, when the application is importing the data to the database, everything is done on a transactional basis. As a result, if the file fails at processing on a specific row, the database will rollback any changes made to the database. This is another important factor when importing data as you would not want half-completed files in the database with no idea where the file left off.

There were no requirements or limitations that stated that the data had to be unique and, with that in mind, no checks were put into place to check for this. A potential issue with this is that duplicate data may enter the database with no form of verification.

Upon a successful import of a CSV file, the user is re-directed to an Upload page that shows a summary of the items and a detailed list of the items. A backup of each CSV file is stored in the storage/apps/logs folder. The filename is stored in the Uploads table as well.

[CSV](http://csv.thephpleague.com/) was used to parse incoming CSV files.

## Installation Instructions
1) Install and configure Homestead on local machine. Edit the .env as necessary based on machine's configurations. The following lines in .env need to be updated if MySQL configuration details are different.  

```DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

2) Copy all files to Homestead's public folder.  
3) Once files are copied over, you will need to run: php artisan migrate to create the necessary MySQL tables.  