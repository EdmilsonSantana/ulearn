FROM composer as build

WORKDIR /ulearn

COPY composer.json /ulearn/

RUN composer update --prefer-dist --no-scripts --no-dev --no-autoloader

COPY . /ulearn

RUN composer dump-autoload --no-scripts --no-dev --optimize

FROM php:apache-stretch

COPY --from=build /ulearn /var/www/html

RUN apt-get update && apt-get install -y \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
	&& docker-php-ext-install -j$(nproc) iconv \
	&& docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
	&& docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql

RUN a2enmod rewrite

VOLUME /var/www/html

CMD php artisan migrate && php artisan db:seed && php artisan storage:link && apache2-foreground



