<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm px-3">
    <div class="container-fluid">
        <!-- Logo o nombre del sistema -->
        <a class="navbar-brand fw-bold" href="#">
            <i class="fas fa-hospital-symbol me-2"></i> Plataforma Trazabilidad
        </a>

        <!-- Botón para menú colapsable en móviles -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTopbar" aria-controls="navbarTopbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenido del topbar -->
        <div class="collapse navbar-collapse" id="navbarTopbar">
            <ul class="navbar-nav ms-auto align-items-center">
                <!-- Ejemplo de íconos de notificaciones -->
                <li class="nav-item me-3">
                    <a class="nav-link position-relative" href="#">
                        <i class="fas fa-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                            <span class="visually-hidden">nuevas notificaciones</span>
                        </span>
                    </a>
                </li>
                <!-- Ejemplo de menú de usuario -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarUserDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://ui-avatars.com/api/?name=Usuario" alt="Avatar" class="rounded-circle me-2" width="32" height="32">
                        <span>Usuario</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarUserDropdown">
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                        <li><a class="dropdown-item" href="#">Configuración</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>