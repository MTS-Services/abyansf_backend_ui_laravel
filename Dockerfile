# ----------------------------------------
# 1. Build Frontend
# ----------------------------------------
FROM node:latest AS node_builder

# Set the working directory inside the container
WORKDIR /var/www

# Copy all project files into the container
COPY . .

# Copy the Composer executable into the node_builder stage
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies with Composer to generate the vendor directory
# This is required so the 'livewire/flux' CSS file can be moved in the next step
RUN composer install --no-dev --optimize-autoloader

# Move Livewire Flux CSS from the newly created vendor directory to the resources directory
RUN cp ./vendor/livewire/flux/dist/flux.css ./resources/css/livewire-flux.css

# Install npm dependencies and run the frontend build
RUN npm install && npm run build

# ----------------------------------------
# 2. Build PHP backend
# ----------------------------------------
FROM php:8.3-fpm

# Add custom php.ini file
COPY ./docker/php.ini /usr/local/etc/php/conf.d/custom.ini

# Install system dependencies required for the application
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
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory for the final image
WORKDIR /var/www

# Copy Laravel app source
COPY . .

# Copy built frontend assets from the node_builder stage
COPY --from=node_builder /var/www/public/build public/build

# Prepare Laravel cache paths & permissions
RUN mkdir -p storage/framework/{views,sessions,cache} \
    && mkdir -p bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Install PHP dependencies (again, in the final stage)
RUN composer install --no-dev --optimize-autoloader

# Run Laravel Artisan commands to clear and cache configurations
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

# Start all services with Supervisor
CMD ["/usr/bin/supervisord", "-n"]
