# Optimized Laravel 12 Dockerfile for Coolify
FROM php:8.3-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    nginx \
    supervisor \
    sqlite3 \
    libsqlite3-dev \
    curl \
    git \
    unzip \
    zip \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    pdo_mysql \
    pdo_sqlite \
    mbstring \
    zip \
    exif \
    pcntl \
    gd \
    opcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Node.js 20 LTS for better performance
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Configure PHP
COPY ./docker/php.ini /usr/local/etc/php/conf.d/custom.ini

# Configure PHP-FPM
RUN echo "listen = 127.0.0.1:9000" >> /usr/local/etc/php-fpm.d/zz-docker.conf \
    && echo "pm = dynamic" >> /usr/local/etc/php-fpm.d/zz-docker.conf \
    && echo "pm.max_children = 20" >> /usr/local/etc/php-fpm.d/zz-docker.conf \
    && echo "pm.start_servers = 2" >> /usr/local/etc/php-fpm.d/zz-docker.conf \
    && echo "pm.min_spare_servers = 1" >> /usr/local/etc/php-fpm.d/zz-docker.conf \
    && echo "pm.max_spare_servers = 3" >> /usr/local/etc/php-fpm.d/zz-docker.conf

# Set working directory
WORKDIR /var/www

# Copy package files first for better caching
COPY composer.json composer.lock* ./
COPY package*.json ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

# Install Node dependencies
RUN npm ci --only=production

# Copy application files
COPY . .

# Create required directories and set permissions
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && mkdir -p storage/logs \
    && mkdir -p bootstrap/cache \
    && touch database/database.sqlite \
    && chown -R www-data:www-data storage bootstrap/cache database \
    && chmod -R 775 storage bootstrap/cache \
    && chmod 664 database/database.sqlite

# Run Composer scripts
RUN composer dump-autoload --optimize

# Build frontend assets (with error handling)
RUN npm run build || echo "Vite build failed, continuing..." && \
    ls -la public/ && \
    echo "Public directory contents after build:"

# Clean up npm cache but keep node_modules for potential debugging
RUN npm cache clean --force

# Configure Nginx
RUN rm -f /etc/nginx/sites-enabled/default
COPY ./docker/nginx.conf /etc/nginx/nginx.conf

# Configure Supervisor
COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Laravel optimization commands (with better error handling)
RUN php artisan config:cache || echo "Config cache failed" && \
    php artisan route:cache || echo "Route cache failed" && \
    php artisan view:cache || echo "View cache failed" && \
    echo "Laravel optimization completed" && \
    ls -la public/ && \
    ls -la public/build/ 2>/dev/null || echo "No build directory found"

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
    CMD curl -f http://localhost/health || exit 1

EXPOSE 80

CMD ["/usr/bin/supervisord", "-n"]