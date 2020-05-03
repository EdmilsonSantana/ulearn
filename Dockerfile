FROM composer as build

WORKDIR /ulearn

COPY composer.json /ulearn/

RUN composer global require hirak/prestissimo --no-plugins --no-scripts && \ 
    composer install --prefer-dist --no-scripts --no-autoloader && \
    rm -rf /root/.composer

COPY . /ulearn

RUN composer dump-autoload --optimize

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

RUN chown -R www-data:www-data /var/www/html/

VOLUME /var/www/html

CMD php artisan migrate:refresh --seed && apache2-foreground



