FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libxml2-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_mysql mbstring tokenizer xml zip
