# ----------------------------------------
# 1. Build Frontend Assets
# ----------------------------------------
FROM node:18-alpine AS frontend

WORKDIR /app

# Copy package files
COPY package*.json ./

# Install dependencies
RUN npm ci --only=production=false

# Copy source code
COPY . .

# Install PHP for composer (needed for Livewire dependencies)
RUN apk add --no-cache php81 php81-phar php81-json php81-curl php81-openssl php81-zip

# Install composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Install PHP dependencies for frontend build
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Build frontend assets
RUN npm run build

# ----------------------------------------
# 2. Production PHP Container
# ----------------------------------------
FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    supervisor \
    sqlite3 \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql pdo_sqlite mbstring zip exif pcntl gd

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Add custom php.ini
COPY ./docker/php.ini /usr/local/etc/php/conf.d/custom.ini

# Set working directory
WORKDIR /var/www

# Copy composer files first
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy application files
COPY . .

# Copy built assets from frontend stage
COPY --from=frontend /app/public/build ./public/build

# Set proper permissions
RUN chown -R www-data:www-data /var/www \
    && find /var/www -type f -exec chmod 644 {} \; \
    && find /var/www -type d -exec chmod 755 {} \; \
    && chmod -R 775 /var/www/storage \
    && chmod -R 775 /var/www/bootstrap/cache \
    && chmod 755 /var/www/artisan

# Run composer scripts
RUN composer run-script post-autoload-dump

# Prepare Laravel directories
RUN mkdir -p storage/framework/{views,sessions,cache} \
    && mkdir -p bootstrap/cache \
    && touch storage/logs/laravel.log \
    && touch database/database.sqlite \
    && chown -R www-data:www-data storage bootstrap/cache database/database.sqlite \
    && chmod -R 775 storage bootstrap/cache \
    && chmod 664 database/database.sqlite

# Configure PHP-FPM
RUN echo "listen = 127.0.0.1:9000" >> /usr/local/etc/php-fpm.d/zz-docker.conf

# Laravel Artisan commands
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Configure Nginx and Supervisor
RUN rm -f /etc/nginx/sites-enabled/default
COPY ./docker/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Expose port
EXPOSE 80

# Start services
CMD ["/usr/bin/supervisord", "-n"]