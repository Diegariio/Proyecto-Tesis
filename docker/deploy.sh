#!/bin/bash

# Script de despliegue automático para Sistema Oncológico
# Uso: ./docker/deploy.sh

set -e

echo "🚀 Iniciando despliegue del Sistema Oncológico..."
echo "================================================"

# Verificar que Docker esté disponible
if ! command -v docker &> /dev/null; then
    echo "❌ Error: Docker no está instalado"
    exit 1
fi

if ! command -v docker-compose &> /dev/null; then
    echo "❌ Error: Docker Compose no está instalado"
    exit 1
fi

# Detener contenedores previos si existen
echo "🛑 Deteniendo contenedores existentes..."
sudo docker-compose down 2>/dev/null || true

# Limpiar contenedores huérfanos
echo "🧹 Limpiando contenedores huérfanos..."
sudo docker-compose down --remove-orphans 2>/dev/null || true

# Dar permisos al script de inicio
echo "🔒 Configurando permisos..."
chmod +x docker/start.sh

# Construir las imágenes
echo "🔨 Construyendo imágenes Docker..."
sudo docker-compose build --no-cache

# Levantar los servicios
echo "🚀 Iniciando servicios..."
sudo docker-compose up -d

# Esperar a que los servicios estén listos
echo "⏳ Esperando que los servicios estén listos..."
sleep 5

# Mostrar estado de los contenedores
echo "📊 Estado de los contenedores:"
sudo docker-compose ps

# Obtener la IP local
LOCAL_IP=$(hostname -I | awk '{print $1}')

echo ""
echo "✅ ¡Despliegue completado exitosamente!"
echo "================================================"
echo "🌐 Acceso a la aplicación:"
echo "   • Local: http://localhost:8000"
echo "   • Red:   http://$LOCAL_IP:8000"
echo ""
echo "🗄️ Acceso a phpMyAdmin:"
echo "   • Local: http://localhost:8080"
echo "   • Red:   http://$LOCAL_IP:8080"
echo ""
echo "🔑 Credenciales de base de datos:"
echo "   • Usuario: oncologia_user"
echo "   • Contraseña: oncologia_pass_2025"
echo "   • Base de datos: sistema_oncologico_docker"
echo "   • Puerto externo: 3307 (interno: 3306)"
echo ""
echo "👥 Usuarios de la aplicación:"
echo "   • admin@test.com / password"
echo "   • doctor@test.com / password"
echo "   • enfermera@test.com / password"
echo "   • radioterapeuta@test.com / password"
echo ""
echo "📝 Para ver los logs:"
echo "   sudo docker-compose logs -f app"
echo ""
echo "🛑 Para detener:"
echo "   sudo docker-compose down"
echo "================================================"