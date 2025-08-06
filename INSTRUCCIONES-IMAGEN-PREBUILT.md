# 🐳 Instrucciones para usar imagen pre-construida (Sin Build)

Esta alternativa evita completamente el proceso de build usando una imagen PHP+Apache ya preparada.

## 🚀 Comandos para ejecutar en el otro PC

### 1. Clonar y actualizar el repositorio
```bash
git clone https://github.com/Diegariio/Proyecto-Tesis.git
cd Proyecto-Tesis
git checkout diegoDev
git pull origin diegoDev
```

### 2. Levantar servicios con imagen pre-construida
```bash
# Usar docker-compose con override (sin build)
docker compose -f docker-compose.yml -f docker-compose.override.yml up -d

# Ver que los contenedores estén corriendo
docker compose ps
```

### 3. Configurar la aplicación automáticamente
```bash
# Ejecutar script de configuración
./setup-prebuilt.sh

# O manualmente si el script falla:
# docker compose exec app composer install --no-dev --optimize-autoloader
# docker compose exec app npm install && npm run build
# docker compose exec app php artisan key:generate --force
# docker compose exec app php artisan migrate --force
# docker compose exec app php artisan db:seed --force
```

### 4. Obtener URL de acceso
```bash
MY_IP=$(hostname -I | awk '{print $1}')
echo "🌐 Aplicación: http://$MY_IP:8000"
echo "🗄️ phpMyAdmin: http://$MY_IP:8080"
```

## 🔍 Verificar que funciona

```bash
# Ver estado de contenedores
docker compose ps

# Ver logs de la aplicación
docker compose logs -f app

# Probar acceso web
curl http://localhost:8000
```

## 🛠️ Comandos útiles

### Acceder al contenedor de la app
```bash
docker compose exec app bash
```

### Ejecutar comandos Laravel
```bash
# Limpiar caché
docker compose exec app php artisan cache:clear

# Ver rutas
docker compose exec app php artisan route:list

# Ver migraciones
docker compose exec app php artisan migrate:status
```

### Parar servicios
```bash
docker compose down
```

### Reiniciar si hay problemas
```bash
docker compose restart app
```

## 🎯 Ventajas de esta opción

✅ **No necesita build** - Usa imagen pre-construida
✅ **Más rápido** - No compila dependencias del sistema  
✅ **Más confiable** - Evita problemas de repositorios apt
✅ **Fácil debug** - Se puede acceder fácilmente al contenedor

## 🔧 Si algo falla

### Problema con permisos
```bash
docker compose exec app chown -R application:application /app
docker compose exec app chmod -R 775 /app/storage /app/bootstrap/cache
```

### Problema con base de datos
```bash
# Verificar conexión
docker compose exec app php artisan tinker --execute="DB::connection()->getPdo();"

# Re-migrar si es necesario
docker compose exec app php artisan migrate:fresh --seed --force
```

### Problema con assets
```bash
# Recompilar assets
docker compose exec app npm run build
```

## 📝 Notas importantes

- Esta configuración usa la imagen `webdevops/php-apache:8.2`
- PHP, Apache, y extensiones ya están preinstaladas
- Solo necesita instalar Composer, Node.js y dependencias del proyecto
- Los datos de la base de datos se mantienen persistentes