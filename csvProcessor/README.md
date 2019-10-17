# CSV import
#### Author: Jiaqing Zhu
#### Github page: github.com/dreamrukia
#### Email: dreamrukia@hotmail.com

---

## How to compile:
```console
composer install
npm install
npm run dev
php artisan migrate
php artisan serve
```
Then copy and paste the url to the browser.

## How to use:

1. On the home page, you can see the data currently in database. (As the first run of this server, *No data* will be display.)
2. Click on the Import CSV button, which will navigate you to the upload page.
3. Choose a csv file you want to upload. Click Upload.
4. The summary of the csv file will be shown on the screen.
5. Click back button on top left corner, which will navigate you back to home page. You can see you file has successfully imported to the database.

## Features I used in this project:

- Front-end: blade template, jquery and bootstrap 4, installed with npm.
- Use sqlite database to avoid database set up problems (feel free to replace to any databases that Laravel support by modify the **.env** file).
- Use artisan migrate helps to easily migrate the RDB.
- Use model to CRUD the data in RDB, which can help migrate to other DB engine.
- Follow the MVC design pattern, struct the project clearly.
- Compile front-end code and sass with npm. 


*Note:*

This is my first time using PHP Laravel framework. I can feel the power for this framework. There are so many new things to learn. I have used some of my previous experiences (like Node.js, Spring Boot, etc) while learning Laravel, but I may make some mistakes when using this framework. Please feel free to tell me what I did wrong, or where I could improve. Thanks you very much.
