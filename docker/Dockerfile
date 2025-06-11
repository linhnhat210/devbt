FROM php:8.2-fpm

# Cài đặt các thư viện cần thiết
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip pdo_mysql bcmath opcache

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Thư mục làm việc trong container
WORKDIR /var/www

# Copy toàn bộ mã nguồn vào container
COPY . .

# Thiết lập quyền truy cập cho storage
RUN chown -R www-data:www-data storage bootstrap/cache

# Cài đặt các dependencies Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Expose cổng PHP-FPM
EXPOSE 9000
