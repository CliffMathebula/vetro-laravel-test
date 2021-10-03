Instruction on Deploying this project on LAMP:<br/>
In this instruction i hope you have set up LAMP.


Requirements:

PHP 8.40.10<br/>
Database: Apache2, MySQL

Before cloning the application you'll have to install git and composer on your server: <br/>
Execute the following commands to install git and composer:<br/>

$ sudo apt-get update<br/>
$ sudo apt-get install git composer -y<br/>

Once the installation is done, clone the git repository, use the following :<br/>
Before cloning navigate to the director where you want to clone project to, in my case its /var/www/html:<br/>

$ cd /var/www/html <br/>
$ git clone https://github.com/CliffMathebula/vetro-media-php-test.git<br/>

Install PHP dependencies:<br/>
composer install

Install JavaScript dependencies (Optional):<br/>
Run only if you would like to make changes to the front-end<br/>

create a new Database.

Update the .env file and generate an encryption key:<br/>
Open .env.example and change the database name, database username and password.<br/>
Then rename .env.example to .env(use the following commands):<br/>

$ cp .env.example .env<br/>
$ php artisan key:generate <br/>

run migration:<br/>
php artisan migrate<br/>

start the application:<br/>
php artisan serve<br/>

License This application is a open-source software licensed under the MIT license.<br/>
You are free modify it, republish, sell or make any copies<br/>

Time Spent to create the application is an estimation of 12 to 15 hours.
