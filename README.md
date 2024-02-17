# MEMVERA
<p>
<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About MEMVERA
The Memvera Marketing Campaign Module is ...

## Domain

[memvera.com](http://memvera.com).

## Requirements
- PHP 8.x
- Composer


## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`API_KEY`
`MAIL_MAILER`
`MAIL_HOST`
`MAIL_PORT`
`MAIL_USERNAME`
`MAIL_PASSWORD`
`MAIL_ENCRYPTION`
`MAIL_FROM_ADDRESS`

## Mailtrap Account for Test

[mailtrap.io](https://mailtrap.io/)

- Email    : softwarehouse0405@gmail.com
- Password : 123456789

## Deployment

```bash
composer install
copy .env.local .env
php artisan migrate
php artisan db:seed
php artisan key:generate
php artisan serve
php artisan schedule:work
```


## Admin info

- Email    : admin@gmail.com
- Password : 123456

<p>
© 2022 MEMVERA
