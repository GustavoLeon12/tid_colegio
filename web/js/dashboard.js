// Dashboard JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const API_URL = '../controller/dashboard_controller.php';
    let charts = {};
    let currentYear = new Date().getFullYear();

    // Inicializar dashboard
    init();

    async function init() {
        await cargarYears();
        await cargarEstadisticasGenerales();
        await cargarGraficos(currentYear);
        await cargarUltimasNoticias();
        await cargarProximosEventos();
        configurarFiltros();
    }

    // Cargar años disponibles
    async function cargarYears() {
        try {
            const response = await fetch(`${API_URL}?accion=years_disponibles`);
            const years = await response.json();
            const select = document.getElementById('yearFilter');
            
            select.innerHTML = '';
            years.forEach(y => {
                const option = document.createElement('option');
                option.value = y.year;
                option.textContent = y.year;
                if (y.year == currentYear) {
                    option.selected = true;
                }
                select.appendChild(option);
            });
        } catch (error) {
            console.error('Error cargando años:', error);
        }
    }

    // Cargar estadísticas generales
    async function cargarEstadisticasGenerales() {
        try {
            const response = await fetch(`${API_URL}?accion=estadisticas_generales`);
            const data = await response.json();
            
            animateValue('totalNoticias', 0, data.total_noticias, 1000);
            animateValue('totalEventos', 0, data.total_eventos, 1000);
            animateValue('noticiasImportantes', 0, data.noticias_importantes, 1000);
            animateValue('eventosRecurrentes', 0, data.eventos_recurrentes, 1000);
        } catch (error) {
            console.error('Error cargando estadísticas:', error);
        }
    }

    // Cargar gráficos
    async function cargarGraficos(year) {
        try {
            // Destruir gráficos existentes
            Object.values(charts).forEach(chart => chart.destroy());
            charts = {};

            // Cargar datos
            const [noticiasMes, eventosMes, noticiasCategoria, eventosEstado] = await Promise.all([
                fetch(`${API_URL}?accion=noticias_por_mes&year=${year}`).then(r => r.json()),
                fetch(`${API_URL}?accion=eventos_por_mes&year=${year}`).then(r => r.json()),
                fetch(`${API_URL}?accion=noticias_por_categoria`).then(r => r.json()),
                fetch(`${API_URL}?accion=eventos_por_estado`).then(r => r.json())
            ]);

            // Gráfico de noticias por mes
            crearGraficoNoticias(noticiasMes);
            
            // Gráfico de eventos por mes
            crearGraficoEventos(eventosMes);
            
            // Gráfico de noticias por categoría
            crearGraficoCategorias(noticiasCategoria);
            
            // Gráfico de eventos por estado
            crearGraficoEstados(eventosEstado);
        } catch (error) {
            console.error('Error cargando gráficos:', error);
        }
    }

    // Crear gráfico de noticias por mes
    function crearGraficoNoticias(data) {
        const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 
                      'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        const valores = new Array(12).fill(0);
        
        data.forEach(item => {
            valores[item.mes - 1] = item.total;
        });

        const ctx = document.getElementById('noticiasChart').getContext('2d');
        charts.noticias = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: meses,
                datasets: [{
                    label: 'Noticias',
                    data: valores,
                    backgroundColor: 'rgba(23, 63, 120, 0.7)',
                    borderColor: 'rgba(23, 63, 120, 1)',
                    borderWidth: 2,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    }

    // Crear gráfico de eventos por mes
    function crearGraficoEventos(data) {
        const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 
                      'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        const valores = new Array(12).fill(0);
        
        data.forEach(item => {
            valores[item.mes - 1] = item.total;
        });

        const ctx = document.getElementById('eventosChart').getContext('2d');
        charts.eventos = new Chart(ctx, {
            type: 'line',
            data: {
                labels: meses,
                datasets: [{
                    label: 'Eventos',
                    data: valores,
                    backgroundColor: 'rgba(40, 167, 69, 0.2)',
                    borderColor: 'rgba(40, 167, 69, 1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 5,
                    pointBackgroundColor: 'rgba(40, 167, 69, 1)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    }

    // Crear gráfico de noticias por categoría
    function crearGraficoCategorias(data) {
        const labels = data.map(item => item.categoria);
        const valores = data.map(item => item.total);
        
        const colores = [
            'rgba(23, 63, 120, 0.8)',
            'rgba(40, 167, 69, 0.8)',
            'rgba(255, 193, 7, 0.8)',
            'rgba(23, 162, 184, 0.8)',
            'rgba(220, 53, 69, 0.8)',
            'rgba(108, 117, 125, 0.8)'
        ];

        const ctx = document.getElementById('categoriasChart').getContext('2d');
        charts.categorias = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: valores,
                    backgroundColor: colores.slice(0, labels.length),
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });
    }

    // Crear gráfico de eventos por estado
    function crearGraficoEstados(data) {
        const labels = data.map(item => item.estado);
        const valores = data.map(item => item.total);
        
        const coloresEstado = {
            'ACTIVO': 'rgba(40, 167, 69, 0.8)',
            'INACTIVO': 'rgba(108, 117, 125, 0.8)',
            'CANCELADO': 'rgba(220, 53, 69, 0.8)'
        };
        
        const colores = labels.map(label => coloresEstado[label] || 'rgba(23, 63, 120, 0.8)');

        const ctx = document.getElementById('estadosChart').getContext('2d');
        charts.estados = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: valores,
                    backgroundColor: colores,
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });
    }

    // Cargar últimas noticias
    async function cargarUltimasNoticias() {
        try {
            console.log('Cargando últimas noticias...');
            const response = await fetch(`${API_URL}?accion=ultimas_noticias&limit=5`);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const result = await response.json();
            console.log('Respuesta noticias:', result);
            
            if (result.success === false) {
                throw new Error(result.message || 'Error al cargar noticias');
            }
            
            const noticias = Array.isArray(result) ? result : [];
            const container = document.getElementById('ultimasNoticias');
            
            if (noticias.length === 0) {
                container.innerHTML = '<li class="activity-item">No hay noticias recientes</li>';
                return;
            }

            container.innerHTML = noticias.map(noticia => {
                const fecha = new Date(noticia.fechaCreacion);
                const fechaFormateada = fecha.toLocaleDateString('es-ES', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
                
                const importante = noticia.importante == 1 
                    ? '<span class="badge-importante">Importante</span>' 
                    : '';

                return `
                    <li class="activity-item">
                        <div class="activity-item-title">
                            ${noticia.titulo} ${importante}
                        </div>
                        <div class="activity-item-meta">
                            <span class="activity-item-category">${noticia.categoria || 'Sin categoría'}</span>
                            <span class="activity-item-date">
                                <i class="fas fa-clock"></i> ${fechaFormateada}
                            </span>
                        </div>
                    </li>
                `;
            }).join('');
        } catch (error) {
            console.error('Error cargando noticias:', error);
            document.getElementById('ultimasNoticias').innerHTML = 
                '<li class="activity-item">Error al cargar noticias. Intenta recargar la página.</li>';
        }
    }

    // Cargar próximos eventos
    async function cargarProximosEventos() {
        try {
            console.log('Cargando próximos eventos...');
            const response = await fetch(`${API_URL}?accion=proximos_eventos&limit=5`);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const result = await response.json();
            console.log('Respuesta eventos:', result);
            
            if (result.success === false) {
                throw new Error(result.message || 'Error al cargar eventos');
            }
            
            const eventos = Array.isArray(result) ? result : [];
            const container = document.getElementById('proximosEventos');
            
            if (eventos.length === 0) {
                container.innerHTML = '<li class="activity-item">No hay eventos próximos</li>';
                return;
            }

            container.innerHTML = eventos.map(evento => {
                const fechaInicio = new Date(evento.fecha_inicio);
                const fechaFin = evento.fecha_fin ? new Date(evento.fecha_fin) : null;
                
                const fechaInicioFormateada = fechaInicio.toLocaleDateString('es-ES', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                });
                
                const horaInicio = fechaInicio.toLocaleTimeString('es-ES', {
                    hour: '2-digit',
                    minute: '2-digit'
                });
                
                let fechaTexto = fechaInicioFormateada;
                if (fechaFin) {
                    const horaFin = fechaFin.toLocaleTimeString('es-ES', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    fechaTexto += ` - ${horaFin}`;
                }

                const estadoClass = `badge-${evento.estado.toLowerCase()}`;
                const ubicacion = evento.ubicacion ? 
                    `<div class="activity-item-location"><i class="fas fa-map-marker-alt"></i> ${evento.ubicacion}</div>` : '';

                return `
                    <li class="activity-item">
                        <div class="activity-item-title">${evento.titulo}</div>
                        <div class="activity-item-meta">
                            <span class="badge-estado ${estadoClass}">${evento.estado}</span>
                            <span class="activity-item-date">
                                <i class="fas fa-calendar"></i> ${fechaInicioFormateada}
                            </span>
                        </div>
                        <div class="activity-item-time">
                            <i class="fas fa-clock"></i> ${horaInicio}
                        </div>
                        ${ubicacion}
                    </li>
                `;
            }).join('');
        } catch (error) {
            console.error('Error cargando eventos:', error);
            document.getElementById('proximosEventos').innerHTML = 
                '<li class="activity-item">Error al cargar eventos. Intenta recargar la página.</li>';
        }
    }

    // Configurar filtros
    function configurarFiltros() {
        document.getElementById('yearFilter').addEventListener('change', function() {
            currentYear = this.value;
            cargarGraficos(currentYear);
        });
    }

    // Animación de números
    function animateValue(id, start, end, duration) {
        const element = document.getElementById(id);
        const range = end - start;
        const increment = end > start ? 1 : -1;
        const stepTime = Math.abs(Math.floor(duration / range));
        let current = start;
        
        const timer = setInterval(() => {
            current += increment;
            element.textContent = current;
            if (current == end) {
                clearInterval(timer);
            }
        }, stepTime);
    }
});