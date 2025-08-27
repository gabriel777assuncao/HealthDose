FROM php:8.4.1-fpm-alpine

WORKDIR /var/www/html

COPY src .

RUN apk add --no-cache postgresql-dev && \
    apk add --no-cache --virtual .build-deps \
    autoconf \
    gcc \
    g++ \
    make \
    linux-headers

RUN docker-php-ext-install pdo pdo_pgsql

RUN pecl install redis && docker-php-ext-enable redis

RUN apk del .build-deps

RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel

COPY docker-files/artisan.sh /usr/local/bin/artisan
RUN chmod +x /usr/local/bin/artisan

USER laravel