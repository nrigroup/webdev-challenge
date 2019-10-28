
# Installation Guide
1. Clone or download repository into your local or live environment including the hidden ones(.env)(LAMP, WAMP, XAMPP).
2. Prepare your destination computer as in http://laravel.com/docs/
3. Check you have all the necessary PHP extensions available in php.ini and also watchout for PHP version!
4. Install composer https://getcomposer.org/doc/00-intro.md.
5. Open cmd, Git bash or terminal at project root folder and install composer "composer install" this will install all laravel vendors in your source code.
6. Generate new key for app " php artisan key:generate".
7. Clear cache  " php artisan cache:clear " from command line.
8. Run commad " php artisan serve " to run your project [Make sure port 8000 on your system is free].
9. Change database configuration in your .env file.
10. Go to browser search for url "localhost:8000" or "127.0.0.1:8000" [If local] otherwise http://{[your_domain] or [your_ip]}:8000   


## what you are particularly proud of in your implementation, and why? 
Gnerally i use Maatwebsite packege for data import/export releted solutions but this time i have decided to parse files on my own logic which is not as dynamic as current packege we are using but i had fun with it and enjoyed the process. 

Thank you for giving me fun coding challenge.
Hope i will here from you in future.