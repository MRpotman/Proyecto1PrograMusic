FROM php:8.2-cli

WORKDIR /var/www/html

# Instalar dependencias incluyendo libsqlite3-dev
RUN apt-get update && apt-get install -y \
    curl zip unzip git libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar proyecto
COPY . .

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Permisos
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 10000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]