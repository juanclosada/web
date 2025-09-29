FROM php:7.4-fpm

# Instalar extensiones necesarias para MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

WORKDIR /var/www/html
