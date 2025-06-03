# PHP Laravel app only (no React build)
FROM php:8.2-fpm

# Install system dependencies including Node.js
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy Laravel files
COPY . /var/www

# Exclude frontend directory to avoid conflicts
RUN rm -rf /var/www/frontend

# Copy Docker-specific .env file
COPY .env.docker .env

# Install dependencies and optimize
RUN composer install --no-interaction --optimize-autoloader

# Generate application key
RUN php artisan key:generate --force

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/public

# Expose port and start server
EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
