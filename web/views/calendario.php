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
        document.addEventListener('DOMContentLoaded', function () {
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
                events: {
                    url: '../controller/calendario_controller.php?accion=listar_calendario',
                    method: 'GET',
                    failure: function () {
                        alert('Error al cargar los eventos del calendario.');
                    }
                },
                eventDisplay: 'block',
                eventDidMount: function (info) {
                    // Tooltip con descripción al pasar el mouse
                    if (info.event.extendedProps.descripcion) {
                        new bootstrap.Tooltip(info.el, {
                            title: info.event.extendedProps.descripcion,
                            placement: 'top',
                            trigger: 'hover'
                        });
                    }
                },
                eventClick: function (info) {
                    // Muestra un modal informativo al hacer clic (solo lectura)
                    const e = info.event;
                    const modalHtml = `
                        <div class="modal fade" id="infoEvento" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title">${e.title}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Descripción:</strong> ${e.extendedProps.descripcion || 'Sin descripción'}</p>
                                        <p><strong>Ubicación:</strong> ${e.extendedProps.ubicacion || 'No especificada'}</p>
                                        <p><strong>Fecha inicio:</strong> ${new Date(e.start).toLocaleString()}</p>
                                        ${e.end ? `<p><strong>Fecha fin:</strong> ${new Date(e.end).toLocaleString()}</p>` : ''}
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
                    document.getElementById('infoEvento').addEventListener('hidden.bs.modal', function () {
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