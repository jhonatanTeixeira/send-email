FROM php:7.2-alpine

RUN docker-php-ext-install pdo pdo_mysql

COPY ./ /var/www

WORKDIR /var/www