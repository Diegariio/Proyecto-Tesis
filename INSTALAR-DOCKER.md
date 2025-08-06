# 🐳 Instalación de Docker y Docker Compose

## 🐧 Para Ubuntu/Debian

### 1. Actualizar el sistema
```bash
sudo apt update && sudo apt upgrade -y
```

### 2. Instalar dependencias necesarias
```bash
sudo apt install -y apt-transport-https ca-certificates curl gnupg lsb-release
```

### 3. Agregar la clave GPG oficial de Docker
```bash
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg
```

### 4. Agregar el repositorio de Docker
```bash
echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
```

### 5. Instalar Docker Engine y Docker Compose
```bash
sudo apt update
sudo apt install -y docker-ce docker-ce-cli containerd.io docker-compose-plugin
```

### 6. Agregar tu usuario al grupo docker (para no usar sudo)
```bash
sudo usermod -aG docker $USER
newgrp docker
```

### 7. Verificar la instalación
```bash
docker --version
docker compose version
```

## 🔄 **Instalación rápida con script oficial (alternativa)**
```bash
# Descargar e instalar Docker con script oficial
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh

# Agregar usuario al grupo docker
sudo usermod -aG docker $USER
newgrp docker

# Instalar Docker Compose (si no se instaló automáticamente)
sudo apt install -y docker-compose-plugin
```

## 🍎 **Para macOS:**
```bash
# Descargar Docker Desktop desde:
# https://docs.docker.com/desktop/install/mac-install/
# O usar Homebrew:
brew install --cask docker
```

## 🪟 **Para Windows:**
```bash
# Descargar Docker Desktop desde:
# https://docs.docker.com/desktop/install/windows-install/
```

## ✅ **Verificar que funciona correctamente**

### Probar Docker
```bash
docker run hello-world
```

### Probar Docker Compose
```bash
docker compose --version
```

### Ver información del sistema Docker
```bash
docker info
```

## 🔧 **Si tienes problemas de permisos**

### Error: "permission denied while trying to connect to Docker daemon"
```bash
# Agregar usuario al grupo docker
sudo usermod -aG docker $USER

# Reiniciar sesión o usar:
newgrp docker

# O cambiar permisos temporalmente:
sudo chmod 666 /var/run/docker.sock
```

### Reiniciar el servicio Docker
```bash
sudo systemctl restart docker
sudo systemctl enable docker
```

## 🚀 **Una vez instalado Docker, ejecutar el proyecto:**
```bash
# Clonar el proyecto
git clone https://github.com/Diegariio/Proyecto-Tesis.git
cd Proyecto-Tesis
git checkout diegoDev

# Levantar con Docker
docker compose build --no-cache
docker compose up -d

# Ver progreso
docker compose logs -f app
```

## 📝 **Notas importantes:**

1. **Después de agregar tu usuario al grupo docker**, necesitas **cerrar sesión y volver a entrar** o usar `newgrp docker`

2. **Docker Compose** ahora se llama `docker compose` (con espacio) en las versiones nuevas, no `docker-compose` (con guión)

3. **Si usas `docker-compose`** (versión antigua), los comandos serían:
   ```bash
   sudo docker-compose build --no-cache
   sudo docker-compose up -d
   ```

4. **En sistemas más nuevos** puedes usar `docker compose` (sin sudo si agregaste tu usuario al grupo docker)