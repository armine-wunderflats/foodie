# Foodie API Server

Foodie is an API Server written with Laravel.

## Installation

Make sure you have PHP version >=7.2.5 and [Composer](https://getcomposer.org/download) installed.

1. You can easily set up the MySQL server and PHP by installing [XAMPP](https://www.apachefriends.org/download.html) or [Laragon](https://laragon.org/download/index.html). Please choose version 7.4.14 / PHP 7.4.14.

2. Once the installation has finished, open the control panel and start Apache and MySQl (on XAMPP) or click run all (on Laragon).

3. Add C:\xampp\php in your environment PATH on XAMPP. On Laragon you can do this by going to `Menu` > `Tools` > `Path` > `Add Laragon to Path`.

4. Create a new database and adjust the database name, username and password in the .env.example file.

5. Install composer from [here](https://getcomposer.org/download/).

6. Go to the project folder and run the following commands:

```bash
 composer install
 cp .env.example .env
 php artisan key:generate
 php artisan jwt:secret
 php artisan migrate --seed
```

## Start the Server

```bash
 php artisan serve
```

## Maintaining the Server

1. In order to update the database with the new changes run the following command:

```bash
php artisan migrate
```

2. In order to rollback the database changes run the following command:

```bash
php artisan migrate:rollback
```

3. If you want to rebuild the database, run the following command:

```bash
php artisan migrate:fresh --seed
```

4. In order to update the .env, run `cp .env.example .env`

5. If you wish to clear the application cache, run the following commands:

```bash
php artisan cache:clear
php artisan route:clear
php artisan config:clear
php artisan view:clear
composer clearcache
composer dump-autoload
```

## Useful links

[Spatie Roles and Permissions Documentation](https://spatie.be/docs/laravel-permission/v5/installation-laravel)
[CORS Middleware Documentation](https://github.com/fruitcake/laravel-cors)
[JWT Documentation](https://github.com/tymondesigns/jwt-auth/wiki)
[Dingo Documentation](https://github.com/dingo/api/wiki)
