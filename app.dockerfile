FROM php:7.2-fpm

RUN apt-get update && apt-get install -y libmcrypt-dev default-mysql-client libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && pecl install mcrypt-1.0.1 \
    && docker-php-ext-enable mcrypt
