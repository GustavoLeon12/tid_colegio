var editando = false;
function registrar() {
  var id = $("#id").val();

  var nombre = $("#nombre").val();
  var apellido = $("#apellido").val();
  var correo = $("#correo").val();
  var telefono = $("#telefono").val();
  var documento = $("#documento").val();
  var direccion = $("#direccion").val();
  var fkUbigeo = $("#fkUbigeo").val()
  var fkTpDocu = $("#fkTpDocu").val()
  var tipo = $("#tipo").val() 

  if (
    nombre.length == 0 ||
    apellido.length == 0 ||
    correo.length == 0 ||
    telefono.length == 0 ||
    direccion.length == 0 ||
    fkUbigeo.length == 0 ||
    fkTpDocu.length == 0 ||
    tipo.length == 0||
    documento.length == 0
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
        ? "../controlador/cliente/controlador_registrar_cliente.php"
        : "../controlador/cliente/controlador_actualizar_cliente.php",
    type: "POST",
    data: {
      id: id,
      nombre, 
      apellido, 
      correo, 
      telefono, 
      direccion, 
      fkUbigeo, 
      fkTpDocu, 
      tipo,  
      documento
    },
  }).done(function (Request) {
    XMLHttpRequestAsycn(Request);
  });
}

function limpiar() {
  $("#nombre").val("");
  $("#apellido").val("");
  $("#correo").val("");
  $("#telefono").val("");
  $("#direccion").val("");
  $("#fkUbigeo").val("")
  $("#fkTpDocu").val("")
  $("#tipo").val("") 
  $("#documento").val("") 
  
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
      url: "../controlador/cliente/controlador_listar_cliente.php",
      type: "POST",
      dataSrc: "",
    },
    columns: [
      {
        data: "id_usuario",
      },
      {
        data: "nombre",
      },
      {
        data: "apellido",
      },
      {
        data: "correo",
      },
      {
        data: "telefono",
      },
      {
        data: "documento",
      },
      {
        data: "direccion",
      },
      {
        data: "tipo",
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
    var idedit = data.id_usuario;
  }
  var idedit = data.id_usuario;
  editando = true;
  $("#nombre").val(idedit);
  $("#nombre").val(data.nombre);
  $("#apellido").val(data.apellido);
  $("#correo").val(data.correo);
  $("#telefono").val(data.telefono);
  $("#documento").val(data.documento);
  $("#direccion").val(data.direccion);
});

$("#table_select").on("click", ".eliminar", function () {
  var data = tabla_select.row($(this).parents("tr")).data();

  if (tabla_select.row(this).child.isShown()) {
    var data = tabla_select.row(this).data();
    var id = data.id_usuario;
  }
  var id = data.id_usuario;
  $.ajax({
    url: "../controlador/cliente/controlador_eliminar_cliente.php",
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
