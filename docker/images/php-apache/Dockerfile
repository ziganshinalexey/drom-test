FROM php:7.3-apache

RUN apt-get update && \
    apt-get install -y mc && \
    docker-php-ext-install mysqli && \
    a2enmod rewrite

WORKDIR /var/www