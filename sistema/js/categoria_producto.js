var editando = false;
function cancelarCategoria() {
  editando = false;
  $("#descripcion-categoria").val("");
  $("#detalle-categoria").val("");
  const $modal = document.getElementById("modal");
  $modal.classList.toggle("modal-active");
}
async function obtenerCategoria() {
  const $categoria = document.getElementById("categoria");
  const res = await fetch(
    "../controlador/categoriaProducto/controlador_listar_categoria.php"
  );
  const json = await res.json();

  $categoria.innerHTML = "";
  json.forEach((element) => {
    $categoria.innerHTML += `
      <option value="${element.idcategoria_producto}">${element.descripcion}</option>
    `;
  });
}
function registrarCategoria() {
  var id = $("#txt_id").val();
  var detalle = $("#detalle-categoria").val();
  var descripcion = $("#descripcion-categoria").val();
  var fechaCreacion = $("#fh_creacion-categoria").val();

  if (descripcion.length == 0 || fechaCreacion.length == 0) {
    return Swal.fire(
      "Mensaje de Advertencia",
      "Llene espacio vacios",
      "warning"
    );
  }

  $.ajax({
    url:
      editando === false
        ? "../controlador/categoriaProducto/controlador_registrar_categoria.php"
        : "../controlador/categoriaProducto/controlador_actualizar_categoria.php",
    type: "POST",
    data: {
      id: id,
      descripcion: descripcion,
      fechaCreacion: fechaCreacion,
      detalle: detalle,
    },
  }).done(function (Request) {
    XMLHttpRequestAsycn(Request);
  });

  const $modal = document.getElementById("modal");
  $modal.classList.toggle("modal-active");
  obtenerCategoria();
}

function limpiarRegistro() {
  $("#descripcion-categoria").val("");
  $("#detalle-categoria").val("");
  editando = false;
}

var table_select;

function listarCategoria() {
  table_select = $("#tabla_data").DataTable({
    ordering: false,
    bLengthChange: false,
    searching: {
      regex: false,
    },
    lengthMenu: [
      [5, 25, 50, 100, -1],
      [5, 25, 50, 100, "All"],
    ],
    pageLength: 5,
    destroy: true,
    async: false,
    processing: true,
    ajax: {
      url: "../controlador/categoriaProducto/controlador_listar_categoria.php", // GET
      type: "POST",
      dataSrc: "",
    },
    columns: [
      {
        data: "idcategoria_producto",
      },
      {
        data: "descripcion",
      },
      {
        data: "detalle",
      },
      {
        data: "fecha_creacion",
      },
      {
        defaultContent:
          "<button type='button' class='editar btn btn-primary btn-sm'><em class='fa fa-edit' title='editar'></em></button>&nbsp;<button type='button' class='eliminar btn btn-default btn-sm'><em class='fa fa-trash' title='Eliminar'></em></button>",
      },
    ],
    language: idioma_espanol,
    select: true,
  });
  document.getElementById("tabla_data_filter").style.display = "none";
  $("input.global_filter").on("keyup click", function () {
    filterGlobal();
  });
  $("input.column_filter").on("keyup click", function () {
    filterColumn($(this).parents("tr").attr("data-column"));
  });
}

function filterGlobal() {
  $("#tabla_data").DataTable().search($("#global_filter").val()).draw();
}

$("#tabla_data").on("click", ".editar", function () {
  const $modal = document.getElementById("modal");
  $modal.classList.toggle("modal-active");

  var data = table_select.row($(this).parents("tr")).data();
  if (table_select.row(this).child.isShown()) {
    var data = table_select.row(this).data();
    var idedit = data.idcategoria_producto;
  }
  var idedit = data.idcategoria_producto;
  console.log(idedit);
  editando = true;

  $("#txt_id").val(idedit);
  $("#descripcion-categoria").val(data.descripcion);
  $("#detalle-categoria").val(data.detalle);
  $("#fh_creacion-categoria").val(data.fecha_creacion);
});

$("#tabla_data").on("click", ".eliminar", function () {
  var data = table_select.row($(this).parents("tr")).data();

  if (table_select.row(this).child.isShown()) {
    var data = table_select.row(this).data();
    var id = data.idcategoria_producto;
  }
  var id = data.idcategoria_producto;
  $.ajax({
    url: "../controlador/categoriaProducto/controlador_eliminar_categoria.php", // DELETE
    type: "POST",
    data: {
      id: id,
    },
  }).done(function (resp) {
    XMLHttpRequestAsycn(resp);
  });
});

function XMLHttpRequestAsycn(Request) {
  if (Request > 0) {
    if (Request == 100) {
      Swal.fire({
        title: "Mensaje De Advertencia",
        text: "El Registro Similar(Igual) a esto ya Existe",
        icon: "warning",
        customClass: {
          popup: 'z-index-custom' // Clase CSS con z-index personalizado
        }
      });
    }
    if (Request == 1) {
      $("#modal_regist_cat").modal("hide");
      limpiarRegistro();

      table_select.ajax.reload();

      Swal.fire({
        title: "Éxito !!",
        text: "El Registro, se registro de forma Éxitoso!!",
        icon: "success",
        showConfirmButton: false,
        timer: 1700,
        customClass: {
          popup: 'z-index-custom' // Clase CSS con z-index personalizado
        }
      });
    }
    if (Request == 404) {
      window.location = "NotFound";
    }
  } else {
    Swal.fire({
      title: "Mensaje De Error",
      text: "No se registro Registro Fallido!!" + Request,
      icon: "error",
      customClass: {
        popup: 'z-index-custom' // Clase CSS con z-index personalizado
      }
    });
  }
}