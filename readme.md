Set up the Application:

This is a fairly standard Laravel application.  If running locally you can run on Homestead by :

1.  Set up Homestead as per: https://laravel.com/docs/5.5/homestead
2.  Clone the github repo into a directory on your local machine (~/Desktop/Laravel/nri).
3.  From your Homestead directory, edit the Homestead.yaml file and add under folders:
    - map: ~/Desktop/Laravel/nri
       to: /home/vagrant/Code/nri
4.  In the Homestead.yaml add under sites:        
    - map: nri
       to: /home/vagrant/Code/nri/public
5.  Under databases add:
    - nri
6.  Edit your /etc/hosts and add the line:
    192.168.10.10   nri
7.  Reprovision the vagrant box with vagrant --provision
8.  Go to the Homestead directory and ssh to the box (vagrant ssh)
9.  Connect to the homestead box with a tool like Sequel Pro and set up the empty nri database
10. Set up a user to access the database with the default Laravel username: homestead and password: secret
11. CD to the /Code/nri folder and run the migrations with php artisan migrate
12. Go to http://nri in your browser.

With this application I was trying to stick as closely as possible to Laravel conventions and keep it clean.  I think 
that the code is somewhat self-documenting as with any good code, and that it should be fairly obvious without extensive
use of comments what each function does.  I tried to stick to using the Eloquent ORM as much as possible as well, and 
then pick it up with collections where the ORM falls down a bit.  Otherwise I tried to follow Laravel process as well, 
using npm to manage the assets through Laravel Mix and webpack (with the results already commited to the repo).

I also used ajax pagination in the index view, since there wasn't much Javascript being used in the rest of the web app.

Anyway, I would be happy to answer any further questions that you might have.

Craig Garrett