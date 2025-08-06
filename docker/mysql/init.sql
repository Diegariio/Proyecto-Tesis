-- Script de inicialización de MySQL para Sistema Oncológico Docker
-- Este archivo se ejecuta automáticamente al crear el contenedor

-- Configurar zona horaria para Chile
SET time_zone = '-03:00';

-- Crear base de datos si no existe
CREATE DATABASE IF NOT EXISTS sistema_oncologico_docker CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Crear usuario específico para la aplicación
CREATE USER IF NOT EXISTS 'oncologia_user'@'%' IDENTIFIED BY 'oncologia_pass_2025';

-- Otorgar permisos completos al usuario sobre la base de datos
GRANT ALL PRIVILEGES ON sistema_oncologico_docker.* TO 'oncologia_user'@'%';

-- Aplicar cambios de permisos
FLUSH PRIVILEGES;

-- Usar la base de datos
USE sistema_oncologico_docker;

-- Configuraciones básicas para Laravel
SET foreign_key_checks = 1;
SET sql_mode = 'STRICT_TRANS_TABLES,NO_ZERO_DATE,NO_ZERO_IN_DATE,ERROR_FOR_DIVISION_BY_ZERO';

-- Configuraciones de rendimiento
SET innodb_buffer_pool_size = 128M;
SET max_connections = 200;

-- Mostrar información de la base de datos creada
SELECT 
    'Base de datos Sistema Oncológico Docker creada exitosamente' as mensaje,
    'Usuario: oncologia_user creado con permisos completos' as usuario_info,
    NOW() as fecha_creacion;