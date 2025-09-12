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

var table_select;

function listarProductos() {
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
      url: "../controlador/productoServicio/controlador_listar_producto.php", // GET
      type: "POST",
      dataSrc: "",
    },
    columns: [
      {
        data: "idproducto_servicio",
      },
      {
        data: "descripcion",
      },
      {
        data: "modelo",
      },
      {
        data: "unidad",
      },
      {
        data: "moneda",
      },
      {
        data: "precio_base_unitario",
      },
      {
        data: "igv_unitario",
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

var editando = false;
function cancelarProducto() {
  editando = false;

  $("#descripcion").val("");

  const $modal = document.getElementById("modal-product");
  $modal.classList.toggle("modal-product-active");
}

function registrar() {
  var id = $("#id").val();

  var descripcion = $("#descripcion").val();
  var detalle = $("#detalle").val();
  var modelo = $("#modelo").val();
  var unidad = $("#unidad").val();
  var moneda = $("#moneda").val();
  var stockInicial = $("#stockInicial").val();
  var stockMinimo = $("#stockMinimo").val();
  var tipoFacturacion = $("#tipoFacturacion").val(); // Falta
  var fechaVencimiento = $("#fechaVencimiento").val();
  var precioBaseUnitario = $("#precioBaseUnitario").val();
  var identificado = $("#identificado").val(); // Falta
  var igvUnitario = $("#igvUnitario").val(); // Falta
  var precioFinal = $("#precioFinal").val();
  var marcaId = $("#marcaId").val();
  var categoriaProductoId = $("#categoriaProductoId").val();

  if (
    descripcion.length == 0 ||
    detalle.length == 0 ||
    modelo.length == 0 ||
    unidad.length == 0 ||
    moneda.length == 0 ||
    stockInicial.length == 0 ||
    stockMinimo.length == 0 ||
    tipoFacturacion.length == 0 ||
    fechaVencimiento.length == 0 ||
    precioBaseUnitario.length == 0 ||
    identificado.length == 0 ||
    igvUnitario.length == 0 ||
    precioFinal.length == 0 ||
    marcaId.length == 0 ||
    categoriaProductoId.length == 0
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
        ? "../controlador/productoServicio/controlador_registrar_producto.php"
        : "../controlador/productoServicio/controlador_actualizar_producto.php",
    type: "POST",
    data: {
      id: id,
      descripcion: descripcion,
      detalle: detalle,
      modelo: modelo,
      unidad: unidad,
      moneda: moneda,
      stockInicial: stockInicial,
      stockMinimo: stockMinimo,
      tipoFacturacion: tipoFacturacion,
      fechaVencimiento: fechaVencimiento,
      precioBaseUnitario: precioBaseUnitario,
      identificado: identificado,
      igvUnitario: igvUnitario,
      precioFinal: precioFinal,
      marcaId: marcaId,
      categoriaProductoId: categoriaProductoId,
    },
  }).done(function (Request) {
    XMLHttpRequestAsycn(Request);
  });

  const $modal = document.getElementById("modal-product");
  $modal.classList.toggle("modal-product-active");
}

$("#tabla_data").on("click", ".eliminar", function () {
  var data = table_select.row($(this).parents("tr")).data();

  if (table_select.row(this).child.isShown()) {
    var data = table_select.row(this).data();
    var id = data.idproducto_servicio;
  }
  var id = data.idproducto_servicio;
  $.ajax({
    url: "../controlador/productoServicio/controlador_eliminar_producto.php", // DELETE
    type: "POST",
    data: {
      id: id,
    },
  }).done(function (resp) {
    XMLHttpRequestAsycn(resp);
  });
});

$("#tabla_data").on("click", ".editar", function () {
  const $modal = document.getElementById("modal-product");
  $modal.classList.toggle("modal-product-active");

  editando = true;

  var data = table_select.row($(this).parents("tr")).data();
  if (table_select.row(this).child.isShown()) {
    var data = table_select.row(this).data();
    var idedit = data.idproducto_servicio;
  }
  var idedit = data.idproducto_servicio;
  console.log(idedit);
  editando = true;

  const dataOnePromise = obtenerProducto(idedit);
  dataOnePromise.then((info) => {
    $("#id").val();
    $("#descripcion").val();
    $("#detalle").val();
    $("#modelo").val();
    $("#unidad").val();
    $("#moneda").val();
    $("#stockInicial").val();
    $("#stockMinimo").val();
    $("#tipoFacturacion").val();
    $("#fechaVencimiento").val();
    $("#precioBaseUnitario").val();
    $("#identificado").val();
    $("#igvUnitario").val();
    $("#precioFinal").val();
    $("#marcaId").val();
    $("#categoriaProductoId").val();
  });
});

async function obtenerProducto(id) {
  const res = await fetch(
    `../controlador/productoServicio/controlador_lista_producto.php?id=${id}`
  );
  const json = await res.json();
  return json;
}
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


obtenerMarca();
obtenerCategoria();
listarProductos();
