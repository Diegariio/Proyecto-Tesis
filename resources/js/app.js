import './bootstrap';
import * as bootstrap from 'bootstrap';
import '@fortawesome/fontawesome-free/js/all.min.js';
import Choices from 'choices.js';

window.bootstrap = bootstrap;
window.Choices = Choices;

window.appConfig = {
    CHOICES_OPTIONS: {
        removeItemButton: true,
        searchResultLimit: -1,
        searchFields: ['label'],
        position: 'bottom',
        sorter: (a, b) => (a.value < b.value ? -1 : 1),
        loadingText: 'Cargando...',
        noResultsText: 'No se encontraron resultados',
        noChoicesText: 'No hay opciones a elegir',
        itemSelectText: '',
        uniqueItemText: 'Solo se pueden agregar valores únicos',
        customAddItemText:
            'Solo se pueden agregar valores que cumplan con condiciones específicas',
        classNames: {
            containerInner: ['form-select'],
            input: ['choices__input', 'bg-white'],
            listItems: ['choices__list--multiple', 'p-0'],
            listSingle: ['choices__list--single', 'p-0'],
            listDropdown: ['choices__list--dropdown', 'p-0'],
        },
    },
};

window.addEventListener('DOMContentLoaded', (event) => {
    const sidebarToggle = document.body.querySelector('#sidebar-toggle');

    if (sidebarToggle) {
        if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
            document.body.classList.add('sb-sidenav-toggled');
        }

        sidebarToggle.addEventListener('click', (event) => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem(
                'sb|sidebar-toggle',
                document.body.classList.contains('sb-sidenav-toggled')
            );
        });
    }

    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );
    tooltipTriggerList.forEach((tooltipTriggerEl) => {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });

    document.querySelectorAll('.choices-select').forEach((selectElement) => {
        new Choices(selectElement, window.appConfig?.CHOICES_OPTIONS || {});
    });

    document.querySelectorAll('.pdf-iframe').forEach((iframeElement) => {
        const pdfUrl = iframeElement.src;

        fetch(pdfUrl, { method: 'HEAD' })
            .then((response) => {
                if (!response.ok) throw new Error('No se pudo cargar el PDF');
                iframeElement.style.display = 'block';
            })
            .catch(() => {
                iframeElement.style.display = 'none';

                const errorMessage = document.createElement('p');
                errorMessage.textContent = 'No se pudo cargar el PDF.';
                errorMessage.style.textAlign = 'center';

                iframeElement.parentNode.appendChild(errorMessage);
            });
    });

    function agregarPaginacionA(tabla, filasPorPagina = 10, maxPaginasMostradas = 5) {
        const cuerpoTabla = tabla.querySelector('tbody');
        const filas = cuerpoTabla.querySelectorAll('tr');
        const paginacion = document.createElement('ul');
        paginacion.classList.add('pagination', 'justify-content-end', 'mt-4');
        tabla.insertAdjacentElement('afterend', paginacion);

        const totalPaginas = Math.ceil(filas.length / filasPorPagina);

        if (totalPaginas <= 1) return;

        let paginaActual = 1;

        function mostrarPagina(pagina) {
            const inicio = (pagina - 1) * filasPorPagina;
            const fin = inicio + filasPorPagina;

            filas.forEach((fila, index) => {
                fila.style.display = index >= inicio && index < fin ? '' : 'none';
            });

            paginaActual = pagina;
            actualizarPaginacion();
        }

        function crearElementoPagina(texto, pagina, activa = false, deshabilitada = false) {
            const li = document.createElement('li');
            li.className = 'page-item' + (activa ? ' active' : '') + (deshabilitada ? ' disabled' : '');

            const a = document.createElement('a');
            a.className = 'page-link';
            a.href = '#';
            a.innerHTML = texto;

            if (!deshabilitada) {
                a.addEventListener('click', function (e) {
                    e.preventDefault();
                    mostrarPagina(pagina);
                });
            }

            li.appendChild(a);
            return li;
        }

        function actualizarPaginacion() {
            paginacion.innerHTML = '';

            paginacion.appendChild(crearElementoPagina('&lsaquo;', paginaActual - 1, false, paginaActual === 1));

            let mitad = Math.floor(maxPaginasMostradas / 2);

            let inicio = paginaActual - mitad;
            let fin = paginaActual + mitad;

            if (inicio < 2) {
                fin += 2 - inicio;
                inicio = 2;
            }

            if (fin > totalPaginas - 1) {
                inicio -= (fin - (totalPaginas - 1));
                fin = totalPaginas - 1;
            }

            inicio = Math.max(inicio, 2);

            paginacion.appendChild(crearElementoPagina('1', 1, paginaActual === 1));

            if (inicio > 2) {
                const puntos = document.createElement('li');
                puntos.className = 'page-item disabled';
                puntos.innerHTML = '<span class="page-link">…</span>';
                paginacion.appendChild(puntos);
            }

            for (let i = inicio; i <= fin; i++) {
                paginacion.appendChild(crearElementoPagina(i, i, i === paginaActual));
            }

            if (fin < totalPaginas - 1) {
                const puntos = document.createElement('li');
                puntos.className = 'page-item disabled';
                puntos.innerHTML = '<span class="page-link">…</span>';
                paginacion.appendChild(puntos);
            }

            if (totalPaginas > 1) {
                paginacion.appendChild(crearElementoPagina(totalPaginas, totalPaginas, paginaActual === totalPaginas));
            }

            paginacion.appendChild(crearElementoPagina('&rsaquo;', paginaActual + 1, false, paginaActual === totalPaginas));
        }

        mostrarPagina(1);
    }

    const tablas = document.querySelectorAll('.table-paginated');
    tablas.forEach(tabla => {
        agregarPaginacionA(tabla);
    });
});
