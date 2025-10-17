$(document).ready(function () {
    cargarTablaCalendario();
    $('#btnNuevoEvento').on('click', function() { $('#modalNuevoEvento').modal('show'); });
    $('#formNuevoEvento').on('submit', guardarNuevoEvento);
    $('#formEditarEvento').on('submit', actualizarEvento);
    $('#btnEliminarEvento').on('click', eliminarEventoConfirm);
});

function cargarTablaCalendario() {
    $('#example').DataTable({
        responsive: true,
        autoWidth: false,
        destroy: true,
        ajax: {
            url: '../controller/calendario_controller.php?accion=listar',
            type: 'GET',
            dataSrc: '',
            error: function(xhr, error, code) { console.error('AJAX Error:', code); }
        },
        columns: [
            { data: 'id' },
            { data: 'titulo' },
            { data: 'descripcion' },
            { data: 'fecha_inicio' },
            { data: 'fecha_fin' },
            { data: 'todo_dia', render: data => data == 1 ? 'Sí' : 'No' },
            { data: 'ubicacion' },
            { data: 'categoria_id' },
            { data: 'usuario_id' },
            { data: 'grado_id' },
            { data: 'curso_id' },
            { data: 'aula_id' },
            { data: 'year_id' },
            { data: 'recurrente' },
            { data: 'regla_recurrencia', defaultContent: '' },
            { data: 'color', render: data => `<span style="background:${data}; color:#fff; padding:3px 6px; border-radius:4px;">${data}</span>` },
            { data: 'estado' },
            { data: 'fecha_creacion' },
            { data: 'fecha_actualizacion' },
            {
                data: null,
                render: data => `
                    <button class="btn btn-warning btn-sm" onclick="editarEvento(${data.id})">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="eliminarEvento(${data.id})">
                        <i class="fa fa-trash"></i>
                    </button>
                `
            }
        ],
        language: { url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json' },
        pageLength: 10,
        order: [[3, 'desc']]
    });
}

function guardarNuevoEvento(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);

    fetch('../controller/calendario_controller.php?accion=crear', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(resp => {
        if (resp.success) {
            alert('Evento creado');
            $('#modalNuevoEvento').modal('hide');
            $('#example').DataTable().ajax.reload();
            $('#formNuevoEvento')[0].reset();
        } else {
            alert('Error: ' + resp.message);
        }
    });
}

function editarEvento(id) {
    fetch(`../controller/calendario_controller.php?accion=obtener&id=${id}`)
    .then(res => res.json())
    .then(evento => {
        if (evento.error) return alert('Evento no encontrado');
        $('#edit_id').val(evento.id);
        $('#edit_titulo').val(evento.titulo);
        $('#edit_descripcion').val(evento.descripcion);
        $('#edit_fecha_inicio').val(evento.fecha_inicio ? evento.fecha_inicio.slice(0,16) : '');
        $('#edit_fecha_fin').val(evento.fecha_fin ? evento.fecha_fin.slice(0,16) : '');
        $('#edit_todo_dia').prop('checked', evento.todo_dia == 1);
        $('#edit_ubicacion').val(evento.ubicacion);
        $('#edit_categoria_id').val(evento.categoria_id || '');
        $('#edit_usuario_id').val(evento.usuario_id || '');
        $('#edit_grado_id').val(evento.grado_id || '');
        $('#edit_curso_id').val(evento.curso_id || '');
        $('#edit_aula_id').val(evento.aula_id || '');
        $('#edit_year_id').val(evento.year_id || '');
        $('#edit_recurrente').prop('checked', evento.recurrente == 1);
        $('#edit_regla_recurrencia').val(evento.regla_recurrencia || '');
        $('#edit_color').val(evento.color);
        $('#edit_estado').val(evento.estado || 'ACTIVO');
        $('#modalEditarEvento').modal('show');
    });
}

function actualizarEvento(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);

    fetch('../controller/calendario_controller.php?accion=actualizar', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(resp => {
        if (resp.success) {
            alert('Evento actualizado');
            $('#modalEditarEvento').modal('hide');
            $('#example').DataTable().ajax.reload();
        } else {
            alert('Error: ' + resp.message);
        }
    });
}

let eventoIdGlobal;
function eliminarEvento(id) {
    eventoIdGlobal = id;
    if (confirm('¿Eliminar evento?')) {
        fetch('../controller/calendario_controller.php?accion=eliminar', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id })
        })
        .then(res => res.json())
        .then(resp => {
            if (resp.success) {
                alert('Evento eliminado');
                $('#example').DataTable().ajax.reload();
            } else {
                alert('Error: ' + resp.message);
            }
        });
    }
}

function eliminarEventoConfirm() {
    eliminarEvento($('#edit_id').val());
}