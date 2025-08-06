# 🐳 Despliegue Docker - Sistema Oncológico

## 📋 Requisitos Previos
- Docker y Docker Compose instalados
- Puerto 80 disponible en el servidor
- Puerto 3306 disponible (MySQL)
- Puerto 8080 disponible (phpMyAdmin)

## 🚀 Instrucciones de Despliegue

### 1. Clonar el proyecto
```bash
git clone <tu-repositorio>
cd Proyecto-Tesis
```

### 2. Configurar variables de entorno
```bash
# Copiar el archivo de configuración
cp .env.example .env

# Editar las variables importantes:
nano .env
```

### 3. Construir y levantar los contenedores
```bash
# Construir las imágenes
docker-compose build --no-cache

# Levantar los servicios (esto automáticamente crea la BD, migra y llena datos)
docker-compose up -d

# Ver los logs para seguir el proceso de inicialización
docker-compose logs -f app
```

**⚡ Lo que sucede automáticamente al hacer `docker-compose up -d`:**
1. 🗄️ Crea la base de datos `sistema_oncologico_docker`
2. 👤 Crea el usuario `oncologia_user` con permisos completos
3. 📊 Ejecuta todas las migraciones de Laravel
4. 🌱 Llena la base de datos con los seeders (datos de prueba)
5. 🚀 Inicia la aplicación web

Todo el proceso es **completamente automático** - no necesitas ejecutar comandos adicionales.

### 4. Verificar el funcionamiento
- **Aplicación web**: http://IP_SERVIDOR
- **phpMyAdmin**: http://IP_SERVIDOR:8080
- **Base de datos**: IP_SERVIDOR:3306

## 🔧 Comandos Útiles

### Ver estado de contenedores
```bash
docker-compose ps
```

### Ver logs
```bash
# Logs de la aplicación
docker-compose logs -f app

# Logs de MySQL
docker-compose logs -f mysql
```

### Reiniciar servicios
```bash
# Reiniciar todo
docker-compose restart

# Reiniciar solo la app
docker-compose restart app
```

### Ejecutar comandos Laravel
```bash
# Acceder al contenedor
docker-compose exec app bash

# Ejecutar migraciones
docker-compose exec app php artisan migrate

# Ejecutar seeders
docker-compose exec app php artisan db:seed

# Limpiar caché
docker-compose exec app php artisan cache:clear
```

### Parar y eliminar todo
```bash
# Parar contenedores
docker-compose down

# Parar y eliminar volúmenes (CUIDADO: borra la BD)
docker-compose down -v
```

## 🔒 Credenciales por Defecto

### Base de datos MySQL (Nueva - Docker)
- **Host**: mysql (dentro de Docker) o IP_SERVIDOR:3306 (externo)
- **Base de datos**: sistema_oncologico_docker
- **Usuario**: oncologia_user
- **Contraseña**: oncologia_pass_2025
- **Root password**: root_docker_2025

### phpMyAdmin
- **URL**: http://IP_SERVIDOR:8080
- **Usuario**: oncologia_user
- **Contraseña**: oncologia_pass_2025

### Usuarios de la aplicación
Los usuarios se crean automáticamente con el seeder:
- **admin@test.com** / password (Administrador)
- **doctor@test.com** / password (Doctor)
- **enfermera@test.com** / password (Enfermera)
- **radioterapeuta@test.com** / password (Radioterapeuta)

## 🌐 Acceso desde otros dispositivos

Para acceder desde otros dispositivos en la misma red:

1. **Obtener la IP del servidor**:
   ```bash
   ip addr show | grep inet
   ```

2. **Configurar el firewall** (si es necesario):
   ```bash
   # Ubuntu/Debian
   sudo ufw allow 80
   sudo ufw allow 8080
   
   # CentOS/RHEL
   sudo firewall-cmd --permanent --add-port=80/tcp
   sudo firewall-cmd --permanent --add-port=8080/tcp
   sudo firewall-cmd --reload
   ```

3. **Acceder desde otros dispositivos**:
   - Aplicación: http://IP_DEL_SERVIDOR
   - phpMyAdmin: http://IP_DEL_SERVIDOR:8080

## 🐛 Solución de Problemas

### Error de permisos
```bash
sudo chmod +x docker/start.sh
sudo chown -R $USER:$USER storage bootstrap/cache
```

### Error de puertos ocupados
```bash
# Ver qué usa el puerto 80
sudo netstat -tulpn | grep :80

# Cambiar puerto en docker-compose.yml si es necesario
# ports: - "8000:80" # Cambia 80 por 8000
```

### Reconstruir desde cero
```bash
docker-compose down -v
docker system prune -a
docker-compose build --no-cache
docker-compose up -d
```

## 📝 Notas Adicionales

- Los datos de la base de datos se persisten en un volumen Docker
- Los logs de Laravel están en `/var/www/html/storage/logs/`
- Para producción real, cambiar las contraseñas en docker-compose.yml
- El contenedor se reinicia automáticamente si se detiene