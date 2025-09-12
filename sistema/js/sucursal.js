var editando = false;
function registrarSucursal() {
  var id = $("#id").val();

  var codigoSucursal = $("#codigoSucursal").val();
  var denominacion = $("#denominacion").val();
  var direccion = $("#direccion").val();
  var ubigeo = $("#ubigeo").val();
  var codigoSunat = $("#codigoSunat").val();
  var activo = $("#activo").val() === "on" ? "1" : 0;
  console.log(activo);

  if (
    codigoSucursal.length == 0 ||
    denominacion.length == 0 ||
    direccion.length == 0 ||
    ubigeo.length == 0 ||
    codigoSunat.length == 0
  ) {
    return Swal.fire(
      "Mensaje de Advertencia",
      "Llene espacio vacios",
      "warning"
    );
  }

  $.ajax({
    url:
      editando === false
        ? "../controlador/sucursal/controlador_registrar_sucursal.php"
        : "../controlador/sucursal/controlador_actualizar_sucursal.php",
    type: "POST",
    data: {
      id: id,
      codigoSucursal: codigoSucursal,
      denominacion: denominacion,
      direccion: direccion,
      ubigeo: ubigeo,
      codigoSunat: codigoSunat,
      activo: activo,
    },
  }).done(function (Request) {
    XMLHttpRequestAsycn(Request);
  });
}

function limpiar() {
  $("#id").val("");
  $("#codigoSucursal").val("");
  $("#denominacion").val("");
  $("#direccion").val("");
  $("#ubigeo").val("");
  $("#codigoSunat").val("");
  $("#activo").val("");

  editando = false;
}

var tabla_select;

function listar() {
  tabla_select = $("#table_select").DataTable({
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
      url: "../controlador/sucursal/controlador_listar_sucursal.php",
      type: "POST",
      dataSrc: "",
    },
    columns: [
      {
        data: "id_sucursal",
      },
      {
        data: "cod_sucursal",
      },
      {
        data: "denominacion",
      },
      {
        data: "direccion",
      },
      {
        data: "ubigeo",
      },
      {
        data: "cod_sunat",
      },
      {
        data: "activo",
        render: function (data, type, row) {
          return data === "1"
            ? "<span class='label label-success'>ACTIVO</span>"
            : "<span class='label label-warning'>NO ACTIVO</span>";
        },
      },
      {
        defaultContent:
          "<button type='button' class='editar btn btn-primary btn-sm'><em class='fa fa-edit' title='editar'></em></button>&nbsp;<button type='button' class='eliminar btn btn-default btn-sm'><em class='fa fa-trash' title='Eliminar'></em></button>",
      },
    ],
    language: idioma_espanol,
    select: true,
  });
  document.getElementById("table_select_filter").style.display = "none";
  $("input.global_filter").on("keyup click", function () {
    filterGlobal();
  });
  $("input.column_filter").on("keyup click", function () {
    filterColumn($(this).parents("tr").attr("data-column"));
  });
}
function filterGlobal() {
  $("#table_select").DataTable().search($("#global_filter").val()).draw();
}

$("#table_select").on("click", ".editar", function () {
  var data = tabla_select.row($(this).parents("tr")).data();
  if (tabla_select.row(this).child.isShown()) {
    var data = tabla_select.row(this).data();
    var idedit = data.id_sucursal;
  }
  var idedit = data.id_sucursal;
  editando = true;

  $("#id").val(idedit);
  $("#codigoSucursal").val(data.cod_sucursal);
  $("#denominacion").val(data.denominacion);
  $("#direccion").val(data.direccion);
  $("#ubigeo").val(data.ubigeo);
  $("#codigoSunat").val(data.cod_sunat);
  if (data.activo == "1") {
    $("#activo").prop("checked", true);
  } else {
    $("#activo").prop("checked", false);
  }
});

$("#table_select").on("click", ".eliminar", function () {
  var data = tabla_select.row($(this).parents("tr")).data();

  if (tabla_select.row(this).child.isShown()) {
    var data = tabla_select.row(this).data();
    var id = data.id_sucursal;
  }
  var id = data.id_sucursal;
  $.ajax({
    url: "../controlador/sucursal/controlador_eliminar_sucursal.php",
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
      limpiar();

      tabla_select.ajax.reload();

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
