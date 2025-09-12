async function cargarSucursal(){
  let codSucursal = document.getElementById("codSucursal")

  const res = await fetch("../controlador/sucursal/controlador_listar_sucursal.php")
  const json = await res.json()
  console.log(json)
  console.log(codSucursal)

  codSucursal.innerHTML = ``
  json.forEach(item => {
    console.log(item)
    codSucursal.innerHTML += `
      <option value="${item.id_sucursal}">${item.direccion}</option>
    `
  });
}


function registrar() {
  var montoInicial = $("#montoInicial").val();
  var apertura = $("#apertura").val();
  var cierre = $("#cierre").val();
  var montoFinal = $("#montoFinal").val();
  var montoReferencial = $("#montoReferencial").val();
  var codSucursal = $("#codSucursal").val()
  var usuario = $("#usuario").val()

  console.log(montoInicial, apertura, cierre, montoFinal, montoReferencial, codSucursal, usuario  )
  console.log("Monoto inicial", montoInicial.length)
  console.log("Apertura", apertura.length)  
  console.log("Cierre", cierre.length)
    console.log("Monto final", montoFinal.length)
    console.log("Monto referencial", montoReferencial.length)
    console.log("Codigo sucursal", codSucursal.length)
    console.log("Usuario", usuario.length)
  
  if (
    montoInicial.length == 0 ||
    apertura.length == 0 ||
    cierre.length == 0 ||
    montoFinal.length == 0 ||
    montoReferencial.length == 0||
    codSucursal.length == 0||
    usuario.length == 0
  ) {
    return Swal.fire(
      "Mensaje de Advertencia",
      "Llene espacio vacios",
      "warning"
    );
  }

  $.ajax({
    url:
     "../controlador/caja/controlador_registrar_caja.php",
    type: "POST",
    data: {
      montoInicial, 
      apertura, 
      cierre, 
      montoFinal, 
      montoReferencial, 
      codSucursal, 
      usuario,
    
    },
  }).done(function (Request) {
    XMLHttpRequestAsycn(Request);
  });
}

function limpiar() {
  $("#montoInicial").val("");
  $("#apertura").val("");
  $("#cierre").val("");
  $("#montoFinal").val("");
  $("#montoReferencial").val("");
  $("#codSucursal").val("")
  $("#usuario").val("")
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
      url: "../controlador/caja/controlador_listar_caja.php",
      type: "POST",
      dataSrc: "",
    },
    columns: [
      {
        data: "id_caja",
      },
      {
        data: "montoinicial",
      },
      {
        data: "apertura",
      },
      {
        data: "cierre",
      },
      {
        data: "monto_final",
      },
      {
        data: "monto_referencial",
      },
      {
        data: "abierto",
        render: function (data, type, row) {
          return data === "1"
            ? "<span class='label label-success'>ABIERTO</span>"
            : "<span class='label label-warning'>CERRADO</span>";
        },
      },
      {
        defaultContent:
          "<button type='button' class='editar btn btn-primary btn-sm'><em class='fa fa-edit' title='editar'></em></button>",
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
    var idedit = data.id_caja;
  }
  var idedit = data.id_caja;
  var abierto = data.abierto

  actualizarCaja(idedit, abierto);

  return false
});

async function actualizarCaja(id, abierto) {
  try {
      const response = await fetch("../controlador/caja/controlador_actualizar_caja.php", {
          method: "POST",
          headers: {
              "Content-Type": "application/x-www-form-urlencoded",
          },
          body: new URLSearchParams({
              id,
              abierto,
          }),
      });

      const data = await response.text();
      XMLHttpRequestAsycn(data);
  } catch (error) {
      console.error("Error en la solicitud:", error);
  }
}



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


cargarSucursal()