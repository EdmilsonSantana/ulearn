FROM composer as build

WORKDIR /ulearn

COPY composer.json /ulearn/

RUN composer update --prefer-dist --no-scripts --no-dev --no-autoloader

COPY . /ulearn

RUN composer dump-autoload --no-scripts --no-dev --optimize

FROM php:apache-stretch

COPY --from=build /ulearn /var/www/html

RUN a2enmod rewrite && docker-php-ext-install pdo_mysql

CMD php artisan migrate && php artisan db:seed && apache2-foreground



