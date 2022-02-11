#!/usr/bin/env bash

cd /vagrant/www

# Install dependency package
composer install

# Init laravel
php artisan key:generate
php artisan migrate
