FROM php:8.2.1-fpm

RUN apt-get -y update && apt-get -y upgrade
RUN apt-get install -y \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN docker-php-ext-install pdo pdo_pgsql && docker-php-ext-enable pdo_pgsql


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY ../../app /var/www/html

RUN composer install
RUN composer --version


RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache


CMD ["php-fpm"]
