web: vendor/bin/heroku-php-nginx -C nginx_app.conf /public
worker: php artisan queue:work redis --tries=3 --deamon