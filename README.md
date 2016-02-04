# Installation Instructions
clone or download the repository
run composer install
renamme .env.exampl to .env
edit .env updating to the correct settings for your server environment, especially the database settings
run php artisan migrate
ensure the following directories and all there sub directories are writable by the web server user
/storage
/bootstrap/cache

# About my application
I chose to use Laravel framework for this application.  A framework is well suited to this task and Laravel is actually the only php framework I've used.  I like it's syntax and style, it makes for very clean code.  For the theme, I used a simple bootstrap admin theme called sbadmin2.  My design skills are very limited, so I prefer to use someone elses design and this design is simple, but clean and functional.

For the file upload, I decided to be a bit more creative.  I used a javascript plugin called dropzone.  It allows for multi upload and for drag and drop uploads.  It uses ajax to upload the files.  So I set up the page to allow you to upload multiple files, the click submit to process all of the uploaded files.  Once processed it clears the files.  I thought this was a more modern and user friendly way to upload and process these files.  I also made use of league/flysystem for managing the files on the filesystem and league/csv for parsing the csv file.

When I started the project, I had intended to add authentication as well, but I just didn't have enough time to get that far.  I have built full admin panels with authentication using laravel previously.  One of these uses the composer package cartalyst/sentry in Laravel 4, another was using Laravel 5 and authenticating against another system by doing api calls.

This was a fun project, this is just the sort of thing I enjoy working on and the sort of tools I like to use.

# NRI Web Development Challenge
To better gauge your skills as a web developer, we would like you to complete the following challenge. This will help the interviewers assess your strengths, and frame the conversation through the interview process. Take as much time as you need, however we ask that you not spend more than a few hours. 

We would like to see you use modern php frameworks for the backend. The usual suspects include Laravel, Yii, and Codeigniter. If you prefer NOT to use php frameworks, that is also okay. Simply provide us with reasons for going vanilla php. However, we do prefer to see your work done in some frameworks.
For the frontend, please use your favourite frameworks or libararies such as bootstrap, jquery, foundation, vuejs...etc. Again, if you prefer NOT using any, please provide us with reasons as to why.

## Submission Instructions
1. Fork this project on github. You will need to create an account if you don't already have one
2. Complete the project as described below within your fork
3. Push all of your changes to your fork on github and submit a pull request. 

## Project Description
Imagine that NRI has won some items from an auction. From the auctioneer, we have received the item details electronically. We would like to import this dataset into our central inventory system. Your task is to create a simple web interface that will accept a `.csv` file and then store them in a relation database.

### What your web application must do:
1. Show a simple, attractive web interface that allows users to upload a file.
2. Gets the uploaded csv file, parses it and saves it into a RDB.
3. After saving into the RDB, displays the total spending amount per-month and per-category.
4. These are the basic requirements of this challenge. Other features you implement will count as bonus.

* Your app must accept a comma separated file with the following columns:date, category, lot title, lot location, lot condition, pre-tax amount, tax name, tax amount
* You can make the following assumptions
     - Columns will always be in that order
     - There will always be data in each column
     - There will always be a header line

 An example input file named `data.csv` is included in this repo.

Your application should be easy to set up, and should run on Linux distros such as ubuntu, centos or debian. It should not require any non open-source software.

There are many ways that this application could be built; we ask that you build it in a way that showcases one of your strengths (OOP, clean interface, clean code, extensible code, high code quailty, beautiful frontend...etc). If you you enjoy front-end development, do something interesting with the interface. If you like object-oriented design, feel free to dive deeper into the domain model of this problem. We're happy to tweak the requirements slightly if it helps you show off one of your strengths.

Once you're done, please submit a paragraph or two in your `README` about what you are particularly proud of in your implementation, and why.

## Evaluation
Evaluation of your submission will be based on the following criteria. 

1. Did your application fulfill the basic requirements?
2. Did you document the method for setting up and running your application?
3. Did you follow the instructions for submission?
4. Did you style your code in a way that it's easy to read and understand?
5. Did you go above and beyond? (Did your submission surprise us?)
6. Did you maintain clean code (indentation, comments, naming conventions)

## Note
Please submit clean code with proper indentation. Understand that the first thing we do is  
read your code, not run your code. If you fail to keep consistant indentation and  
the best practices in defining your functions and variable names, chances are  
we will not need to run your code to evaluate your skills.

