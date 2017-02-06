1. Import into nri_task.sql and create new user with all permissions.
2. config/database.php change mysql credential to new ones created. 
(Note: I am using Wamp on my machine and env was not working correctly. 
So instead of wasting valuable time on super bowl Sunday on that, 
I decided to remove env from config/database.php)
3. You can use php artisan serve on local from laravel folder or user direct link http://localhost/nri/laravel/public/

This was the first time I have used laravel. I have prior experience with Zend and Codeigniter MVCs.
I read some of the documentation, and I enjoyed working with laravel. 
Blades easy template management definitely felt superior to me compared to Zends.
The documentation was also much better than Zends. 
I could have optimized the table structure a lot by normalization, in particular the categories column, by creating new table for it.
But felt this simple structure was fine for this task.
If I had more time I would use laravel server side forms and validation functionality, migration tables and ofcourse other functionalities I'll learn about once I review the laravel documentation more thoroughly.
