# Multi-stage build
# Stage 1: Build React app
FROM node:20-alpine AS react-builder

WORKDIR /app
COPY frontend/package*.json ./
RUN npm install

COPY frontend/ ./
RUN npm run build

# Stage 2: PHP Laravel app
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

# Copy React build from previous stage
COPY --from=react-builder /app/dist /var/www/public/react

# Generate .env file from example
RUN cp .env.example .env

# Update .env file
RUN sed -i 's/DB_HOST=127.0.0.1/DB_HOST=db/g' .env && \
    sed -i 's/DB_USERNAME=root/DB_USERNAME=laravel/g' .env && \
    sed -i 's/DB_PASSWORD=/DB_PASSWORD=secret/g' .env

# Install dependencies and optimize
RUN composer install --no-interaction --optimize-autoloader

# Generate application key
RUN php artisan key:generate --force

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/public

# Expose port and start server
EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
