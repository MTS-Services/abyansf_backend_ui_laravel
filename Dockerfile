# ----------------------------------------
# 1. Composer Dependencies
# ----------------------------------------
FROM composer:2 AS vendor
WORKDIR /var/www

# Copy composer files only for caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Copy the whole app (so migrations, configs etc. are available later)
COPY . .


# ----------------------------------------
# 2. Build Frontend
# ----------------------------------------
FROM node:20 AS node_builder
WORKDIR /var/www

# Copy package files first (for caching)
COPY package*.json ./
RUN npm install

# Copy rest of project & build frontend
COPY . .
RUN npm run build


# ----------------------------------------
# 3. PHP Backend Runtime
# ----------------------------------------
FROM php:8.3-fpm

# Install required system packages
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
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install pdo_mysql mbstring zip exif pcntl gd \
 && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Add custom php.ini
COPY ./docker/php.ini /usr/local/etc/php/conf.d/custom.ini

# Set working directory
WORKDIR /var/www

# Copy application source
COPY . .

# Copy vendor from composer stage
COPY --from=vendor /var/www/vendor ./vendor

# Copy built frontend assets from node stage
COPY --from=node_builder /var/www/public/build ./public/build

# Ensure Laravel storage and cache dirs exist & set permissions
RUN mkdir -p storage/framework/{views,sessions,cache} \
    && mkdir -p bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Run Laravel optimization commands
RUN php artisan config:clear \
 && php artisan route:clear \
 && php artisan view:clear \
 && php artisan config:cache \
 && php artisan route:cache \
 && php artisan view:cache \
 && php artisan migrate --force || true \
 && php artisan optimize:clear

# Configure Nginx & Supervisor
RUN rm -f /etc/nginx/sites-enabled/default
COPY ./docker/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Expose HTTP port
EXPOSE 80

# Start Supervisor (manages php-fpm + nginx)
CMD ["/usr/bin/supervisord", "-n"]
