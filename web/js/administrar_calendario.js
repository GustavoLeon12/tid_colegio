$(document).ready(function () {
    cargarTablaCalendario();
    $('#btnNuevoEvento').on('click', () => $('#modalNuevoEvento').modal('show'));
    $('#formNuevoEvento').on('submit', guardarNuevoEvento);
    $('#formEditarEvento').on('submit', actualizarEvento);
    $('#btnEliminarEvento').on('click', eliminarEventoConfirm);
    cargarEstados();

    // CORREGIDO: Listener fuera del ready anidado y con jQuery
    $('#btnEnviarNotif').on('click', function() {
        const dest = $('#destinatarios').val().trim();
        if (!dest) return alert('Agrega emails');
        const id = $('#notif_id').val();
        if (!id) return alert('ID inválido');

        fetch('../controller/calendario_controller.php?accion=enviar_notif', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                id,
                notificacion: { 
                    tipo: 'email', 
                    destinatarios: dest.split(',').map(d => d.trim()).filter(Boolean)
                }
            })
        })
        .then(res => res.json())
        .then(resp => {
            if (resp.success) {
                alert('Notificación enviada');
                $('#modalNotificacion').modal('hide');
                $('#tablaCalendario').DataTable().ajax.reload(); // CORREGIDO: #tablaCalendario
            } else {
                alert('Error: ' + resp.message);
            }
        })
        .catch(() => alert('Error de conexión'));
    });
});

function cargarTablaCalendario() {
    // destruye si existe y crea de nuevo (útil durante desarrollo)
    $('#tablaCalendario').DataTable({
        responsive: true,
        autoWidth: false,
        destroy: true,
        ajax: {
            url: '../controller/calendario_controller.php?accion=listar', 
            type: 'POST',
            dataSrc: '',
            error: function(xhr, error, thrown) {
                console.error('AJAX Error listar:', thrown, xhr);
                alert('Error al cargar eventos. Revisa la consola (Network) para más detalles.');
            }
        },
        columns: [
            { data: 'id' },
            { data: 'titulo', render: d => d ? d : '' },
            { data: 'descripcion', render: d => d ? d : '' },
            { data: 'fecha_inicio', render: renderFechaLocal },
            { data: 'fecha_fin', render: renderFechaLocal },
            { data: 'todo_dia', render: d => normalizarBool(d) ? 'Sí' : 'No' },
            { data: 'ubicacion', render: d => d ? d : '' },
            { data: 'docente_nombre', render: d => d ? d : 'Sin docente' },
            { data: 'grado_nombre', render: d => d ? d : '' },
            { data: 'curso_nombre', render: d => d ? d : '' },
            { data: 'aula_nombre', render: d => d ? d : '' },
            { data: 'year_anio', render: d => d ? d : '' },
            { data: 'recurrente', render: d => normalizarBool(d) ? 'Sí' : 'No' },
            { data: 'regla_recurrencia', defaultContent: '' },
            { data: 'color', render: data => renderColorBadge(data) },
            { data: 'estado' },
            { data: 'created_at', render: renderFechaLocal },
            { data: 'updated_at', render: renderFechaLocal },
            {
                data: null,
                orderable: false,
                searchable: false,
                render: row => `
                    <button class="btn btn-warning btn-sm p-1" onclick="editarEvento(${row.id})">
                        <i class="fa fa-edit fa-sm"></i>
                    </button>
                    <button class="btn btn-danger btn-sm p-1" onclick="eliminarEvento(${row.id})">
                        <i class="fa fa-trash fa-sm"></i>
                    </button>
                    <button class="btn btn-info btn-sm p-1" onclick="notificarEvento(${row.id})">
                        <i class="fas fa-bell fa-sm"></i>
                    </button>
                `
            }
        ],
        language: { url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json' },
        pageLength: 10,
        order: [[3, 'asc']]
    });
}

function renderFechaLocal(data) {
    if (!data) return '';
    // espera formato ISO 'YYYY-MM-DD HH:MM:SS' o similar
    // convertimos a 'YYYY-MM-DDTHH:MM' si queremos usar en input datetime-local
    // para mostrar: podemos devolver 'YYYY-MM-DD HH:MM'
    const d = new Date(data.replace(' ', 'T'));
    if (isNaN(d)) return data;
    const yyyy = d.getFullYear();
    const mm = String(d.getMonth() + 1).padStart(2, '0');
    const dd = String(d.getDate()).padStart(2, '0');
    const hh = String(d.getHours()).padStart(2, '0');
    const min = String(d.getMinutes()).padStart(2, '0');
    return `${yyyy}-${mm}-${dd} ${hh}:${min}`;
}

function normalizarBool(v) {
    return v === 1 || v === '1' || v === true || v === 'true';
}

function renderColorBadge(color) {
    const c = color || '#3788d8';
    return `<span style="background:${c}; color:#fff; padding:3px 8px; border-radius:4px; display:inline-block;">${c}</span>`;
}

/* ---- CRUD AJAX ---- */

function guardarNuevoEvento(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    // Convertir FormData a objeto plano
    const data = Object.fromEntries(formData.entries());
    // Normalizar checkboxes (si no vienen, poner 0)
    data.todo_dia = data.todo_dia ? 1 : 0;
    data.recurrente = data.recurrente ? 1 : 0;

    fetch('../controller/calendario_controller.php?accion=crear', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(async res => {
        const json = await res.json();
        if (!res.ok) throw new Error(json.message || 'Error en servidor');
        return json;
    })
    .then(resp => {
        if (resp.success) {
            alert('Evento creado');
            $('#modalNuevoEvento').modal('hide');
            $('#example').DataTable().ajax.reload();
            $('#formNuevoEvento')[0].reset();
        } else {
            alert('Error: ' + (resp.message || 'No se pudo crear'));
        }
    })
    .catch(err => {
        console.error('crear error:', err);
        alert('Error al crear evento: ' + err.message);
    });
}

function editarEvento(id) {
    fetch(`../controller/calendario_controller.php?accion=obtener&id=${id}`)
    .then(async res => {
        if (!res.ok) {
            const j = await res.json().catch(()=>({message:'error'}));
            throw new Error(j.message || 'Error al obtener evento');
        }
        return res.json();
    })
    .then(evento => {
        if (!evento || evento.error) return alert('Evento no encontrado');
        $('#edit_id').val(evento.id);
        $('#edit_titulo').val(evento.titulo);
        $('#edit_descripcion').val(evento.descripcion);
        $('#edit_fecha_inicio').val(evento.fecha_inicio ? evento.fecha_inicio.slice(0,16) : '');
        $('#edit_fecha_fin').val(evento.fecha_fin ? evento.fecha_fin.slice(0,16) : '');
        $('#edit_todo_dia').prop('checked', normalizarBool(evento.todo_dia));
        $('#edit_ubicacion').val(evento.ubicacion);
        $('#edit_usuario_id').val(evento.usuario_id || '');
        $('#edit_grado_id').val(evento.grado_id || '');
        $('#edit_curso_id').val(evento.curso_id || '');
        $('#edit_aula_id').val(evento.aula_id || '');
        $('#edit_year_id').val(evento.year_id || '');
        $('#edit_recurrente').prop('checked', normalizarBool(evento.recurrente));
        $('#edit_regla_recurrencia').val(evento.regla_recurrencia || '');
        $('#edit_color').val(evento.color || '#3788d8');
        $('#edit_estado').val(evento.estado || 'ACTIVO');
        $('#modalEditarEvento').modal('show');
    })
    .catch(err => {
        console.error('editarEvento error:', err);
        alert('Error al cargar evento: ' + err.message);
    });
}

function notificarEvento(id) {
    fetch(`../controller/calendario_controller.php?accion=obtener&id=${id}`)
    .then(res => res.json())
    .then(evento => {
        console.log('Evento fetched:', evento);
        if (!evento || evento.error) return alert('Evento no encontrado');
        // Pobla datos en mini-modal (agrega inputs hidden o usa globals)
        document.getElementById('notif_id').value = evento.id;
        document.getElementById('notif_titulo').value = evento.titulo;
        document.getElementById('notif_descripcion').value = evento.descripcion || '';
        document.getElementById('notif_fecha_inicio').value = evento.fecha_inicio ? evento.fecha_inicio.slice(0,16) : '';
        document.getElementById('notif_fecha_fin').value = evento.fecha_fin ? evento.fecha_fin.slice(0,16) : '';
        $('#modalNotificacion').modal('show');
    })
    .catch(err => alert('Error: ' + err));
}

function actualizarEvento(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData.entries());
    data.todo_dia = data.todo_dia ? 1 : 0;
    data.recurrente = data.recurrente ? 1 : 0;

    fetch('../controller/calendario_controller.php?accion=actualizar', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(async res => {
        const json = await res.json();
        if (!res.ok) throw new Error(json.message || 'Error actualizar');
        return json;
    })
    .then(resp => {
        if (resp.success) {
            alert('Evento actualizado');
            $('#modalEditarEvento').modal('hide');
            $('#example').DataTable().ajax.reload();
        } else {
            alert('Error: ' + (resp.message || 'No se pudo actualizar'));
        }
    })
    .catch(err => {
        console.error('actualizar error:', err);
        alert('Error al actualizar evento: ' + err.message);
    });
}

function eliminarEvento(id) {
    if (!confirm('¿Eliminar evento?')) return;
    fetch('../controller/calendario_controller.php?accion=eliminar', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id })
    })
    .then(async res => {
        const json = await res.json();
        if (!res.ok) throw new Error(json.message || 'Error eliminar');
        return json;
    })
    .then(resp => {
        if (resp.success) {
            alert('Evento eliminado');
            $('#example').DataTable().ajax.reload();
        } else {
            alert('Error: ' + (resp.message || 'No se pudo eliminar'));
        }
    })
    .catch(err => {
        console.error('eliminar error:', err);
        alert('Error al eliminar evento: ' + err.message);
    });
}

function eliminarEventoConfirm() {
    eliminarEvento($('#edit_id').val());
}

function cargarEstados() {
    fetch('../controller/calendario_controller.php?accion=estados')
        .then(res => res.json())
        .then(estados => {
            const selectNuevo = document.querySelector('select[name="estado"]');
            const selectEditar = document.querySelector('#edit_estado');
            
            [selectNuevo, selectEditar].forEach(select => {
                if (!select) return; // Evita error si el select no existe en esa vista
                select.innerHTML = '<option value="">-- Seleccione --</option>';
                estados.forEach(e => {
                    select.innerHTML += `<option value="${e}">${e}</option>`;
                });
            });
        })
        .catch(err => console.error('Error cargando estados:', err));
}
