# Simple Laravel API example

**Setup instructions:**

1) Create an `.env` file in the project root based on `.env.example`
2) Set database parameters in `.env` file and create database
3) Specify `APP_URL` in `.env`
4) Run `composer install`
5) Run `chmod -R 777 storage/`
6) Run `php artisan key:generate`
7) Run `php artisan migrate` to create database structure
8) Run `php artisan db:seed` to create default user `test` with password `test`
9) Run `php artisan passport:install` to create oauth secret keys
10) Run `vendor/bin/phpunit` to run tests
