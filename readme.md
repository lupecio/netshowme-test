# Netshowme Test

## Installation

To install dependencies run command:

```bash
composer install
```

## Config

Create a new file called .env, copy the content of .env.example and set the information from your database.

Run command to generate key:
```bash
php artisan key:generate
```
Run migrations:
```bash
php artisan migrate
```

Update mail username and password with your credentials on .env file.

## Test

Change name of the test database on phpunit.xml file.

Command to run tests:
```bash
phpunit
```
