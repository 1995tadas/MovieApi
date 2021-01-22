# Movie search website

It's just a simple website for showing trending movies.

Search bar lets you find your favorite movie from large movie database 

## DEMO

https://tadassapitavicius.com/movies

## Data sources

The Movie Database (TMDb) API:
https://developers.themoviedb.org/3


## Technologies used

- Php 7.2
- Laravel 7.30.3
- VueJs 2.6.11
- MySql 8.0.22
- Sass 1.26.10
- Composer 2.0.8 for php packages
- NodeJs 6.14.11 for npm packages

## How to deploy

1. Copy all files from this repo
1. Make sure you have right technologies installed
1. Copy .env.example and rename it to .env (if you using unix operating system just run this command in app root `mv .env.example .env`)
1. Run `composer install` and `npm install`(needed dependencies will be installed)
1. Compile all VueJs, sass and other files by `npm run dev ` or `npm run watch` for development,`npm run prod` for production
1. Then run `php artisan key:generate`


