# BYC Web Setup
#### Setup instructions for installing the BYC Laravel Web App
---
### Clone the repository
```
git clone https://github.com/kevineger/BYC-Web
```
### Install dependencies with composer
```
composer install
```
This must be done from the root (/BYC-Web) directory where the `composer.json` file is located. For learning how to use composer, watch this [laracasts video](https://laracasts.com/series/laravel-5-fundamentals/episodes/1).

### Setup Environment Variables
Create a file name `.env` in the root director (/BYC-Web). Copy paste [this sample](https://raw.githubusercontent.com/laravel/laravel/master/.env.example) `.env` to start.

### Configure MySql
Setup a MySql database and user and fill in the `.env` fields accordingly (see fields listed below)
- DB_HOST=
- DB_DATABASE=
- DB_USERNAME=
- DB_PASSWORD=

For development, set DB_HOST to localhost

### Configure MailGun
Fill in the necessary `.env` fields for hooking up a 3rd party mail service. The recommended MailGun use case fields are listed below.
- MAIL_DRIVER=mailgun
- MAILGUN_DOMAIN=
- MAILGUN_SECRET=
- MAIL_HOST=smtp.mailgun.org
- MAIL_USERNAME=
- MAIL_PASSWORD=
- 
### Configure PayPal
Fill in the necessary `.env` fields for PayPal. The client and secret IDs can be changed at any time for deployment/testing purposes and environments.
- PAYPAL_CLIENT_ID=
- PAYPAL_SECRET=

#### Migrate database
```
php artisan migrate:install
php artisan migrate --seed
```
To refresh migrations with seeds, run:
```
php artisan migrate:refresh --seed
```
### Run the web server
```
php artisan serve
```
To learn more about Laravel, visit [laracasts.com](http://laracasts.com). The intro series is really good for learning the main features of laravel, it can be found [here](https://laracasts.com/series/laravel-5-fundamentals).
