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
    $('#btnEnviarNotif').on('click', enviarNotificacion);
    
    // Fix para el warning de aria-hidden
    $('#modalNotificacion').on('show.bs.modal', function() {
        setTimeout(() => {
            $(this).removeAttr('aria-hidden');
        }, 100);
    });
});

// funcion para enviar notificacion 
function enviarNotificacion() {
    const dest = $('#destinatarios').val().trim();
    if (!dest) {
        mostrarMensaje('warning', 'Debes agregar al menos un email');
        return;
    }
    
    const id = $('#notif_id').val();
    if (!id) {
        mostrarMensaje('error', 'ID de evento inválido');
        return;
    }

    const btnEnviar = $('#btnEnviarNotif');
    btnEnviar.prop('disabled', true);
    const textoOriginal = btnEnviar.html();
    btnEnviar.html('<i class="fas fa-spinner fa-spin"></i> Enviando...');

    fetch('../controller/calendario_controller.php?accion=enviar_notif', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            id: id,
            notificacion: { 
                tipo: 'email', 
                destinatarios: dest.split(',').map(d => d.trim()).filter(Boolean)
            }
        })
    })
    .then(async res => {
        const json = await res.json();
        if (!res.ok) throw new Error(json.message || 'Error al enviar notificación');
        return json;
    })
    .then(resp => {
        if (resp.success) {
            mostrarMensaje('success', `Notificación enviada a ${resp.enviados} destinatario(s)`);
            $('#modalNotificacion').modal('hide');
            $('#destinatarios').val('');
            $('#tablaCalendario').DataTable().ajax.reload();
        } else {
            throw new Error(resp.message || 'Error desconocido');
        }
    })
    .catch(err => {
        console.error('Error enviando notificación:', err);
        mostrarMensaje('error', 'Error al enviar notificación: ' + err.message);
    })
    .finally(() => {
        btnEnviar.prop('disabled', false);
        btnEnviar.html(textoOriginal);
    });
}

// cargar data table con paginación personalizada
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
                mostrarMensaje('error', 'Error al cargar eventos. Revisa la consola.');
            }
        },
        columns: [
            { data: 'id' },
            { data: 'titulo', render: d => d ? d : '' },
            { data: 'descripcion', render: d => d ? truncarTexto(d, 50) : '' },
            { data: 'fecha_inicio', render: renderFechaLocal },
            { data: 'fecha_fin', render: renderFechaLocal },
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
                    <button class="btn btn-warning btn-sm p-1" onclick="editarEvento(${row.id})" title="Editar">
                        <i class="fa fa-edit fa-sm"></i>
                    </button>
                    <button class="btn btn-danger btn-sm p-1" onclick="eliminarEvento(${row.id})" title="Eliminar">
                        <i class="fa fa-trash fa-sm"></i>
                    </button>
                    <button class="btn btn-info btn-sm p-1" onclick="notificarEvento(${row.id})" title="Notificar">
                        <i class="fas fa-bell fa-sm"></i>
                    </button>
                `
            }
        ],
        language: { 
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            paginate: {
                first: '',
                last: '',
                next: '<i class="fas fa-chevron-right"></i>',
                previous: '<i class="fas fa-chevron-left"></i>'
            }
        },
        pageLength: 10,
        order: [[3, 'asc']],
        // Personalizar la paginación
        drawCallback: function() {
            // Ocultar textos "First" y "Last"
            $('.dataTables_paginate .paginate_button.first, .dataTables_paginate .paginate_button.last').hide();
        }
    });
}

// cargar combos para filtros
async function cargarCombosParaFiltros() {
    try {
        // Cargar docentes
        const resDocentes = await fetch('../controller/calendario_controller.php?accion=combos&tipo=docentes');
        const docentes = await resDocentes.json();
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
        mostrarMensaje('error', 'Error al cargar filtros');
    }
}

function cargarEstados() {
    fetch('../controller/calendario_controller.php?accion=estados')
        .then(res => res.json())
        .then(estados => {
            const selectEstado = document.getElementById('filtro-estado');
            
            estados.forEach(e => {
                if (selectEstado) {
                    selectEstado.innerHTML += `<option value="${e}">${e}</option>`;
                }
            });
        })
        .catch(err => {
            console.error('Error cargando estados:', err);
            mostrarMensaje('error', 'Error al cargar estados');
        });
}

// aplicar filtros
function aplicarFiltros() {
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

    eventosFiltrados = eventosOriginales.filter(evento => {
        if (filtrosActivos.docente && evento.usuario_id != filtrosActivos.docente) {
            return false;
        }

        if (filtrosActivos.grado && evento.grado_id != filtrosActivos.grado) {
            return false;
        }

        if (filtrosActivos.curso && evento.curso_id != filtrosActivos.curso) {
            return false;
        }

        if (filtrosActivos.aula && evento.aula_id != filtrosActivos.aula) {
            return false;
        }

        if (filtrosActivos.year && evento.year_id != filtrosActivos.year) {
            return false;
        }

        if (filtrosActivos.estado && evento.estado != filtrosActivos.estado) {
            return false;
        }

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

    tablaCalendario.clear();
    tablaCalendario.rows.add(eventosFiltrados);
    tablaCalendario.draw();

    actualizarContador(eventosFiltrados.length, eventosOriginales.length);
    mostrarMensaje('success', `Se encontraron ${eventosFiltrados.length} eventos`);
}

// ========== LIMPIAR FILTROS ==========
function limpiarFiltros() {
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

// ========== EXPORTAR PDF - CORREGIDO ==========
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
        const filtrosParaEnviar = {};
        if (filtrosActivos.docente) filtrosParaEnviar.usuario_id = filtrosActivos.docente;
        if (filtrosActivos.grado) filtrosParaEnviar.grado_id = filtrosActivos.grado;
        if (filtrosActivos.curso) filtrosParaEnviar.curso_id = filtrosActivos.curso;
        if (filtrosActivos.aula) filtrosParaEnviar.aula_id = filtrosActivos.aula;
        if (filtrosActivos.year) filtrosParaEnviar.year_id = filtrosActivos.year;
        if (filtrosActivos.fechaDesde) filtrosParaEnviar.fecha_inicio = filtrosActivos.fechaDesde;
        if (filtrosActivos.fechaHasta) filtrosParaEnviar.fecha_fin = filtrosActivos.fechaHasta;

        const response = await fetch('../controller/calendario_controller.php?accion=export_pdf', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(filtrosParaEnviar)
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
        mostrarMensaje('error', 'Error al generar el PDF: ' + error.message);
    } finally {
        btnPdf.classList.remove('btn-loading');
        btnPdf.disabled = false;
        btnPdf.innerHTML = textOriginal;
    }
}

// ========== EXPORTAR EXCEL - CORREGIDO ==========
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
        const filtrosParaEnviar = {};
        if (filtrosActivos.docente) filtrosParaEnviar.usuario_id = filtrosActivos.docente;
        if (filtrosActivos.grado) filtrosParaEnviar.grado_id = filtrosActivos.grado;
        if (filtrosActivos.curso) filtrosParaEnviar.curso_id = filtrosActivos.curso;
        if (filtrosActivos.aula) filtrosParaEnviar.aula_id = filtrosActivos.aula;
        if (filtrosActivos.year) filtrosParaEnviar.year_id = filtrosActivos.year;
        if (filtrosActivos.fechaDesde) filtrosParaEnviar.fecha_inicio = filtrosActivos.fechaDesde;
        if (filtrosActivos.fechaHasta) filtrosParaEnviar.fecha_fin = filtrosActivos.fechaHasta;

        const response = await fetch('../controller/calendario_controller.php?accion=export_excel', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(filtrosParaEnviar)
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
        mostrarMensaje('error', 'Error al generar el Excel: ' + error.message);
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

function truncarTexto(texto, maxLen) {
    if (!texto) return '';
    if (texto.length <= maxLen) return texto;
    return texto.substring(0, maxLen) + '...';
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
            mostrarMensaje('success', 'Evento creado exitosamente');
            $('#modalNuevoEvento').modal('hide');
            $('#tablaCalendario').DataTable().ajax.reload();
            $('#formNuevoEvento')[0].reset();
        } else {
            throw new Error(resp.message || 'No se pudo crear');
        }
    })
    .catch(err => {
        console.error('crear error:', err);
        mostrarMensaje('error', 'Error al crear evento: ' + err.message);
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
        if (!evento || evento.error) {
            mostrarMensaje('error', 'Evento no encontrado');
            return;
        }
        $('#edit_id').val(evento.id);
        $('#edit_titulo').val(evento.titulo);
        $('#edit_descripcion').val(evento.descripcion);
        $('#edit_fecha_inicio').val(evento.fecha_inicio ? evento.fecha_inicio.slice(0,16) : '');
        $('#edit_fecha_fin').val(evento.fecha_fin ? evento.fecha_fin.slice(0,16) : '');
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
        mostrarMensaje('error', 'Error al cargar evento: ' + err.message);
    });
}

function notificarEvento(id) {
    fetch(`../controller/calendario_controller.php?accion=obtener&id=${id}`)
    .then(res => res.json())
    .then(evento => {
        if (!evento || evento.error) {
            mostrarMensaje('error', 'Evento no encontrado');
            return;
        }
        document.getElementById('notif_id').value = evento.id;
        document.getElementById('notif_titulo').value = evento.titulo;
        document.getElementById('notif_descripcion').value = evento.descripcion || '';
        document.getElementById('notif_fecha_inicio').value = evento.fecha_inicio ? evento.fecha_inicio.slice(0,16) : '';
        document.getElementById('notif_fecha_fin').value = evento.fecha_fin ? evento.fecha_fin.slice(0,16) : '';
        $('#modalNotificacion').modal('show');
    })
    .catch(err => {
        console.error('Error al cargar evento:', err);
        mostrarMensaje('error', 'Error al cargar evento para notificar');
    });
}

function actualizarEvento(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData.entries());
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
            mostrarMensaje('success', 'Evento actualizado exitosamente');
            $('#modalEditarEvento').modal('hide');
            $('#tablaCalendario').DataTable().ajax.reload();
        } else {
            throw new Error(resp.message || 'No se pudo actualizar');
        }
    })
    .catch(err => {
        console.error('actualizar error:', err);
        mostrarMensaje('error', 'Error al actualizar evento: ' + err.message);
    });
}

function eliminarEvento(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Se marcará como inactivo y no podrás revertirlo fácilmente",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('../controller/calendario_controller.php?accion=eliminar', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id })
            })
            .then(res => res.json())
            .then(resp => {
                if (resp.success) {
                    Swal.fire('Eliminado', 'El evento ha sido eliminado.', 'success');
                    tablaCalendario.ajax.reload();
                } else {
                    Swal.fire('Error', resp.message || 'No se pudo eliminar', 'error');
                }
            })
            .catch(() => Swal.fire('Error', 'Error al eliminar el evento', 'error'));
        }
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
    
    .btn-loading {
        position: relative;
        pointer-events: none;
        opacity: 0.7;
    }
    
    /* Personalización de paginación DataTables */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 6px 12px !important;
        margin: 0 2px !important;
        border-radius: 4px !important;
        border: 1px solid #dee2e6 !important;
        font-size: 0.85rem !important;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #06426a !important;
        color: white !important;
        border-color: #06426a !important;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #06426a !important;
        color: white !important;
        border-color: #06426a !important;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.previous,
    .dataTables_wrapper .dataTables_paginate .paginate_button.next {
        font-size: 0 !important;
        padding: 6px 10px !important;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.previous i,
    .dataTables_wrapper .dataTables_paginate .paginate_button.next i {
        font-size: 0.85rem !important;
    }
    `;
document.head.appendChild(style);