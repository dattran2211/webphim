# 1. Base image PHP + các extension cần thiết
FROM php:8.2-fpm

# 2. Cài các gói cần thiết
RUN apt-get update && apt-get install -y \
    git curl zip unzip nginx \
    libpng-dev libonig-dev libxml2-dev libzip-dev \
    libpq-dev libcurl4-openssl-dev

# 3. Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Cài Node.js 18
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# 5. Đặt thư mục làm việc
WORKDIR /var/www

# 6. Copy toàn bộ project vào container
COPY . .

# 7. Cài Laravel backend
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# 8. Cài frontend - Cách FIX CHẮC CHẮN
RUN npm install && \
    npm install resolve-url-loader@^5.0.0 --save-dev --legacy-peer-deps && \
    npm run build || npm run build

# 9. Set quyền cho Laravel
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

# 10. Mở cổng
EXPOSE 8000

# 11. Chạy Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
