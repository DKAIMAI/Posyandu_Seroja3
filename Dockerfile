# Gunakan image resmi PHP dengan ekstensi yang dibutuhkan Laravel
FROM php:8.2-fpm

# Install ekstensi dan tools tambahan
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project Laravel ke container
COPY . /var/www/html

WORKDIR /var/www/html

RUN composer install --no-dev --optimize-autoloader

# Jalankan Laravel menggunakan built-in PHP server
CMD php artisan serve --host=0.0.0.0 --port=8080
