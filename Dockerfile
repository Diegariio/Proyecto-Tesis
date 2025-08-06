FROM php:8.2-fpm

# Instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip git unzip curl libonig-dev libxml2-dev \
    npm nodejs mariadb-client \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Instala Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copia el código
COPY . .

# Instala dependencias PHP y JS
RUN composer install --no-interaction --prefer-dist --optimize-autoloader
RUN npm install && npm run build
RUN apt-get install -y netcat-traditional
# Permisos para Laravel (ANTES del CMD)
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Crea script de inicio
COPY docker/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

EXPOSE 9000

CMD ["/usr/local/bin/start.sh"]