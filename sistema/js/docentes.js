var editando = false;
var table;
function listar_docentesRegistrados() {
  table = $("#tabla_docente").DataTable({
    ordering: true,
    bLengthChange: false,
    searching: {
      regex: false,
    },
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    responsive: true,
    dom: "Bfrtilp",

    buttons: [
      {
        extend: "excelHtml5",
        text: '<i class="fa fa-file-excel-o"></i> ',
        titleAttr: "Exportar a Excel",
      },
      {
        extend: "pdfHtml5",
        text: '<i class="fa fa-file-pdf-o"></i> ',
        titleAttr: "Exportar a PDF",
      },
    ],
    pageLength: 10,
    destroy: true,
    async: false,
    processing: true,
    ajax: {
      url: "../controlador/docente/controlador_docente_listar.php",
      type: "POST", //id_docente, nombres, apellidos, dni, nombreNivell,telefono, tipo_docente
    },
    columns: [
      { data: "id_docente" },
      { data: "nombres" },
      { data: "apellidos" },
      { data: "dni" },
      { data: "nombreNivell" },
      { data: "telefono" },
      { data: "tipo_docente" },
      {
        defaultContent:
          "<button  type='button' class='eliminar btn btn-default btn-sm'><em class='fa fa-close' title='eliminar'></em></button>" +
          "&nbsp<button type='button' class='editar btn btn-primary btn-sm'><em class='fa fa-edit' title='editar'></em></button>",
      },
    ],
    language: idioma_espanol,
    select: true,
  });
  document.getElementById("tabla_docente_filter").style.display = "none";
  $("input.global_filter").on("keyup click", function () {
    filterGlobal();
  });
  $("input.column_filter").on("keyup click", function () {
    filterColumn($(this).parents("tr").attr("data-column"));
  });
  $("#btn-place").html(table.buttons().container());
  table.column(0).visible(false);
}

function filterGlobal() {
  $("#tabla_docente").DataTable().search($("#global_filter").val()).draw();
}

function Registro_Docentes() {
  var idDocente = $("#id_docente").val();
  var nombreDocente = $("#txt_docnombre").val().toUpperCase();
  var apellidDocente = $("#txt_apedocente").val().toUpperCase();
  var dniDocente = $("#txt_dni_docente ").val();
  var emailDocente = $("#txt_email").val();
  var telfDocente = $("#txt_telefo").val();
  var codigDocente = $("#txt_codigo").val();
  var nivelDocente = $("#cbm_nivel").val();
  var tipoDocente = $("#cbm_tipo").val();
  var tipoDocumento = $("#tp_docu").val();
  var facebook = $("#txt_facebook").val();
  var ubigeo = $("#ubigeo").val();
  var image = $("#image")[0].files;

  if (
    nombreDocente.length == 0 ||
    apellidDocente.length == 0 ||
    dniDocente.length == 0 ||
    emailDocente.length == 0 ||
    telfDocente.length == 0 ||
    codigDocente.length == 0 ||
    nivelDocente.length == 0 ||
    tipoDocente.length == 0 ||
    ubigeo.length == 0
  ) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene los campos vacíos que son requeridos para Registrar/Actualizar Docente",
      "warning"
    );
  }

  $(".loader").show();
  $("#button_resgist").prop("disabled", true);

  const formData = new FormData();
  formData.append("idDocente", idDocente);
  formData.append("nombreDocente", nombreDocente);
  formData.append("apellidDocente", apellidDocente);
  formData.append("dniDocente", dniDocente);
  formData.append("emailDocente", emailDocente);
  formData.append("telfDocente", telfDocente);
  formData.append("codigDocente", codigDocente);
  formData.append("nivelDocente", nivelDocente);
  formData.append("tipoDocente", tipoDocente);
  formData.append("tipoDocumento", tipoDocumento);
  formData.append("ubigeo", ubigeo);
  formData.append("facebook", facebook);
  formData.append("image", image[0]);

  $.ajax({
    url:
      editando === false
        ? "../controlador/docente/controlador_registrar_docente.php"
        : "../controlador/docente/controlador_Actualizar_Docente.php",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
  }).done(function (Request) {
    var data = JSON.parse(Request);
    XMLHttpRequestAsycn(Request);
  });
}

function canselar_Registro() {
  $("#cont_dniem_error")
    .removeClass("form-group has-error")
    .addClass("form-group");
  $("#cont_codigo_error")
    .removeClass("form-group has-error")
    .addClass("form-group");
  $("#cbm_nivel").val("").trigger("change");
  editando = false;

  $("#id_docente").val("");
  $("#txt_nombre").val("");
  $("#txt_apellido").val("");
  $("#txt_dni ").val("");
  $("#txt_email").val("");
  $("#txt_telefo").val("");
  $("#txt_codigo").val("");
  $("#cbm_tipo").val("").trigger("change");
  $("#cbm_tipo").val("");

  $("#regiterEdit").html(" ");
  $("#div_tabla_docente").show();
  $("#div_docenteRegitrer").hide();

  $(".loader").hide();
  $("#button_resgist").prop("disabled", false);
}

function Abrir_Modal_Registro() {
  $("#div_tabla_docente").hide();
  Listar_Combo_nveles();
  $("#regiterEdit").html("Regitro");
  $("#div_docenteRegitrer").show();
}

async function Listar_Combo_nveles(generic = null) {
  var identi = "";
  var nameCombo = "--seleccione--";
  $.ajax({
    url: "../controlador/aula/controlador_combo_nivelesEdit.php",
    type: "POST",
  }).done(function (resp) {
    var data = JSON.parse(resp);
    var cadena = "";
    if (data.length > 0) {
      cadena += "<option value='" + identi + "'>" + nameCombo + "</option>";
      for (var i = 0; i < data.length; i++) {
        data[i][1] == generic
          ? (cadena +=
              "<option value='" +
              data[i][0] +
              "' selected>" +
              data[i][1] +
              "</option>")
          : (cadena +=
              "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>");
      }
      $("#cbm_nivel").html(cadena);
    } else {
      cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
      $("#cbm_nivel").html(cadena);
    }
  });
}

$("#tabla_docente").on("click", ".editar", function () {
  var data = table.row($(this).parents("tr")).data();
  if (table.row(this).child.isShown()) {
    var data = table.row(this).data();
    var idDocente = data.id_docente;
  }
  var idDocente = data.id_docente;

  editando = true;
  $("#div_tabla_docente").hide();
  $("#regiterEdit").html("Actualizar");
  $("#div_docenteRegitrer").show();
  Listar_Combo_nveles(data.nombreNivell);
  $("#cbm_tipo").val(data.tipo_docente).trigger("change");
  Datos_Show_Editar(idDocente);
});

function Datos_Show_Editar(idDocente) {
  $.ajax({
    url: "../controlador/docente/controlador_Datos_Edit.php",
    type: "POST",
    data: { idDocente: idDocente },
  }).done(function (resp) {
    var data = JSON.parse(resp);
    if (data.length > 0) {
      $("#id_docente").val(data[0]["id_docente"]);
      $("#txt_nombre").val(data[0]["nombres"]);
      $("#txt_apellido").val(data[0]["apellidos"]);
      $("#txt_dni ").val(data[0]["dni"]);
      $("#txt_email").val(data[0]["email"]);
      $("#txt_telefo").val(data[0]["telefono"]);
      $("#txt_codigo").val(data[0]["codigo"]);
    } else {
      return Swal.fire(
        "Mensaje De Advertencia",
        "No Hay datos o no tienes privilegios para realizar la operacion" +
          data,
        "warning"
      );
    }
  });
}

$("#tabla_docente").on("click", ".eliminar", function () {
  var data = table.row($(this).parents("tr")).data();
  if (table.row(this).child.isShown()) {
    var data = table.row(this).data();
    var idDocente = data.id_docente;
  }
  var idDocente = data.id_docente;

  Swal.fire({
    title: "Esta seguro de Eliminar(dar Baja)?",

    text:
      "Una vez hecho esto el docente " +
      data.nombres +
      " " +
      data.apellidos +
      "  No podra acseder al sistema ",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#05ccc4",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
  }).then((result) => {
    if (result.value) {
      Baja_Docente(idDocente);
    }
  });
});

function Baja_Docente(idDocente) {
  $.ajax({
    url: "../controlador/docente/controlador_Baja_Docente.php",
    type: "POST",
    data: { idDocente: idDocente },
  }).done(function (resp) {
    if (resp > 0) {
      table.ajax.reload();
      Swal.fire({
        icon: "success",
        title: "Acción Éxistoso !!",
        text: "Se dio de baja al docente  corectamente!!",
        showConfirmButton: false,
        timer: 1500,
      });
    } else {
      return Swal.fire(
        "Mensaje De new Error",
        "No Hay datos o no tienes privilegios para realizar la operacion" +
          data,
        "error"
      );
    }
  });
}

function XMLHttpRequestAsycn(Request) {
  if (Request > 0) {
    if (Request == 100) {
      $(".loader").hide();
      $("#button_resgist").prop("disabled", false);

      $("#cont_dniem_error")
        .removeClass("form-group")
        .addClass("form-group has-error");
      $("#cont_codigo_error")
        .removeClass("form-group")
        .addClass("form-group has-error");

      return Swal.fire(
        "Mensaje De Advertencia",
        "El Registro Similar(Igual) a esto ya  Existe los tres...Los 3 campos tienen que ser diferentes para distingir cada uno de ellos",
        "warning"
      );
    }
    if (Request == 1) {
      $(".loader").hide();
      $("#button_resgist").prop("disabled", false);
      canselar_Registro();
      table.ajax.reload();
      Swal.fire({
        icon: "success",
        title: "Registro Éxistoso !!",
        text: "Los datos del Docente se registraron corectamente!!",
        showConfirmButton: false,
        timer: 1500,
      });
    }
    if (Request == 404) {
      $(".loader").hide();
      $("#button_resgist").prop("disabled", false);

      window.location = "NotFound";
    }
    if (Request == 401) {
      window.location = "NotFound";
    }
  } else {
    $(".loader").hide();
    $("#button_resgist").prop("disabled", false);
    return Swal.fire(
      "Mensaje De Error",
      "No se registro Registro Fallido!!" + Request + "",
      "error"
    );
  }
}
