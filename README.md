# NRI Web Development Challenge
To better gauge your skills as a web developer, we would like you to complete the following challenge. This will help the interviewers assess your strengths, and frame the conversation through the interview process. Take as much time as you need, however we ask that you not spend more than a few hours. 

We would like to see you use modern php frameworks for the backend. The usual suspects include Laravel, Yii, and Codeigniter. If you prefer NOT to use php frameworks, that is also okay. Simply provide us with reasons for going vanilla php.
For the frontend, please use your favourite frameworks or libararies such as bootstrap, jquery, foundation, vuejs...etc. Again, if you prefer NOT using any, please provide us with reasons as to why.

## Submission Instructions
1. Fork this project on github. You will need to create an account if you don't already have one
2. Complete the project as described below within your fork
3. Push all of your changes to your fork on github and submit a pull request. 

## Project Description
Imagine that NRI has won some items from an auction. From the auctioneer, we have received the item details electronically. We would like to import this dataset into our central inventory system. Your task is to create a simple web interface that will accept a `.csv` file and then store them in a relation database.

### What your web application must do:
1. Your app must accept a comma separated file with the following columns:date, category, lot title, lot location, lot condition, pre-tax amount, tax name, tax amount
2. You can make the following assumptions
     - Columns will always be in that order
     - There will always be data in each column
     - There will always be a header line

 An example input file named `data.csv` is included in this repo.

1. Your app must parse the given file, and store the information in a relational database.
2. After upload, your application should display a table of the total spending amount per-month and per-category.

Your application should be easy to set up, and should run on Linux distros such as ubuntu, centos or debian. It should not require any non open-source software.

There are many ways that this application could be built; we ask that you build it in a way that showcases one of your strengths. If you you enjoy front-end development, do something interesting with the interface. If you like object-oriented design, feel free to dive deeper into the domain model of this problem. We're happy to tweak the requirements slightly if it helps you show off one of your strengths.

Once you're done, please submit a paragraph or two in your `README` about what you are particularly proud of in your implementation, and why.

## Evaluation
Evaluation of your submission will be based on the following criteria. 

1. Did your application fulfill the basic requirements?
2. Did you document the method for setting up and running your application?
3. Did you follow the instructions for submission?
4. Did you style your code in a way that it's easy to read and understand?


## Instruction

First, you need to create the table below in your database:
CREATE TABLE `lot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `lot_condition` varchar(45) DEFAULT NULL,
  `pre_tax_amount` decimal(10,2) DEFAULT NULL,
  `tax_name` varchar(45) DEFAULT NULL,
  `tax_amount` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
);

Then, modify from line 42 to 47 in uploadCSV.php file to build your database connection.

Now, you are ready to go!

In this application, I used Mysql's LOAD DATA INFILE instead of looping sql insert statement through php code, which is much simple and clear way to meet the requirement.
For the front-end, I used bootstrap library which provides a very clean interface.
