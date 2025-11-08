<!DOCTYPE html>
<html lang="en">

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

    <div class="banner-calendario d-flex justify-content-center align-items-center">
        <div class="dark-container content text-center text-white">
            <h3 class="text-center">Calendario escolar</h3>
            <p>Explora nuestra ultimas actividades y fechas importantes</p>
        </div>
    </div>

    <div class="container py-5">
        <h2 class="text-center">Calendario Escolar</h2>
        <div id="calendar"></div>
    </div>

    <?php
    require_once './components/footer.php'
    ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let calendarEl = document.getElementById('calendar');

            let calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'es',
                initialView: 'dayGridMonth',
                height: 'auto',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                // 🔹 Solo lectura
                selectable: false,
                editable: false,
                navLinks: true,
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Día'
                },
                allDayText: 'Todo el día',
                events: {
                    url: '../controller/calendario_controller.php?accion=listar_calendario',
                    method: 'POST',
                    failure: function() {
                        alert('Error al cargar los eventos del calendario.');
                    }
                },
                eventDisplay: 'block',
                eventDidMount: function(info) {
                    // Tooltip con descripción al pasar el mouse
                    if (info.event.extendedProps.descripcion) {
                        new bootstrap.Tooltip(info.el, {
                            title: info.event.extendedProps.descripcion,
                            placement: 'top',
                            trigger: 'hover'
                        });
                    }
                },
                eventClick: function(info) {
                    const e = info.event;
                    const start = new Date(e.start).toLocaleString('es-ES', {
                        dateStyle: 'medium',
                        timeStyle: 'short'
                    });
                    const end = e.end ? new Date(e.end).toLocaleString('es-ES', {
                        dateStyle: 'medium',
                        timeStyle: 'short'
                    }) : '';
                    const modalHtml = `
                        <div class="modal fade" id="infoEvento" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: ${e.backgroundColor || '#173f78'}; color: white;">
                                        <h5 class="modal-title"><i class="fas fa-calendar-alt me-2"></i>${e.title}</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body" style="word-wrap: break-word; overflow-wrap: break-word; max-height: 400px; overflow-y: auto;">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p class="mb-2"><strong><i class="fas fa-align-left me-1"></i>Descripción:</strong><br>${e.extendedProps.descripcion || 'Sin descripción'}</p>
                                                ${e.extendedProps.ubicacion ? `<p class="mb-2"><strong><i class="fas fa-map-marker-alt me-1"></i>Ubicación:</strong><br>${e.extendedProps.ubicacion}</p>` : ''}
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card bg-light">
                                                    <div class="card-body text-center">
                                                        <h6 class="card-title text-muted">Fechas</h6>
                                                        <p class="mb-1"><i class="fas fa-clock me-1"></i><strong>Inicio:</strong><br>${start}</p>
                                                        ${end ? `<p><i class="fas fa-clock me-1"></i><strong>Fin:</strong><br>${end}</p>` : ''}
                                                        ${e.extendedProps.allDay ? '<p class="text-success"><i class="fas fa-check-circle me-1"></i>Todo el día</p>' : ''}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    document.body.insertAdjacentHTML('beforeend', modalHtml);
                    const modal = new bootstrap.Modal(document.getElementById('infoEvento'));
                    modal.show();
                    document.getElementById('infoEvento').addEventListener('hidden.bs.modal', function() {
                        document.getElementById('infoEvento').remove();
                    });
                }
            });

            calendar.render();
        });
    </script>


    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
</body>

</html>