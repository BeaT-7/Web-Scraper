Call scraper command: php artisan app:scrape-hacker-news



====SETUP====
    composer install

    copy .env.example .env

    Setup DBconnections:
    DB_CONNECTION=mysql  //set connection to mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=laravel  //choose database, username and password as you want
    DB_USERNAME=sail
    DB_PASSWORD=password

    ./vendor/bin/sail up

    ./vendor/bin/sail artisan key:generate

    ./vendor/bin/sail bash

    npm install

    php artisan migrate
