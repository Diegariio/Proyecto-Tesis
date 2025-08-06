# ⚙️ Configuración del Proyecto - Sistema Oncológico

## 📁 Archivos de Configuración

### `.env.example` - Configuración de Desarrollo Local
Este archivo contiene la configuración base para desarrollo local:
- Base de datos MySQL local (127.0.0.1:3306)
- Debug habilitado
- Logs en nivel debug
- Configuración de desarrollo

### `.env.docker` - Configuración para Docker
Este archivo contiene la configuración específica para el entorno Docker:
- Base de datos MySQL en contenedor (mysql:3306)
- Debug deshabilitado
- Logs en nivel error
- Configuración de producción

## 🚀 Instrucciones de Configuración

### Para Desarrollo Local (sin Docker)
```bash
# 1. Copiar el archivo de ejemplo
cp .env.example .env

# 2. Generar la clave de aplicación
php artisan key:generate

# 3. Configurar tu base de datos local en .env
# Editar DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD
```

### Para Docker (Automático)
```bash
# No necesitas hacer nada manual, Docker se encarga de todo:
sudo docker-compose build --no-cache
sudo docker-compose up -d

# El script start.sh automáticamente:
# 1. Copia .env.docker a .env
# 2. Genera APP_KEY
# 3. Ejecuta migraciones
# 4. Ejecuta seeders
```

## 🔧 Variables de Entorno Importantes

### Base de Datos
- **Local**: `DB_HOST=127.0.0.1`, `DB_PORT=3306`
- **Docker**: `DB_HOST=mysql`, `DB_PORT=3306`

### Aplicación
- **Local**: `APP_URL=http://localhost`
- **Docker**: `APP_URL=http://localhost:8000`

### Debug
- **Local**: `APP_DEBUG=true`, `LOG_LEVEL=debug`
- **Docker**: `APP_DEBUG=false`, `LOG_LEVEL=error`

## 📝 Notas Importantes

1. **Nunca versionar el archivo `.env`** - está en .gitignore por seguridad
2. **Siempre versionar `.env.example`** - es la plantilla para otros desarrolladores
3. **El archivo `.env.docker`** se usa automáticamente en Docker
4. **Generar APP_KEY** es obligatorio para Laravel

## 🔒 Credenciales por Defecto

### Para Docker
- **Base de datos**: `sistema_oncologico_docker`
- **Usuario**: `oncologia_user`
- **Contraseña**: `oncologia_pass_2025`

### Para desarrollo local
- Configurar según tu entorno MySQL local