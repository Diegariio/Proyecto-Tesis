<nav class="sb-topnav navbar navbar-expand bg-secondary">
    <a class="navbar-brand text-center ps-3" href="{{ url('/') }}">
        <b>SIRYC</b>
    </a>

    <button id="sidebar-toggle" class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0">
        <i class="fas fa-bars"></i>
    </button>

    <ul class="navbar-nav ms-auto me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbar-dropdown" href="#" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user me-2"></i> {{ Auth::user()->name ?? 'Usuario' }}
            </a>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbar-dropdown">
                <li>
                    <a class="dropdown-item" href="{{ route('profile') }}">
                        <i class="fas fa-user"></i> Ver perfil
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('changepass') }}">
                        <i class="fas fa-key"></i> Cambiar contraseña
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <form method="POST" action="{{ route('logout') }}">
                    <li>
                        <button class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-power-off"></i> Salir
                        </button>
                    </li>
                </form>
            </ul>
        </li>
    </ul>
</nav>