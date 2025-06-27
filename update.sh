#!/bin/sh

php artisan down

git pull

composer install --no-dev --optimize-autoloader
npm ci

php artisan migrate
npm run build

php artisan up
