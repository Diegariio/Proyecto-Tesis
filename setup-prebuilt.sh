#!/bin/bash

# Script para configurar la aplicación Laravel con imagen pre-construida
set -e

echo "🚀 Configurando aplicación Laravel con imagen pre-construida..."

# Función para ejecutar comandos en el contenedor de la app
run_in_app() {
    docker compose exec app "$@"
}

# Esperar a que los contenedores estén listos
echo "⏳ Esperando a que los contenedores inicien..."
sleep 10

# Verificar si existe .env, si no, crear configuración básica
echo "📄 Configurando archivo .env..."
if [ ! -f .env ]; then
    if [ -f .env.docker ]; then
        cp .env.docker .env
    elif [ -f .env.example ]; then
        cp .env.example .env
    else
        # Crear .env básico si no existe
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

# Instalar Composer en el contenedor
echo "📦 Instalando Composer..."
run_in_app curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar dependencias de Composer
echo "📦 Instalando dependencias PHP..."
run_in_app composer install --no-dev --optimize-autoloader --no-interaction

# Instalar Node.js y npm
echo "📦 Instalando Node.js..."
run_in_app apt-get update
run_in_app apt-get install -y nodejs npm

# Instalar dependencias de Node.js y compilar assets
echo "📦 Instalando dependencias Node.js y compilando assets..."
run_in_app npm install
run_in_app npm run build

# Generar APP_KEY si no existe
if ! grep -q "APP_KEY=base64:" .env; then
    echo "🔑 Generando APP_KEY..."
    run_in_app php artisan key:generate --force
fi

# Esperar a que MySQL esté disponible
echo "⏳ Esperando conexión a MySQL..."
while ! run_in_app php artisan tinker --execute="DB::connection()->getPdo();" 2>/dev/null; do
    sleep 2
done
echo "✅ Conexión a base de datos exitosa"

# Ejecutar migraciones
echo "📊 Ejecutando migraciones..."
run_in_app php artisan migrate --force

# Ejecutar seeders
echo "🌱 Ejecutando seeders..."
run_in_app php artisan db:seed --force

# Optimizar aplicación
echo "⚡ Optimizando aplicación..."
run_in_app php artisan config:cache
run_in_app php artisan route:cache
run_in_app php artisan view:cache

# Configurar permisos
echo "🔒 Configurando permisos..."
run_in_app chown -R application:application /app/storage /app/bootstrap/cache
run_in_app chmod -R 775 /app/storage /app/bootstrap/cache

echo "✅ ¡Aplicación configurada correctamente!"
echo "🌐 Puedes acceder en: http://$(hostname -I | awk '{print $1}'):8000"