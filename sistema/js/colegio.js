function RegistrarDatosInstitucion() {
  var f = new Date();
  var idcolegio = $("#id_colegio").val();
  var colegioNombre = $("#txt_nombre").val().toUpperCase();
  var colegioUbic = $("#txt_ubicacion").val().toUpperCase();
  var colegioEmail = $("#txt_email").val();
  var ColegioTelefono = $("#txt_telefono").val();
  var ugel = $("#txt_ugel").val().toUpperCase();

  if (idcolegio > 0) {
    var NamelogoImg = $("#fotoActual_logo").val();
    var NamepaisImg = $("#fotoActual_pais").val();
    var NamebannImg = $("#fotoActual_baner").val();
  } else {
    var NamelogoImg =
      "LOGOIMG" +
      f.getDate() +
      "" +
      (f.getMonth() + 1) +
      "" +
      f.getFullYear() +
      "" +
      f.getHours() +
      "" +
      f.getMinutes() +
      "" +
      f.getSeconds() +
      "." +
      "jpg";
    var NamepaisImg =
      "PAISIMG" +
      f.getDate() +
      "" +
      (f.getMonth() + 1) +
      "" +
      f.getFullYear() +
      "" +
      f.getHours() +
      "" +
      f.getMinutes() +
      "" +
      f.getSeconds() +
      "." +
      "jpg";
    var NamebannImg =
      "BANNIMG" +
      f.getDate() +
      "" +
      (f.getMonth() + 1) +
      "" +
      f.getFullYear() +
      "" +
      f.getHours() +
      "" +
      f.getMinutes() +
      "" +
      f.getSeconds() +
      "." +
      "jpg";
  }

  var logoImg = $("#logo_seleccionararchivo")[0].files[0];
  var paisImg = $("#pais_seleccionararchivo")[0].files[0];
  var bannerImg = $("#banner_seleccionararchivo")[0].files[0];

  if (
    colegioNombre.length == 0 ||
    colegioUbic.length == 0 ||
    colegioEmail.length == 0 ||
    ugel.length == 0
  ) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llena campos básicos de la Institución !! ",
      "warning"
    );
  }

  if (logoImg?.length == 0 || paisImg?.length == 0 || bannerImg?.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "los imsgenes son requieridos para los reportes !! ",
      "warning"
    );
  }

  var formData = new FormData();
  formData.append("idcolegio", idcolegio);

  formData.append("logoImg", logoImg);
  formData.append("NamelogoImg", NamelogoImg);

  formData.append("paisImg", paisImg);
  formData.append("NamepaisImg", NamepaisImg);

  formData.append("bannerImg", bannerImg);
  formData.append("NamebannImg", NamebannImg);

  formData.append("colegioNombre", colegioNombre);
  formData.append("colegioUbic", colegioUbic);
  formData.append("colegioEmail", colegioEmail);
  formData.append("ColegioTelefono", ColegioTelefono);
  formData.append("ugel", ugel);

  $.ajax({
    url: "../controlador/colegio/controlador_registrar_colegio.php",
    type: "post",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      if (response > 0) {
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Registro Éxistoso !!",
          text: "Los datos del colegio se registraron corectamente!!",
          showConfirmButton: false,
          timer: 1500,
        });
      } else {
        Swal.fire({
          title: "Error!",
          text: "Ocurrior un error en el Servidor" + response,
          icon: "error",
          confirmButtonText: "Cool",
        });
        return;
      }
    },
  });
}

function MostrarDatosActualesCole() {
  $.ajax({
    url: "../controlador/colegio/controlador_Datos_Actuales.php",
    type: "POST",
  }).done(function (resp) {
    var data = JSON.parse(resp);
    if (data.length > 0) {
      $("#id_colegio").val(data[0][0]);
      $("#txt_nombre").val(data[0][1]);
      $("#txt_telefono").val(data[0][2]);
      $("#txt_email").val(data[0][3]);
      $("#txt_ubicacion").val(data[0][4]);
      //GUI
      $("#logo_mostrarimagen").attr("src", "../imagenes/" + data[0][5]);
      $("#pais_mostrarimagen").attr("src", "../imagenes/" + data[0][6]);
      $("#baner_mostrarimagen").attr("src", "../imagenes/" + data[0][7]);
      //EDIT
      $("#fotoActual_logo").val(data[0][5]);
      $("#fotoActual_pais").val(data[0][6]);
      $("#fotoActual_baner").val(data[0][7]);

      $("#txt_ugel").val(data[0][8]);
    } else {
    }
  });
}
