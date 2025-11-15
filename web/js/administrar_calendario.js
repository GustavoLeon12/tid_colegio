// Variables globales
let eventosOriginales = [];
let eventosFiltrados = [];
let tablaCalendario;

// Filtros activos
let filtrosActivos = {
    docente: '',
    grado: '',
    curso: '',
    aula: '',
    year: '',
    estado: '',
    fechaDesde: '',
    fechaHasta: ''
};

$(document).ready(function () {
    cargarTablaCalendario();
    cargarCombosParaFiltros();
    cargarEstados();
    
    $('#btnNuevoEvento').on('click', () => $('#modalNuevoEvento').modal('show'));
    $('#formNuevoEvento').on('submit', guardarNuevoEvento);
    $('#formEditarEvento').on('submit', actualizarEvento);
    $('#btnEliminarEvento').on('click', eliminarEventoConfirm);
    
    // Eventos de filtros
    $('#btnAplicarFiltros').on('click', aplicarFiltros);
    $('#btnLimpiarFiltros').on('click', limpiarFiltros);
    $('#btnExportarPDF').on('click', exportarPDF);
    $('#btnExportarExcel').on('click', exportarExcel);
    
    // Listener para notificaciones
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
                $('#tablaCalendario').DataTable().ajax.reload();
            } else {
                alert('Error: ' + resp.message);
            }
        })
        .catch(() => alert('Error de conexión'));
    });
});

// ========== CARGAR TABLA ==========
function cargarTablaCalendario() {
    tablaCalendario = $('#tablaCalendario').DataTable({
        responsive: true,
        autoWidth: false,
        destroy: true,
        ajax: {
            url: '../controller/calendario_controller.php?accion=listar', 
            type: 'POST',
            dataSrc: function(json) {
                eventosOriginales = json;
                eventosFiltrados = json;
                actualizarContador(json.length, json.length);
                return json;
            },
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

// ========== CARGAR COMBOS DE FILTROS ==========
async function cargarCombosParaFiltros() {
    try {
        // Cargar docentes
        const resDocentes = await fetch('../controller/calendario_controller.php?accion=combos&tipo=docentes');
        const textDocentes = await resDocentes.text();
        console.log('Respuesta docentes:', textDocentes);
        const docentes = JSON.parse(textDocentes);
        const selectDocente = document.getElementById('filtro-docente');
        docentes.forEach(doc => {
            selectDocente.innerHTML += `<option value="${doc.id_docente}">${doc.nombre_completo}</option>`;
        });

        // Cargar grados
        const resGrados = await fetch('../controller/calendario_controller.php?accion=combos&tipo=grados');
        const grados = await resGrados.json();
        const selectGrado = document.getElementById('filtro-grado');
        grados.forEach(g => {
            selectGrado.innerHTML += `<option value="${g.idgrado}">${g.gradonombre}</option>`;
        });

        // Cargar cursos
        const resCursos = await fetch('../controller/calendario_controller.php?accion=combos&tipo=cursos');
        const cursos = await resCursos.json();
        const selectCurso = document.getElementById('filtro-curso');
        cursos.forEach(c => {
            selectCurso.innerHTML += `<option value="${c.idcurso}">${c.nonbrecurso}</option>`;
        });

        // Cargar aulas
        const resAulas = await fetch('../controller/calendario_controller.php?accion=combos&tipo=aulas');
        const aulas = await resAulas.json();
        const selectAula = document.getElementById('filtro-aula');
        aulas.forEach(a => {
            selectAula.innerHTML += `<option value="${a.idaula}">${a.nombreaula}</option>`;
        });

        // Cargar años
        const resYears = await fetch('../controller/calendario_controller.php?accion=combos&tipo=years');
        const years = await resYears.json();
        const selectYear = document.getElementById('filtro-year');
        years.forEach(y => {
            selectYear.innerHTML += `<option value="${y.id_year}">${y.yearScolar}</option>`;
        });

    } catch (error) {
        console.error('Error cargando combos:', error);
        console.error('Stack:', error.stack);
    }
}

function cargarEstados() {
    fetch('../controller/calendario_controller.php?accion=estados')
        .then(res => res.json())
        .then(estados => {
            const selectEstado = document.getElementById('filtro-estado');
            const selectNuevo = document.querySelector('select[name="estado"]');
            const selectEditar = document.querySelector('#edit_estado');
            
            estados.forEach(e => {
                if (selectEstado) {
                    selectEstado.innerHTML += `<option value="${e}">${e}</option>`;
                }
                if (selectNuevo) {
                    selectNuevo.innerHTML += `<option value="${e}">${e}</option>`;
                }
                if (selectEditar) {
                    selectEditar.innerHTML += `<option value="${e}">${e}</option>`;
                }
            });
        })
        .catch(err => console.error('Error cargando estados:', err));
}

// ========== APLICAR FILTROS ==========
function aplicarFiltros() {
    // Capturar valores de los filtros
    filtrosActivos = {
        docente: $('#filtro-docente').val(),
        grado: $('#filtro-grado').val(),
        curso: $('#filtro-curso').val(),
        aula: $('#filtro-aula').val(),
        year: $('#filtro-year').val(),
        estado: $('#filtro-estado').val(),
        fechaDesde: $('#filtro-fecha-desde').val(),
        fechaHasta: $('#filtro-fecha-hasta').val()
    };

    // Filtrar eventos
    eventosFiltrados = eventosOriginales.filter(evento => {
        // Filtro por docente
        if (filtrosActivos.docente && evento.usuario_id != filtrosActivos.docente) {
            return false;
        }

        // Filtro por grado
        if (filtrosActivos.grado && evento.grado_id != filtrosActivos.grado) {
            return false;
        }

        // Filtro por curso
        if (filtrosActivos.curso && evento.curso_id != filtrosActivos.curso) {
            return false;
        }

        // Filtro por aula
        if (filtrosActivos.aula && evento.aula_id != filtrosActivos.aula) {
            return false;
        }

        // Filtro por año
        if (filtrosActivos.year && evento.year_id != filtrosActivos.year) {
            return false;
        }

        // Filtro por estado
        if (filtrosActivos.estado && evento.estado != filtrosActivos.estado) {
            return false;
        }

        // Filtro por rango de fechas
        if (filtrosActivos.fechaDesde || filtrosActivos.fechaHasta) {
            const fechaEvento = new Date(evento.fecha_inicio);
            
            if (filtrosActivos.fechaDesde) {
                const fechaDesde = new Date(filtrosActivos.fechaDesde);
                if (fechaEvento < fechaDesde) {
                    return false;
                }
            }
            
            if (filtrosActivos.fechaHasta) {
                const fechaHasta = new Date(filtrosActivos.fechaHasta);
                fechaHasta.setHours(23, 59, 59);
                if (fechaEvento > fechaHasta) {
                    return false;
                }
            }
        }

        return true;
    });

    // Actualizar tabla con datos filtrados
    tablaCalendario.clear();
    tablaCalendario.rows.add(eventosFiltrados);
    tablaCalendario.draw();

    // Actualizar contador
    actualizarContador(eventosFiltrados.length, eventosOriginales.length);

    // Mostrar mensaje
    mostrarMensaje('success', `Se encontraron ${eventosFiltrados.length} eventos`);
}

// ========== LIMPIAR FILTROS ==========
function limpiarFiltros() {
    // Resetear valores
    $('#filtro-docente').val('');
    $('#filtro-grado').val('');
    $('#filtro-curso').val('');
    $('#filtro-aula').val('');
    $('#filtro-year').val('');
    $('#filtro-estado').val('');
    $('#filtro-fecha-desde').val('');
    $('#filtro-fecha-hasta').val('');

    filtrosActivos = {
        docente: '',
        grado: '',
        curso: '',
        aula: '',
        year: '',
        estado: '',
        fechaDesde: '',
        fechaHasta: ''
    };

    // Restaurar todos los eventos
    eventosFiltrados = eventosOriginales;
    tablaCalendario.clear();
    tablaCalendario.rows.add(eventosFiltrados);
    tablaCalendario.draw();

    actualizarContador(eventosFiltrados.length, eventosOriginales.length);
    mostrarMensaje('info', 'Filtros limpiados');
}

// ========== ACTUALIZAR CONTADOR ==========
function actualizarContador(mostrados, total) {
    const texto = document.getElementById('textoContador');
    if (mostrados === total) {
        texto.textContent = `Mostrando todos los ${total} eventos`;
    } else {
        texto.textContent = `Mostrando ${mostrados} de ${total} eventos (filtrados)`;
    }
}

// ========== EXPORTAR PDF ==========
async function exportarPDF() {
    const btnPdf = document.getElementById('btnExportarPDF');
    
    if (eventosFiltrados.length === 0) {
        mostrarMensaje('warning', 'No hay eventos para exportar');
        return;
    }

    btnPdf.classList.add('btn-loading');
    btnPdf.disabled = true;
    const textOriginal = btnPdf.innerHTML;
    btnPdf.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generando PDF...';

    try {
        const formData = new FormData();
        formData.append('accion', 'exportar_pdf');
        formData.append('eventos', JSON.stringify(eventosFiltrados));
        formData.append('filtros', JSON.stringify(filtrosActivos));

        const response = await fetch('../controller/calendario_controller.php?accion=export_pdf', {
            method: 'POST',
            body: formData
        });

        if (!response.ok) throw new Error('Error al generar PDF');

        const blob = await response.blob();
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `calendario_eventos_${obtenerFechaHoy()}.pdf`;
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);

        mostrarMensaje('success', 'PDF descargado correctamente');
    } catch (error) {
        console.error('Error:', error);
        mostrarMensaje('error', 'Error al generar el PDF');
    } finally {
        btnPdf.classList.remove('btn-loading');
        btnPdf.disabled = false;
        btnPdf.innerHTML = textOriginal;
    }
}

// ========== EXPORTAR EXCEL ==========
async function exportarExcel() {
    const btnExcel = document.getElementById('btnExportarExcel');
    
    if (eventosFiltrados.length === 0) {
        mostrarMensaje('warning', 'No hay eventos para exportar');
        return;
    }

    btnExcel.classList.add('btn-loading');
    btnExcel.disabled = true;
    const textOriginal = btnExcel.innerHTML;
    btnExcel.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generando Excel...';

    try {
        const formData = new FormData();
        formData.append('accion', 'exportar_excel');
        formData.append('eventos', JSON.stringify(eventosFiltrados));
        formData.append('filtros', JSON.stringify(filtrosActivos));

        const response = await fetch('../controller/calendario_controller.php?accion=export_excel', {
            method: 'POST',
            body: formData
        });

        if (!response.ok) throw new Error('Error al generar Excel');

        const blob = await response.blob();
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `calendario_eventos_${obtenerFechaHoy()}.xlsx`;
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);

        mostrarMensaje('success', 'Excel descargado correctamente');
    } catch (error) {
        console.error('Error:', error);
        mostrarMensaje('error', 'Error al generar el Excel');
    } finally {
        btnExcel.classList.remove('btn-loading');
        btnExcel.disabled = false;
        btnExcel.innerHTML = textOriginal;
    }
}

// ========== FUNCIONES AUXILIARES ==========
function renderFechaLocal(data) {
    if (!data) return '';
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

function obtenerFechaHoy() {
    const hoy = new Date();
    const yyyy = hoy.getFullYear();
    const mm = String(hoy.getMonth() + 1).padStart(2, '0');
    const dd = String(hoy.getDate()).padStart(2, '0');
    return `${yyyy}${mm}${dd}`;
}

function mostrarMensaje(tipo, mensaje) {
    const colores = {
        success: '#28a745',
        error: '#dc3545',
        warning: '#ffc107',
        info: '#17a2b8'
    };

    const iconos = {
        success: 'check-circle',
        error: 'exclamation-circle',
        warning: 'exclamation-triangle',
        info: 'info-circle'
    };

    const div = document.createElement('div');
    div.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: white;
        padding: 15px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 10000;
        display: flex;
        align-items: center;
        gap: 10px;
        border-left: 4px solid ${colores[tipo]};
        max-width: 350px;
        animation: slideIn 0.3s ease;
    `;

    div.innerHTML = `
        <i class="fas fa-${iconos[tipo]}" style="color: ${colores[tipo]}; font-size: 20px;"></i>
        <span style="color: #333; font-size: 14px;">${mensaje}</span>
        <button onclick="this.parentElement.remove()" style="
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #999;
            margin-left: auto;
        ">&times;</button>
    `;

    document.body.appendChild(div);

    setTimeout(() => {
        if (div.parentElement) {
            div.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => div.remove(), 300);
        }
    }, 4000);
}

// ========== FUNCIONES CRUD ==========
function guardarNuevoEvento(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData.entries());
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
            $('#tablaCalendario').DataTable().ajax.reload();
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
            $('#tablaCalendario').DataTable().ajax.reload();
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
            $('#tablaCalendario').DataTable().ajax.reload();
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

// Agregar estilos de animación
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);