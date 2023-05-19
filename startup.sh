#!/bin/sh

sed -i "s,LISTEN_PORT,$PORT,g" /etc/nginx/nginx.conf

php-fpm -D

# while ! nc -w 1 -z 127.0.0.1 9000; do sleep 0.1; done;

cd src
php artisan migrate
php artisan key:generate 
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan passport:install

cd -
nginx