FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    curl \
    git \
    unzip \
    zip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install zip pdo pdo_mysql mbstring

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy file
COPY . .

# Install Dependency
RUN composer install
RUN cp .env.example .env
RUN chmod -R 777 storage bootstrap/cache
RUN php artisan key:generate

# Copy nginx config
COPY nginx.conf /etc/nginx/nginx.conf

# Expose ports
EXPOSE 80

# Jalankan
ENTRYPOINT ["/bin/sh", "./entrypoint.sh"]
