# ----------------------------------------
# Multi-stage build for Laravel with starter kits
# ----------------------------------------
FROM php:8.3-fpm

# Add custom php.ini file
COPY ./docker/php.ini /usr/local/etc/php/conf.d/custom.ini

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
    gnupg2 \
    ca-certificates \
    # Add Node.js repository
    && curl -fsSL https://deb.nodesource.com/setup_lts.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl gd

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy composer files first for better caching
COPY composer.json composer.lock ./

# Install PHP dependencies first (this makes vendor/livewire available)
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy package.json files for better caching
COPY package*.json ./

# Install Node.js dependencies
RUN npm ci --production=false

# Copy all application files
COPY . .

# Run composer scripts after copying all files
RUN composer run-script post-autoload-dump

# Build frontend assets (now vendor/livewire is available)
RUN npm run build

# Prepare Laravel cache paths & permissions
RUN mkdir -p storage/framework/{views,sessions,cache} \
    && mkdir -p bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Laravel Artisan commands
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && php artisan migrate --force || true \
    && php artisan optimize:clear

# Configure Nginx and Supervisor
RUN rm -f /etc/nginx/sites-enabled/default
COPY ./docker/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Expose HTTP port
EXPOSE 80

# Start all services
CMD ["/usr/bin/supervisord", "-n"]