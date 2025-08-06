# 🖥️ Instrucciones para levantar el proyecto en otro PC

## 📋 Requisitos previos
- Git instalado
- Docker y Docker Compose instalados
- Puertos disponibles: 8000, 8080, 3307

## 🚀 Comandos para ejecutar (en orden)

### 1. Clonar el repositorio y cambiar a la rama diegoDev
```bash
git clone https://github.com/Diegariio/Proyecto-Tesis.git
cd Proyecto-Tesis
git checkout diegoDev
```

### 2. Construir y levantar el proyecto con Docker
```bash
# Construir las imágenes Docker (puede tomar varios minutos)
sudo docker-compose build --no-cache

# Levantar todos los servicios
sudo docker-compose up -d

# Ver los logs para seguir el progreso de inicialización
sudo docker-compose logs -f app
```

### 3. Obtener las URLs de acceso
```bash
# Comando para obtener las URLs automáticamente
MY_IP=$(hostname -I | awk '{print $1}')
echo "🌐 Aplicación: http://$MY_IP:8000"
echo "🗄️ phpMyAdmin: http://$MY_IP:8080"
echo "📱 Local: http://localhost:8000"
```

### 4. Verificar que todo esté funcionando
```bash
# Ver el estado de los contenedores
sudo docker-compose ps

# Debe mostrar algo como:
# laravel-oncologia-app      Up       0.0.0.0:8000->80/tcp
# laravel-oncologia-mysql    Up       0.0.0.0:3307->3306/tcp  
# laravel-oncologia-phpmyadmin Up     0.0.0.0:8080->80/tcp
```

## 🔐 Credenciales de acceso

### Usuarios de la aplicación
- **admin@test.com** / password (Administrador)
- **doctor@test.com** / password (Doctor)
- **enfermera@test.com** / password (Enfermera)
- **radioterapeuta@test.com** / password (Radioterapeuta)

### Base de datos (phpMyAdmin)
- **Usuario:** oncologia_user
- **Contraseña:** oncologia_pass_2025

## 🛠️ Comandos útiles

### Para parar la aplicación
```bash
sudo docker-compose down
```

### Para reiniciar si hay problemas
```bash
sudo docker-compose restart
```

### Para ver logs específicos
```bash
# Logs de la aplicación
sudo docker-compose logs -f app

# Logs de la base de datos
sudo docker-compose logs -f mysql
```

### Para reconstruir desde cero (si hay problemas)
```bash
sudo docker-compose down -v
sudo docker-compose build --no-cache
sudo docker-compose up -d
```

## ✅ Lo que debe suceder automáticamente

1. **Descarga e instalación** de dependencias PHP y Node.js
2. **Creación automática** de la base de datos MySQL
3. **Migración** de todas las tablas
4. **Población** con datos de prueba (seeders)
5. **Configuración** automática del archivo .env
6. **Generación** de la clave de aplicación (APP_KEY)
7. **Optimización** de la aplicación para producción

## 🎯 Resultado esperado

Al finalizar, deberías poder acceder a:
- Sistema Oncológico funcionando completamente
- Base de datos poblada con datos de prueba
- Usuarios listos para hacer login
- Todos los módulos operativos

## 🐛 Solución de problemas

### Error de permisos Docker
```bash
# Agregar usuario al grupo docker
sudo usermod -aG docker $USER
newgrp docker

# O usar sudo en todos los comandos docker-compose
```

### Puertos ocupados
```bash
# Ver qué usa los puertos
sudo netstat -tulpn | grep :8000
sudo netstat -tulpn | grep :8080

# Cambiar puertos en docker-compose.yml si es necesario
```

### Error en la aplicación
```bash
# Ver logs detallados
sudo docker-compose logs app

# Reiniciar solo la app
sudo docker-compose restart app
```

---
**📝 Nota:** Este proyecto está configurado para funcionar completamente con Docker, no necesitas instalar PHP, MySQL ni Node.js localmente.