Instruction on Deploying this project on LAMP:
In this instruction i hope you have set up LAMP.


Requirements:

PHP 8.40.10
Database: Apache2, MySQL

Before cloning the application you'll have to install git and composer on your server: 
Execute the following commands to install git and composer:

$ sudo apt-get update
$ sudo apt-get install git composer -y

Once the installation is done, clone the git repository, use the following :
Before cloning navigate to the director where you want to clone project to, in my case its /var/www/html:

$ cd /var/www/html <br/>
$ git clone https://github.com/CliffMathebula/vetro-media-php-test.git

Install PHP dependencies:
composer install

Install JavaScript dependencies (Optional):
Run only if you would like to make changes to the front-end

create a new Database.

Update the .env file and generate an encryption key:
Open .env.example and change the database name, database username and password.
Then rename .env.example to .env(use the following commands):

$ cp .env.example .env
$ php artisan key:generate 

run migration:
php artisan migrate

start the application:
php artisan serve

License This application is a open-source software licensed under the MIT license.
You are free modify it, republish, sell or make any copies


Time Spent to create the application is an estimation of 12 to 15 hours.
