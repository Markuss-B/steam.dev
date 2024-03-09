#!/bin/bash

if [ ! -f ".env" ]; then
    echo "Creating env"
    cp .env.example .env
    composer install --no-progress --no-interaction
    php artisan key:generate
    php artisan migrate
    php artisan db:seed
    npm install
else
    echo "env file exists."
fi