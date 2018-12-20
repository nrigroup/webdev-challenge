# NRI Web Development Challenge by Zhili Xu

## Environment and Instructions
1. The MVC environment which I used to build the challenge is Laravel version 5.6. 
2. I installed two more dependencies to help me finshed the challenge, which are "Laravel Forms & HTMl" (https://laravel.com/docs/4.2/html) and "Laravel-excel.maatwebsite" (version 2.1)
3. There are two views of my implementation, both of them are using the "app.blade.php" layout to keep it consistent. Under the "import" view, users can submit csv files, after successfully submitted the file, users can view their data under the "table" view.   

## Highlights of the Project 
1. The project views are well-structured. It contains three folders, in the layout folders, it contains the layout structure of the project, which can be reused. The pages folder contains views that extend the layout structure, which keep the whole project style consistent. The inc folder contains addition features can is used across multiple pages. I believe this view structure improve the readability of the project and can be easily reuse in the future. 
2. The project has two relational database, one is storing the filename that users submitted, and the other is storing the attribute in the file. The reason that I created two database is to prevent users submitted duplicate files. If users submitted files with same filename, the entry will not be recored and error message will promt. If users submit files with different filename, the entry will be recorded with unique filename id. 

