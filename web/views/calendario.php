<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/lib/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/query.css">
    <link rel="stylesheet" href="../css/globals.css">
    <link rel="stylesheet" href="../css/calendar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="shortcut icon" href="../img/LOGO.png" type="image/x-icon">
    <script src="../js/fullcalendar/index.global.min.js"></script>
    <title>Colegio Orion - Calendario</title>
</head>

<body>

    <?php
    require_once './components/navigation.php';
    ?>

    <main>
        <div class="banner-calendario d-flex justify-content-center align-items-center">
            <div class="dark-container content text-center text-white">
                <h3 class="text-center">Calendario Escolar</h3>
                <p>Explora nuestras últimas actividades y fechas importantes</p>
            </div>
        </div>

        <div class="container-fluid py-5" style="max-width: 1400px;">
            <div class="calendar-header text-center mb-4">
                <h2 class="calendar-title">Calendario de Eventos</h2>
                <p class="calendar-subtitle">Mantente informado sobre nuestras actividades institucionales</p>
            </div>
            <div class="calendar-wrapper">
                <div id="calendar"></div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let calendarEl = document.getElementById('calendar');

            let calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'es',
                initialView: 'dayGridMonth',
                height: 'auto',
                contentHeight: 650,
                aspectRatio: 1.8,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Día',
                    list: 'Lista'
                },
                // Solo lectura
                selectable: false,
                editable: false,
                navLinks: true,
                dayMaxEvents: true,
                events: {
                    url: '../controller/calendario_controller.php?accion=listar_calendario',
                    method: 'POST',
                    failure: function() {
                        mostrarError();
                    }
                },
                eventDisplay: 'block',
                eventDidMount: function(info) {
                    // Tooltip con descripción al pasar el mouse
                    if (info.event.extendedProps.descripcion) {
                        info.el.title = info.event.extendedProps.descripcion;
                    }
                },
                eventClick: function(info) {
                    mostrarModalEvento(info.event);
                }
            });

            calendar.render();

            // Función para mostrar modal de evento
            function mostrarModalEvento(evento) {
                const start = new Date(evento.start).toLocaleString('es-ES', {
                    dateStyle: 'long',
                    timeStyle: 'short'
                });
                const end = evento.end ? new Date(evento.end).toLocaleString('es-ES', {
                    dateStyle: 'long',
                    timeStyle: 'short'
                }) : '';
                
                const modalHtml = `
                    <div class="modal fade" id="infoEvento" tabindex="-1" aria-labelledby="infoEventoLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                            <div class="modal-content evento-modal">
                                <div class="modal-header" style="background: linear-gradient(135deg, ${evento.backgroundColor || '#173f78'} 0%, ${evento.backgroundColor || '#0d2d5a'} 100%); color: white; border: none;">
                                    <h5 class="modal-title d-flex align-items-center" id="infoEventoLabel">
                                        <i class="fas fa-calendar-alt me-2"></i>${evento.title}
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                                    <div class="row g-4">
                                        <div class="col-md-8">
                                            <div class="evento-detalle">
                                                <div class="detalle-item mb-3">
                                                    <h6 class="detalle-label">
                                                        <i class="fas fa-align-left text-primary me-2"></i>Descripción
                                                    </h6>
                                                    <p class="detalle-texto">${evento.extendedProps.descripcion || 'Sin descripción disponible'}</p>
                                                </div>
                                                ${evento.extendedProps.ubicacion ? `
                                                <div class="detalle-item">
                                                    <h6 class="detalle-label">
                                                        <i class="fas fa-map-marker-alt text-danger me-2"></i>Ubicación
                                                    </h6>
                                                    <p class="detalle-texto">${evento.extendedProps.ubicacion}</p>
                                                </div>` : ''}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card shadow-sm h-100">
                                                <div class="card-body">
                                                    <h6 class="card-title text-center text-muted mb-3">
                                                        <i class="fas fa-clock me-1"></i>Fechas del Evento
                                                    </h6>
                                                    <div class="fecha-info">
                                                        <div class="fecha-item mb-3">
                                                            <small class="text-muted d-block mb-1">Inicio</small>
                                                            <p class="mb-0 fw-semibold">${start}</p>
                                                        </div>
                                                        ${end ? `
                                                        <div class="fecha-item mb-3">
                                                            <small class="text-muted d-block mb-1">Fin</small>
                                                            <p class="mb-0 fw-semibold">${end}</p>
                                                        </div>` : ''}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="border-top: 1px solid #dee2e6;">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="fas fa-times me-1"></i>Cerrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>`;
                
                // Remover modal anterior si existe
                const existingModal = document.getElementById('infoEvento');
                if (existingModal) {
                    existingModal.remove();
                }
                
                document.body.insertAdjacentHTML('beforeend', modalHtml);
                const modal = new bootstrap.Modal(document.getElementById('infoEvento'));
                modal.show();
                
                document.getElementById('infoEvento').addEventListener('hidden.bs.modal', function() {
                    document.getElementById('infoEvento').remove();
                });
            }

            // Función para mostrar error
            function mostrarError() {
                const errorHtml = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Error:</strong> No se pudieron cargar los eventos del calendario.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
                document.querySelector('.calendar-wrapper').insertAdjacentHTML('beforebegin', errorHtml);
            }
        });
    </script>

    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>

    <?php
    require_once './components/footer.php'
    ?>
</body>

</html>