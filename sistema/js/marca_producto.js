var editando = false;
function cancelarMarca() {
  editando = false;
  $("#descripcion-marca").val("");
  const $modal = document.getElementById("modalmarca");
  $modal.classList.toggle("modalmarca-active");
}
async function obtenerMarca() {
  const $marca = document.getElementById("marca");
  const res = await fetch("../controlador/marca/controlador_listar_marca.php");
  const json = await res.json();

  $marca.innerHTML = "";
  json.forEach((element) => {
    $marca.innerHTML += `
      <option value="${element.id_marca}">${element.descripcion}</option>
    `;
  });
}
function registrarMarca() {
  var id = $("#txt_id").val();
  var descripcion = $("#descripcion-marca").val();
  var fechaCreacion = $("#fh_creacion-marca").val();

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
        ? "../controlador/marca/controlador_registrar_marca.php"
        : "../controlador/marca/controlador_actualizar_marca.php",
    type: "POST",
    data: {
      id: id,
      descripcion: descripcion,
      fechaCreacion: fechaCreacion,
    },
  }).done(function (Request) {
    XMLHttpRequestAsycn(Request);
  });

  const $modal = document.getElementById("modalmarca");
  $modal.classList.toggle("modalmarca-active");
  obtenerMarca();
}

function limpiarRegistro() {
  $("#descripcion-marca").val("");
  editando = false;
}

// TODO: Cambiar nombre de variable y valor del atributo ID
var table_select;

function listar_marca() {
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
      url: "../controlador/marca/controlador_listar_marca.php", // GET
      type: "POST",
      dataSrc: "",
    },
    columns: [
      {
        data: "id_marca",
      },
      {
        data: "descripcion",
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
  const $modal = document.getElementById("modalmarca");
  $modal.classList.toggle("modalmarca-active");

  var data = table_select.row($(this).parents("tr")).data();
  if (table_select.row(this).child.isShown()) {
    var data = table_select.row(this).data();
    var idedit = data.id_marca;
  }
  var idedit = data.id_marca;
  console.log(idedit);
  editando = true;

  $("#txt_id").val(idedit);
  $("#descripcion-marca").val(data.descripcion);
  $("#fh_creacion-marca").val(data.fecha_creacion);
});

$("#tabla_data").on("click", ".eliminar", function () {
  var data = table_select.row($(this).parents("tr")).data();

  if (table_select.row(this).child.isShown()) {
    var data = table_select.row(this).data();
    var id = data.id_marca;
  }
  var id = data.id_marca;
  $.ajax({
    url: "../controlador/marca/controlador_eliminar_marca.php", // DELETE
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
      return Swal.fire(
        "Mensaje De Advertencia",
        "El Registro Similar(Igual) a esto ya  Existe",
        "warning"
      );
    }
    if (Request == 1) {
      $("#modal_regist_cat").modal("hide");
      limpiarRegistro();

      table_select.ajax.reload();

      Swal.fire({
        icon: "success",
        title: "Éxito !!",
        text: "El Registro, se registro  de forma Éxitoso!! ",
        showConfirmButton: false,
        timer: 1700,
      });
    }
    if (Request == 404) {
      window.location = "NotFound";
    }
  } else {
    return Swal.fire(
      "Mensaje De Error",
      "No se registro Registro Fallido!!" + Request + "",
      "error"
    );
  }
}
