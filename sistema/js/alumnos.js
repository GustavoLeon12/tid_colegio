function AbrirModalMatricula() {
  $("#DivTableAlumno").hide();
  $("#DivMatricula").show();
}

//DATOS ALUMNO
var editando = false;
function registrar_Alunos() {
  var idalumnoedit = $("#id_alumnoEdit").val();
  var apellp = $("#txt_apellidos").val();
  var nomb = $("#txt_alunombre").val();
  var fechaN = $("#txt_fech").val();
  var dni = $("#txt_dni_alumno").val();
  var telf = $("#txt_tel").val();
  var direccion = $("#direccion").val();
  var codi = $("#txt_codig").val();
  var sex = $("#cbm_sexo").val();
  var tp_docu = $("#tp_docu").val();
  var ubigeo = $("#ubigeo").val();
  var image  = $("#image")[0].files;

  //DATOS PADRES
  var nom_pade = $("#txt_nomb_padre ").val();
  var apell_pade = $("#txt_apelli_padre").val();
  var dni_pade = $("#txt_dni_padre ").val();
  var nom_madre = $("#txt_nombre_madre ").val();
  var apell_madre = $("#txt_tapel_madre ").val();
  var dni_madre = $("#txt_dni_madre ").val();
  var tp_docu_padre = $("#tp_docu_padre").val();
  var tp_docu_madre = $("#tp_docu_madre").val();
  var ubigeo_madre = $("#ubigeo_madre").val();
  var ubigeo_padre = $("#ubigeo_padre").val();

  //DATOS ESCOLARES

  var nom_cole = $("#tex_coleg_nombre ").val();
  var nom_direc = $("#tex_coleg_direcion ").val();
  var cole_codig = $("#tex_codig_cole ").val();
  if (
    apellp.length == 0 ||
    nomb.length == 0 ||
    fechaN.length == 0 ||
    telf.length == 0 ||
    codi.length == 0 ||
    direccion.length == 0 ||
    dni.length == 0
  ) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llena campos básicos del alumno!! ",
      "warning"
    );
  }
  $(".loader").show(); ////prende
  $("#button_resgist").prop("disabled", true);

  const formData = new FormData();
  formData.append("idalumnoedit", idalumnoedit)
  formData.append("apellp", apellp)
  formData.append("nomb", nomb)
  formData.append("fechaN", fechaN)
  formData.append("dni", dni)
  formData.append("telf", telf)
  formData.append("codi", codi)
  formData.append("sex", sex)
  formData.append("direccion", direccion)
  formData.append("nom_pade", nom_pade)
  formData.append("apell_pade", apell_pade)
  formData.append("dni_pade", dni_pade)
  formData.append("nom_madre", nom_madre)
  formData.append("apell_madre", apell_madre)
  formData.append("dni_madre", dni_madre)
  formData.append("nom_cole", nom_cole)
  formData.append("nom_direc", nom_direc)
  formData.append("cole_codig", cole_codig)
  formData.append("tp_docu", tp_docu)
  formData.append("tp_docu_padre", tp_docu_padre)
  formData.append("tp_docu_madre", tp_docu_madre)
  formData.append("ubigeo", ubigeo)
  formData.append("ubigeo_madre", ubigeo_madre)
  formData.append("ubigeo_padre", ubigeo_padre)
  formData.append("image",image[0])
  
  $.ajax({
    url:
      editando === false
        ? "../controlador/alumno/controlador_registrar_Alumno.php"
        : "../controlador/alumno/controlador_Actualizar_Alumno.php",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
  }).done(function (Request) {
    XMLHttpRequestAsycn(Request);
  });
}

var table_matricula;
function listar_alumnos() {
  table_matricula = $("#tabla_matricula").DataTable({
    ordering: true,
    bLengthChange: false,
    searching: {
      regex: false,
    },

    responsive: true,
    dom: "Bfrtilp",
    buttons: [
      {
        extend: "copy",
        text: '<i class="fa  fa-copy"></i> ',
        title: "REGISTRO DE ALUMNOS REGISTRADOS ",
        titleAttr: "Exportar a copy",
      },
      {
        extend: "excelHtml5",
        text: '<i class="fa fa-file-excel-o"></i> ',
        title: "REGISTRO DE ALUMNOS REGISTRADOS ",
        titleAttr: "Exportar a Excel",
      },
      {
        extend: "pdfHtml5",
        text: '<i class="fa fa-file-pdf-o"></i> ',
        title: "REGISTRO DE ALUMNOS REGISTRADOS ",
        titleAttr: "Exportar a PDF",
      },
      {
        extend: "print",
        text: '<i class="fa fa-print"></i> ',
        title: "REGISTRO DE ALUMNOS REGISTRADOS ",
        titleAttr: "Imprimir",
      },
    ],
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    pageLength: 10,
    destroy: true,
    async: false,
    processing: true,
    ajax: {
      url: "../controlador/alumno/controlador_alumnos_listar.php",
      type: "POST",
    },

    columns: [
      {
        data: "idalumno",
      },
      { data: "apellidos" },
      { data: "alumnonombre" },
      { data: "dni" },
      { data: "telefono" },
      { data: "codigo" },
      {
        data: "sexo",
        render: function (data, type, row) {
          return data == "M"
            ? "<em class='fa fa-male'></em>"
            : "<em class='fa fa-female'></em>";
        },
      },
      {
        data: "stadoalumno",
        render: function (data, type, row) {
          return data == "ACTIVO"
            ? "<span class='label label-success'>" + data + "</span>"
            : "<span class='label label-warning'>" + data + "</span>";
        },
      },
      {
        defaultContent:
          "<button  type='button' class='editar btn btn-primary btn-sm' title='Editar'><i class='fa fa-edit'></i></button>&nbsp;<button  type='button' class='eliminar btn btn-default btn-sm' title='eliminar'><em class='fa fa-trash'></em></button>",
      },
    ],
    language: idioma_espanol,
    select: true,
  });
  document.getElementById("tabla_matricula_filter").style.display = "none";
  $("input.global_filter").on("keyup click", function () {
    filterGlobal();
  });
  $("input.column_filter").on("keyup click", function () {
    filterColumn($(this).parents("tr").attr("data-column"));
  });
  table_matricula.column(0).visible(false);
  $("#btn-place").html(table_matricula.buttons().container());
}

function filterGlobal() {
  $("#tabla_matricula").DataTable().search($("#global_filter").val()).draw();
}

function LimpiarModalMatricula() {
  $("#id_alumnoEdit").val("");
  $("#txt_apellidos").val("");
  $("#txt_alunombre").val("");
  $("#txt_fech").val("");
  $("#txt_dni").val("");
  $("#txt_tel").val("");
  $("#txt_codig").val("");
  $("#cbm_sexo").val("");
  $("#txtfecharegistro").val("");
  $("#direccion").val("");
  //DATOS PADRES
  $("#txt_nomb_padre ").val("");
  $("#txt_apelli_padre").val("");
  $("#txt_dni_padre ").val("");
  $("#txt_nombre_madre ").val("");
  $("#txt_tapel_madre ").val("");
  $("#txt_dni_madre ").val("");
  //DATOS ESCOLARES

  $("#tex_coleg_nombre").val("");
  $("#tex_coleg_direcion").val("");
  $("#tex_codig_cole").val("");
  editando = false;
  $(".loader").hide();
  $("#button_resgist").prop("disabled", false);
  $("#DivTableAlumno").show();
  $("#DivMatricula").hide();
}

$("#tabla_matricula").on("click", ".editar", function () {
  editando = true;
  var data = table_matricula.row($(this).parents("tr")).data();
  if (table_matricula.row(this).child.isShown()) {
    var data = table_matricula.row(this).data();
    var idalumno = data.idalumno;
  }
  var idalumno = data.idalumno;
  $.ajax({
    url: "../controlador/alumno/controlador_extraer_alumno.php",
    type: "POST",
    data: { idalumno: idalumno },
  }).done(function (resp) {
    var data = JSON.parse(resp);
    if (data.length > 0) {
      $("#DivTableAlumno").hide();
      $("#DivMatricula").show();

      Mostrar_Datos_Alumnos(data);
    } else {
      window.location = "NotFound";
    }
  });
});

$("#tabla_matricula").on("click", ".eliminar", function () {
  var data = table_matricula.row($(this).parents("tr")).data();
  if (table_matricula.row(this).child.isShown()) {
    var data = table_matricula.row(this).data();
    var id = data.idalumno;
  }
  var id = data.idalumno;
  Swal.fire({
    title: "Esta seguro de Eliminar al Alumno?",
    text: "Una vez hecho esto el alumno No  tendra acceso al sistema",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
  }).then((result) => {
    if (result.value) {
      Dar_DeBaja_Alumno(id);
    }
  });
});

function Dar_DeBaja_Alumno(id) {
  $.ajax({
    url: "../controlador/alumno/controlador_darDaja_aulumno.php",
    type: "POST",
    data: {
      id: id,
    },
  }).done(function (resp) {
    if (resp > 0) {
      Swal.fire(
        "Mensaje De Confirmacion",
        "La operación se realizo con Éxito!!",
        "success"
      ).then((value) => {
        table_matricula.ajax.reload();
      });
    } else {
      Swal.fire(
        "Mensaje De Error",
        "La operación no se pudo Completar",
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
      return Swal.fire(
        "Mensaje De Advertencia",
        "El Registro Similar(Igual) a esto ya  Existe",
        "warning"
      );
    }
    if (Request == 1) {
      $(".loader").hide();
      $("#button_resgist").prop("disabled", false);
      LimpiarModalMatricula();
      $("#DivMatricula").hide();
      $("#DivTableAlumno").show();

      table_matricula.ajax.reload();

      Swal.fire({
        icon: "success",
        title: "Éxito !!",
        text: "El Registro, se registro  de forma Éxitoso!! ",
        showConfirmButton: false,
        timer: 1700,
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

function Mostrar_Datos_Alumnos(data) {
  print(data)
  $("#id_alumnoEdit").val(data[0]["idalumno"]);
  $("#txt_apellidos").val(data[0]["apellidos"]);
  $("#txt_alunombre").val(data[0]["alumnonombre"]);
  $("#txt_dni").val(data[0]["dni"]);
  $("#txt_tel").val(data[0]["telefono"]);
  $("#txt_codig").val(data[0]["codigo"]);
  $("#cbm_sexo").val(data[0]["sexo"]).trigger("change");
  $("#txt_fech").val(data[0]["fnacimiento"]);
  $("#direccion").val(data[0]["direccion"]);
  //DATOS PADRES
  $("#txt_nomb_padre ").val(data[0]["paderNombre"]);
  $("#txt_apelli_padre").val(data[0]["PadreApellidos"]);
  $("#txt_dni_padre ").val(data[0]["padreDni"]);
  $("#txt_nombre_madre ").val(data[0]["madreNombres"]);
  $("#txt_tapel_madre ").val(data[0]["madreApellidos"]);
  $("#txt_dni_madre ").val(data[0]["madreDni"]);
  //DATOS ESCOLARES

  $("#tex_coleg_nombre ").val(data[0]["cole_procedente"]);
  $("#tex_coleg_direcion ").val(data[0]["coleUbicacion"]);
  $("#tex_codig_cole ").val(data[0]["coleCodigo"]);
}
