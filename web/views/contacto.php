<?php
	require_once '../../global.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Enlace a Bootstrap JS y Popper.js (necesario para algunos componentes de Bootstrap) -->

  <link rel="stylesheet" href="../css/lib/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/query.css">
  <link rel="stylesheet" href="../css/galeria.css">
  <link rel="stylesheet" href="../css/contact.css">
  <link rel="stylesheet" href="../css/globals.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@1,900&family=Ysabeau+Office&display=swap"
    rel="stylesheet">
  <!-- Enlace a Font Awesome CSS -->
  <link rel="shortcut icon" href="../img/LOGO.png" type="image/x-icon">
  <title>Colegio Orion - Contacto</title>
</head>

<body>

  <?php 
  require_once './components/navigation.php';
  ?>

  <!-- Contenido principal -->
  <div class="main-content">
    <div class="banner-contacto d-flex justify-content-center align-items-center">
      <div class="dark-container content text-center text-white">
        <h3 class="text-center">Pónganse en contacto con nosotros <br> para cualquier consulta</h3>
        <p>Contáctanos</p>
      </div>
    </div>

    <!-- Contact Start -->
    <div class="container-fluid pt-3 my-3">
      <div class="container">
        <div class="text-center pb-2 mb-4">
          <p class="section-title px-5">
            <span class="px-2 " style="font-weight: bold;">PONTE EN CONTACTO</span>
          </p>
        </div>

        <div class="row container__contact d-flex justify-content-between">
          <div class="col-lg-6 mb-5">
            <div class="contact-form">
              <div id="success"></div>
              <form class="form" action="https://formsubmit.co/colegiooriontarma@gmail.com" method="POST" onsubmit="limpiarFormulario()">
                <div class="img-flotante">
                  <img src="../img/formulario-de-contacto-removebg-preview.png" alt="">
                </div>
                <div class="flex ">
                  <label>
                    <span>Nombres</span>
                    <input required="" placeholder="" type="text" class="input" name="Nombre">
                  </label>
                  <label>
                    <span>Apellidos</span>
                    <input required="" placeholder="" type="text" class="input" name="Apellido">
                  </label>
                </div>

                <label>
                  <span>Correo electrónico</span>
                  <input required="" placeholder="" type="email" class="input" name="Correo electrónico">
                </label>

                <label>
                  <span>Número de teléfono</span>
                  <input required="" type="tel" placeholder="" maxlength="9" pattern="[0-9]{9}" class="input" name="Número de teléfono">
                </label>
                <label>
                  <span>Mensaje</span>
                  <textarea required="" rows="3" placeholder="" class="input01" name="Mensaje"></textarea>
                </label>
                <input type="hidden" name="_captcha" value="false">
                <input type="hidden" name="_subject" value="Solicita vacante - Plataforma Orion">
                <input type="hidden" name="_template" value="table">
                <button class="fancy" href="#" type="submit">
                  Enviar
                </button>
              </form>
            </div>
          </div>
          <script>
          function limpiarFormulario() {
            // Espera 50 milisegundos antes de limpiar el formulario
            setTimeout(function() {
              document.querySelector(".form").reset();
            }, 50);
            }
          </script>

          <div class="col-lg-5 mb-5">
            <p style="text-align:justify;">
              La comunicación es clave. Si tienes preguntas, deseas conocer más sobre nuestros servicios o deseas
              explorar posibilidades de colaboración, estamos a un mensaje de distancia. ¡Escríbenos hoy y reversa una
              vacante!
            </p>
            <div class="d-flex mt-5">
              <i class="icon-contacto fa fa-map-marker-alt d-inline-flex align-items-center justify-content-center   rounded-circle"
                style="width: 45px; height: 45px"></i>
              <div class="pl-3">
                <h5>Ubicanos</h5>
                <p>Jr. los maizales N° 153</p>
              </div>
            </div>
            <div class="d-flex">
              <i class="icon-contacto fa fa-envelope d-inline-flex align-items-center justify-content-center   rounded-circle"
                style="width: 45px; height: 45px"></i>
              <div class="pl-3">
                <h5>Escribenos</h5>
                <p>colegiooriontarma@gmail.com</p>
              </div>
            </div>
            <div class="d-flex">
              <i class="icon-contacto fa fa-phone-alt d-inline-flex align-items-center justify-content-center   rounded-circle"
                style="width: 45px; height: 45px"></i>
              <div class="pl-3">
                <h5>Llamanos</h5>
                <p>954016787</p>
              </div>
            </div>
            <div class="d-flex">
              <i class="icon-contacto far fa-clock d-inline-flex align-items-center justify-content-center  rounded-circle"
                style="width: 45px; height: 45px"></i>
              <div class="pl-3">
                <h5>Horario de atencion</h5>
                <strong>Lunes - Viernes:</strong>
                <p class="m-0">08:00 AM - 06:30 PM</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Contact End -->
  </div>

  <?php
require_once './components/footer.php'
?>

  <!-- Enlace a Bootstrap JS y Popper.js (necesario para algunos componentes de Bootstrap) -->

  <script src="../js/bootstrap.min.js"></script>
  <!-- Enlaces js eventos -->
  <script src="../js/main.js"></script>
  <script>
  document.addEventListener("click", (e) => {
    console.log(e.target)
  })
  console.log("Holfdasdf")
  </script>
  <!-- Enlaces Externos  -->


</body>

</html>