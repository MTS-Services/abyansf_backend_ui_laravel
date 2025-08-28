# ----------------------------------------
# 1. Composer Dependencies
# ----------------------------------------
# Use a specific version of Composer for more predictable builds
FROM composer:2 AS vendor
WORKDIR /var/www

# Copy composer files only for caching, then install dependencies
COPY composer.json composer.lock ./
[cite_start]RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts [cite: 118]

# Copy the rest of the application source code
COPY . [cite_start]. [cite: 118]


# ----------------------------------------
# 2. Build Frontend
# ----------------------------------------
FROM node:20 AS node_builder
WORKDIR /var/www

# Copy package files first for caching, then install dependencies
COPY package*.json ./
[cite_start]RUN npm install [cite: 118]

# Copy the rest of the application source code
COPY . [cite_start]. [cite: 120]

# --- FIX ---
# Copy the vendor directory from the composer stage.
# This makes assets from PHP packages available to the Vite build process.
COPY --from=vendor /var/www/vendor ./vendor
# --- END FIX ---

# Build the frontend assets
[cite_start]RUN npm run build [cite: 120]


# ----------------------------------------
# 3. PHP Backend Runtime
# ----------------------------------------
FROM php:8.3-fpm

# Install required system packages and PHP extensions
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
 [cite_start]&& rm -rf /var/lib/apt/lists/* [cite: 121]

# Install Composer from the official image
[cite_start]COPY --from=composer:2 /usr/bin/composer /usr/bin/composer [cite: 121]

# Add custom php.ini (ensure this file exists in ./docker/php.ini)
[cite_start]COPY ./docker/php.ini /usr/local/etc/php/conf.d/custom.ini [cite: 121]

# Set working directory
WORKDIR /var/www

# Copy application source from the build context
COPY . [cite_start]. [cite: 122]

# Copy vendor directory from the dedicated composer stage
[cite_start]COPY --from=vendor /var/www/vendor ./vendor [cite: 122]

# Copy built frontend assets from the node stage
[cite_start]COPY --from=node_builder /var/www/public/build ./public/build [cite: 122]

# Create Laravel storage directories and set correct permissions
RUN mkdir -p storage/framework/{views,sessions,cache} \
    && mkdir -p bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    [cite_start]&& chmod -R 775 storage bootstrap/cache [cite: 122]

# Run Laravel optimization commands for production
RUN php artisan config:clear \
 && php artisan route:clear \
 && php artisan view:clear \
 && php artisan config:cache \
 && php artisan route:cache \
 && php artisan view:cache \
 && php artisan migrate --force || true \
 [cite_start]&& php artisan optimize:clear [cite: 123]

# Configure Nginx & Supervisor (ensure these files exist in ./docker/)
RUN rm -f /etc/nginx/sites-enabled/default
[cite_start]COPY ./docker/nginx.conf /etc/nginx/nginx.conf [cite: 123]
[cite_start]COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf [cite: 123]

# Expose the HTTP port
[cite_start]EXPOSE 80 [cite: 123]

# Start Supervisor, which manages both nginx and php-fpm
[cite_start]CMD ["/usr/bin/supervisord", "-n"] [cite: 123]