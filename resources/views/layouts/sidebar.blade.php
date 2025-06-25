<nav class="sb-sidenav accordion text-bg-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu p-3">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Menú</div>

            <a href="{{ url('/registroTratamientoRadioterapia') }}" class="nav-link text-light text-opacity-75">
                <div class="sb-nav-link-icon">
                    <i class="fa-solid fa-laptop-medical"></i>
                </div>
                Registro Tratamiento Radioterapia
            </a>

            <a href="{{ url('/gestionCasosOncologicos') }}" class="nav-link text-light text-opacity-75">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-notes-medical"></i>
                </div>
                Gestión Casos Oncológicos
            </a>

        </div>
    </div>

    <div class="sb-sidenav-footer text-center p-2">
        <small>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</small>
    </div>
</nav>
