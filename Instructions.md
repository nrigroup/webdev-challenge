# NRI Web Development Challenge

To better gauge your skills as a web developer, we would like you to complete the following challenge. This will help the interviewers assess your strengths, and frame the conversation through the interview process. Take as much time as you need, however we ask that you not spend more than a few hours.

You can use any framework to complete the challenge. For the frontend, please use your favourite frameworks or libararies such as bootstrap, jquery, foundation, vuejs...etc. If you prefer NOT using any, please provide us with reasons as to why. However, here at NRI, we use Laravel, Bootstrap & jQuery, and it would help us to evaluate what we know and use.

Bonus points if you can deploy and give us a demo link.

## Submission Instructions

1. Fork this project on github. You will need to create an account if you don't already have one
2. Complete the challenge within your fork after reading below details.
3. Push all of your changes to your fork on github and submit a pull request.

## Project Description

Imagine that NRI has won some items from an auction. From the auctioneer, we have received the item details electronically. We would like to import this dataset into our central inventory system. Your task is to create a simple web interface that will accept a `.csv` file and then store them in a relation database.

### What your web application must do:

1. Observe MVC structure in your code.
2. Show a simple, attractive web interface that allows users to upload a file.
3. Gets the uploaded csv file, parses it and saves it into a RDB.
4. After saving into the RDB, the "dashboard" displays a simple report - the total amount (pre tax amount) per day in a bar graph, as well as two pie charts displaying the overall total (pre tax amount) per category and total per condition.
5. These are the basic requirements of this challenge. Other features you implement will count as bonus.

- Your app must accept a comma separated file with the following columns:date (required), category (required), lot title (required), lot location (required), lot condition (required), pre-tax amount (required), tax name, tax amount
- Please keep mind of the following:
  - Column names may or may not exist and may nota be in that order specified above (there will always be a headline/row)
  - There may or may not be data in each column in the data (required fields must have data)

An example input file named `data.csv` is included in this repo. However, we may or may not use the same data file to test your work.

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

## What's Next?

Once when you have submitted your work we will review your submission as soon as possible.

Please note we will only contact the selected candidates for further consideration.

We thank you for taking the time to complete this development challenge and appreciate your interest in pursuing a career with NRI.

## What I'm using

Laravel(php)
SQLite(SQLite viewer extention to view db straight in VS code)
ReactJS
papa parse, axios
