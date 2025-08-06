# Dockerfile para Laravel con Apache
FROM php:8.2-apache

# Configurar variables de entorno
ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=America/Santiago

# Instalar dependencias del sistema con múltiples intentos y mejor manejo de errores
RUN apt-get clean && rm -rf /var/lib/apt/lists/* && \
    for i in 1 2 3 4 5; do \
        echo "Intento $i de instalación de dependencias..." && \
        apt-get update --fix-missing --allow-releaseinfo-change && \
        apt-get install -y --no-install-recommends \
            ca-certificates \
            curl \
            wget \
            gnupg \
            lsb-release \
        && break || { echo "Intento $i falló, reintentando en 10 segundos..."; sleep 10; } \
    done && \
    apt-get install -y --no-install-recommends \
        git \
        unzip \
        zip \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libonig-dev \
        libxml2-dev \
        libzip-dev \
        mariadb-client \
    && rm -rf /var/lib/apt/lists/* \
    && apt-get clean

# Configurar extensiones de GD
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Instalar Node.js y npm con manejo robusto de errores
RUN for i in 1 2 3; do \
        echo "Intento $i de instalación de Node.js..." && \
        curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
        apt-get update && \
        apt-get install -y --no-install-recommends nodejs && \
        break || { echo "Intento $i de Node.js falló, reintentando..."; sleep 5; } \
    done && \
    node --version && npm --version

# Instalar extensiones PHP
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    opcache

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite headers

# Instalar Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Configurar directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY . /var/www/html/

# Crear directorios necesarios
RUN mkdir -p /var/www/html/storage/logs \
    && mkdir -p /var/www/html/storage/framework/cache \
    && mkdir -p /var/www/html/storage/framework/sessions \
    && mkdir -p /var/www/html/storage/framework/views \
    && mkdir -p /var/www/html/bootstrap/cache

# Instalar dependencias de Composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Instalar dependencias de Node.js y compilar assets
RUN npm install && npm run build

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Copiar script de inicio
COPY docker/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

# Configurar Apache DocumentRoot
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Exponer puerto 80
EXPOSE 80

# Comando de inicio
CMD ["/usr/local/bin/start.sh"]