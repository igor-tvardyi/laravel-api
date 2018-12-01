# Simple Laravel API example

**Setup instructions:**

1) Create an `.env` file in the project root based on `.env.example`
2) Set database parameters in `.env` file and create database
3) Run `php artisan migrate` to create database structure
4) Run `php artisan db:seed` to create default user `test` with password `test`
5) Run `php artisan passport:install` to create oauth secret keys
6) Run `vendor/bin/phpunit` to run tests
