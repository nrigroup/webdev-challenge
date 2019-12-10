# NRI Web Development Challenge

## Steps to run project

This project runs in a WAMP environment. 

1. Clone project into wamp64/www or xampp/htdocs for XAMP
2. Set virtual host in httpd-vhosts.conf file 
3. Modify windows hosts file and set DocumentRoot to C:/wamp64/www/webdev-challenge/nri-app/public/ with an alias of your choosing
4. `cd` into webdev-challenge/nri-app folder and run `composer install`
5. Next run `php artisan migrate`
6. Enter localhost address in browser (from windows hosts file)

If there are any difficulties with set up, I followed this Youtube video closely: https://www.youtube.com/watch?v=H3uRXvwXz1o&list=PLillGF-RfqbYhQsN5WMXy6VsDMKGadrJ-&index=2

If there are still problems, please feel free to contact me at ernest.vincent.villa@gmail.com, thanks!

## Project Description
First off, thank you for the challenge and for considering me for the open position. What I am particularly proud of about my submission is that it has a clean stylish frontend and the code is well structured. I spent time thinking about a folder structure that is simple yet robust to code base growth.  I'm proud of how efficiently I finished the project since I was tight on time the past few days. I meant to add a section underneath to display all filtered auction items in the dashboard page as a bonus feature, but ran out of time. Also, I could have set up a more structured form validation system, but I'm happy with balancing it off with other areas I spent more effort in such as blade templating, try/catch for server error and organizing global and page specific js/css. Hopefully my quality of code meets the expectations of NRI, thank you again and hope to hear some feedback.


