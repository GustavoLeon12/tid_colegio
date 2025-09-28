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

    <!-- Modal para crear/editar evento -->
    <div class="modal fade" id="eventoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="eventoForm">
                        <input type="hidden" name="id" id="eventoId">
                        <div class="mb-3">
                            <label>Título</label>
                            <input type="text" name="titulo" id="titulo" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Ubicación</label>
                            <input type="text" name="ubicacion" id="ubicacion" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Color</label>
                            <input type="color" name="color" id="color" class="form-control" value="#173f78">
                        </div>
                        <div class="mb-3">
                            <label>Fecha inicio</label>
                            <input type="datetime-local" name="start" id="start" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Fecha fin</label>
                            <input type="datetime-local" name="end" id="end" class="form-control">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="allDay">
                            <label class="form-check-label">Todo el día</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="guardarEvento">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <?php
require_once './components/footer.php'
?>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        let calendarEl = document.getElementById('calendar');
        let eventoModal = new bootstrap.Modal(document.getElementById('eventoModal'));
        let guardarBtn = document.getElementById('guardarEvento');

        let calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            selectable: true,
            editable: true,
            events: '../api/eventos.php',

            select: function(info) {
                // limpia formulario
                document.getElementById('eventoForm').reset();
                document.getElementById('eventoId').value = '';
                document.getElementById('start').value = info.startStr + "T00:00";
                document.getElementById('end').value = info.endStr ? info.endStr + "T00:00" : '';
                document.getElementById('allDay').checked = info.allDay;
                eventoModal.show();
            },

            eventClick: function(info) {
                // cargar datos en modal para editar/eliminar
                let ev = info.event;
                document.getElementById('eventoId').value = ev.id;
                document.getElementById('titulo').value = ev.title;
                document.getElementById('descripcion').value = ev.extendedProps.descripcion || '';
                document.getElementById('ubicacion').value = ev.extendedProps.ubicacion || '';
                document.getElementById('color').value = ev.backgroundColor || '#173f78';
                document.getElementById('start').value = ev.startStr.substring(0, 16);
                document.getElementById('end').value = ev.endStr ? ev.endStr.substring(0, 16) : '';
                document.getElementById('allDay').checked = ev.allDay;
                eventoModal.show();
            },

            eventDrop: function(info) {
                actualizarEvento(info.event);
            },
            eventResize: function(info) {
                actualizarEvento(info.event);
            }
        });

        calendar.render();

        guardarBtn.addEventListener('click', function() {
            let id = document.getElementById('eventoId').value;
            let data = {
                id: id,
                titulo: document.getElementById('titulo').value,
                descripcion: document.getElementById('descripcion').value,
                ubicacion: document.getElementById('ubicacion').value,
                color: document.getElementById('color').value,
                start: document.getElementById('start').value,
                end: document.getElementById('end').value,
                allDay: document.getElementById('allDay').checked
            };

            if (id) {
                // actualizar
                fetch('../api/actualizar_evento.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                }).then(() => {
                    calendar.refetchEvents();
                    eventoModal.hide();
                });
            } else {
                // insertar
                fetch('../api/insertar_evento.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(res => res.json())
                    .then(resp => {
                        calendar.refetchEvents();
                        eventoModal.hide();
                    });
            }
        });

        function actualizarEvento(ev) {
            fetch('../api/actualizar_evento.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: ev.id,
                    start: ev.startStr,
                    end: ev.endStr,
                    allDay: ev.allDay
                })
            });
        }
    });
    </script>



    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
</body>

</html>