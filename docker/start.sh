#!/bin/bash

# Script de inicio para Laravel
set -e

echo "🚀 Iniciando aplicación Laravel..."

# Esperar a que MySQL esté disponible
echo "⏳ Esperando conexión a MySQL..."
while ! mysqladmin ping -h mysql --silent; do
    sleep 1
done
echo "✅ MySQL está disponible"

# Verificar si existe .env, si no, crear configuración básica
if [ ! -f .env ]; then
    echo "📄 Creando archivo .env..."
    if [ -f .env.docker ]; then
        cp .env.docker .env
    elif [ -f .env.example ]; then
        cp .env.example .env
    else
        # Crear .env básico si no existe .env.example
        cat > .env << 'EOF'
APP_NAME="Sistema Oncológico"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_TIMEZONE=America/Santiago
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=sistema_oncologico_docker
DB_USERNAME=oncologia_user
DB_PASSWORD=oncologia_pass_2025

CACHE_STORE=database
SESSION_DRIVER=database
QUEUE_CONNECTION=database
LOG_CHANNEL=stack
LOG_LEVEL=error
EOF
    fi
fi

# Generar APP_KEY si no existe
if ! grep -q "APP_KEY=base64:" .env; then
    echo "🔑 Generando APP_KEY..."
    php artisan key:generate --force
fi

# Verificar conexión a la base de datos
echo "🔍 Verificando conexión a la base de datos..."
php artisan tinker --execute="DB::connection()->getPdo();" || {
    echo "❌ Error: No se puede conectar a la base de datos"
    exit 1
}
echo "✅ Conexión a base de datos exitosa"

# Verificar si las tablas ya existen (para evitar re-migrar)
TABLES_COUNT=$(php artisan tinker --execute="echo DB::select('SHOW TABLES')[0]->{'Tables_in_sistema_oncologico_docker'} ?? 0;" 2>/dev/null | tail -1)

if [ -z "$TABLES_COUNT" ] || [ "$TABLES_COUNT" = "0" ]; then
    echo "📊 Base de datos vacía. Ejecutando migraciones..."
    php artisan migrate --force || {
        echo "❌ Error en migraciones"
        exit 1
    }
    echo "✅ Migraciones completadas"
    
    echo "🌱 Ejecutando seeders para datos iniciales..."
    php artisan db:seed --force || {
        echo "❌ Error en seeders"
        exit 1
    }
    echo "✅ Seeders completados"
else
    echo "📊 Base de datos ya contiene tablas. Omitiendo migraciones iniciales..."
    echo "🔄 Ejecutando migraciones pendientes (si las hay)..."
    php artisan migrate --force
fi

# Limpiar caché antes de optimizar
echo "🧹 Limpiando caché..."
php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true
php artisan view:clear || true

# Optimizar para producción
echo "⚡ Optimizando aplicación..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Configurar permisos finales
echo "🔒 Configurando permisos..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "✅ Aplicación Laravel lista!"

# Iniciar Apache
exec apache2-foreground