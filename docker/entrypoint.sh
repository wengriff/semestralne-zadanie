#!/bin/bash
if [ ! -f "vendor/autoload.php"]; then
composer install --no progress --no-interaction
fi

if [ ! -f ".env"]; then
    echo "Creating env file for env $APP_ENV"
else
    echo "env file exists."
fi

php artisan key:generate
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan migrate:fresh

php artisan db:seed
php artisan serve --port=$PORT --host=0.0.0.0 --env=.env
exec docker-php-entrypoint "$@"