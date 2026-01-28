FROM php:8.2-fpm

# Instalar dependencias necesarias
RUN docker-php-ext-install pdo pdo_mysql
