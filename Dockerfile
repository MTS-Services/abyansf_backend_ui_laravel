# Simple Laravel Dockerfile
FROM php:8.3-fpm

# Install basic system packages
RUN apt-get update && apt-get install -y \
    nginx supervisor sqlite3 curl git unzip \
    libpng-dev libjpeg62-turbo-dev libfreetype6-dev libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql pdo_sqlite mbstring zip exif pcntl gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Node.js 18 (LTS)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Custom PHP configuration
COPY ./docker/php.ini /usr/local/etc/php/conf.d/custom.ini

# Set working directory
WORKDIR /var/www

# Copy and install PHP dependencies first
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy and install Node dependencies
COPY package*.json ./
RUN npm ci

# Copy all files
COPY . .

# Run post-install scripts and build assets
RUN composer run-script post-autoload-dump && npm run build

# Set up Laravel
RUN mkdir -p storage/framework/{views,sessions,cache} bootstrap/cache \
    && touch database/database.sqlite \
    && chown -R www-data:www-data storage bootstrap/cache database \
    && chmod -R 775 storage bootstrap/cache \
    && chmod 664 database/database.sqlite

# Configure services
RUN echo "listen = 127.0.0.1:9000" >> /usr/local/etc/php-fpm.d/zz-docker.conf \
    && rm -f /etc/nginx/sites-enabled/default

COPY ./docker/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Laravel commands
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

EXPOSE 80
CMD ["/usr/bin/supervisord", "-n"]