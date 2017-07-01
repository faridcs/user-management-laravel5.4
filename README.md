# user-management-laravel5.4
User Manager With Laravel 5.4

### Installation
To install, you must follow steps below:


1. Clone it from GitHub:

       git clone git@github.com:faridcs/user-management-laravel5.4.git

2. Install Composer packages:

       composer install
        
3. Migrate && Seed:
        
       php artisan migrate:refresh --seed
        
4. Run tests:

       ./vendor/bin/phpunit
       
5. Rename .env.example to .env and edit these lines to:

       DB_HOST=localhost
       DB_DATABASE=usermanager
       DB_USERNAME=root
       DB_PASSWORD=root