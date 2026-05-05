FROM php:8.3-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    icu-dev \
    zip \
    unzip \
    bash

# Install PHP extensions required by CodeIgniter 4
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl mysqli

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html
