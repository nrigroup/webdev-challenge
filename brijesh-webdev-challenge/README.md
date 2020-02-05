##How to configure locally

1. Download composer https://getcomposer.org/download/
2. Download & install XAMPP on local machine (XAMPP is cross-platform and available for Windows, MAC OSX and Linux operating system). Refer link https://www.apachefriends.org/download.html
3. In XAMPP application folder "xampp", open option "xampp-control", having type application, for starting Apache server and MySQL database.
4. In regards to create database "webdev_challenge" in Mysql database, open phpMyAdmin through that same XAMPP control panel and navigate to MySQL database.
5. Open terminal, navigate to htdocs folder of xampp.
6. Clone webdev-challenge Git repository
7. Navigate to folder "brijesh-webdev-challenge" in order to prepare the running mode of this challenge; Laravel framework is initialized in this folder.
8. Run ```composer install``` or ```php composer.phar install```
9. Run ```php artisan key:generate```
10. Rename .env.example file to .env inside folder "brijesh-webdev-challenge" and fill the database information. See the below note#2.
11. Run ```php artisan migrate``` to create relevant tables of this challenge in MySQL database "webdev_challenge".
12. Run ```php artisan serve```, this command will generate url to serve application on browser. ```OR``` The application also serves on browser through this given url "http://localhost/webdev-challenge/brijesh-webdev-challenge/public/".

##Notes:
1. MySQL default credentials are:
      1. Hostname: localhost
      2. Username: root
      3. Password: 
      4. Port: 3306
2. Configure or verify the following MySQL parameters in .env file which is located under path "XAMPP/htdocs/webdev-challenge/brijesh-webdev-challenge":
     ```
     DB_CONNECTION=mysql
     DB_HOST=localhost
     DB_PORT=3306
     DB_DATABASE=webdev_challenge
     DB_USERNAME=root
     DB_PASSWORD=
     ```
     
##Proud moment

I successfully completed this task by recalling my knowledge of Laravel as I haven't touched Laravel for 1.4 years because I had been working on Wordpress, React.js which were the major needs of my previous employer (King Business Development Solutions). The successfulness of this challenge shows one of the mandatory trait of developer i.e developer must able to adapt new technologies, tools, environments, etc quickly.  
