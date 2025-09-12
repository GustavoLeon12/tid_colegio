var editando = false;
function Registrar_cat() {
  var id = $("#txt_id").val();
  var codigocat = $("#codigocat").val();
  var nombrecat = $("#txt_nom_cat").val().toUpperCase();

  if (codigocat.length == 0 || nombrecat.length == 0) {
    return Swal.fire(
      "Mensaje de Advertencia",
      "Llene espacio vacios",
      "warning"
    );
  }

  $.ajax({
    url:
      editando === false
        ? "../controlador/curso/controlador_registrar_cat.php"
        : "../controlador/curso/controlador_curso_Actualizarcat.php",
    type: "POST",
    data: {
      id: id,
      codigocat: codigocat,
      nombrecat: nombrecat,
    },
  }).done(function (Request) {
    XMLHttpRequestAsycn(Request);
  });
}

function LimpiarRegistroCat() {
  $("#codigocat").val("");
  $("#txt_nom_cat").val("");
  $("#txt_cred").val("");
  $("#cbm_sem").val("").trigger("change");

  editando = false;
}

var table_categoria_curso;

function listar_cat() {
  table_categoria_curso = $("#tabla_categoria").DataTable({
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
      url: "../controlador/curso/controlador_listar_cat.php",
      type: "POST",
    },
    columns: [
      {
        data: "id",
      },
      {
        data: "categoriaCodigo",
      },
      {
        data: "nombrecat",
      },
      {
        defaultContent:
          "<button type='button' class='editar btn btn-primary btn-sm'><em class='fa fa-edit' title='editar'></em></button>&nbsp;<button type='button' class='eliminar btn btn-default btn-sm'><em class='fa fa-trash' title='Eliminar'></em></button>",
      },
    ],
    language: idioma_espanol,
    select: true,
  });
  document.getElementById("tabla_categoria_filter").style.display = "none";
  $("input.global_filter").on("keyup click", function () {
    filterGlobal();
  });
  $("input.column_filter").on("keyup click", function () {
    filterColumn($(this).parents("tr").attr("data-column"));
  });
}
function filterGlobal() {
  $("#tabla_categoria").DataTable().search($("#global_filter").val()).draw();
}

$("#tabla_categoria").on("click", ".editar", function () {
  var data = table_categoria_curso.row($(this).parents("tr")).data();
  if (table_categoria_curso.row(this).child.isShown()) {
    var data = table_categoria_curso.row(this).data();
    var idedit = data.id;
  }
  var idedit = data.id;
  editando = true;

  $("#txt_id").val(idedit);
  $("#codigocat").val(data.categoriaCodigo);
  $("#txt_nom_cat").val(data.nombrecat);
});

$("#tabla_categoria").on("click", ".eliminar", function () {
  var data = table_categoria_curso.row($(this).parents("tr")).data();

  if (table_categoria_curso.row(this).child.isShown()) {
    var data = table_categoria_curso.row(this).data();
    var id = data.id;
  }
  var id = data.id;
  $.ajax({
    url: "../controlador/curso/controlador_curso_eliminarcat.php",
    type: "POST",
    data: {
      id: id,
    },
  }).done(function (resp) {
    console.log("fdsafds");
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
      LimpiarRegistroCat();

      table_categoria_curso.ajax.reload();

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
