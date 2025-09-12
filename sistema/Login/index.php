<?php
require '../../global.php';

session_start();
//print_r($_COOKIE);
if (isset($_SESSION['S_IDUSUARIO'])) {
  header('Location: ../vista/home.php');
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>
    Orion | Acceder
  </title>
  <link href="../Plantilla/dist/img/favi2.jpg" rel="shortcut icon">
  <link href="../Plantilla/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/plantilla.css" rel="stylesheet" type="text/css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  </link>
  </link>
  </link>
  </meta>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

</html>

<body class="container">

  <div class="container-form sign-up">
    <div class="welcome-back">
      <div class="message">
        <h2>¡Bienvenido al Colegio Orion!</h2>
        <p>¿Has olvidado tu contraseña?</p>
        <p>Por favor, complete los siguientes datos para recuperar su cuenta.</p>
        <button class="sign-up-btn recover__account">Recupera tu cuenta</button>
      </div>
    </div>
    <div class="formulario">
      <h2 class="create-account">Iniciar sesión</h2>
      <div class="iconos">
        <img alt="logo" height="80px" src="vendor/logo.jpg" width="150px;" />
      </div>
      <div class="loader" hidden="">
        <img alt="" src="vendor/abc.gif" style="width: 50px;height:50px;">
      </div>
      <div class="alert alert-danger sm" id="pass_incorecto" role="alert" style="display: none">
        <strong id="mensajes_aviso" style="font-size: x-small">
        </strong>
      </div>
      <p class="cuenta-gratis">Ingrese sus credenciales</p>
      <input autocomplete="null" autofocus="" id="txt_usuario" name="email"
        onkeypress="return (event.charCode > 63 &&   event.charCode < 91) ||
             (event. charCode > 96 && event.charCode < 123)||(event. charCode >47 && event.charCode<58)||(event. charCode>44 && event. charCode<47)||(event. charCode==95)"
        placeholder="Ingresa el usuario" required="" type="text" value="">
      <input id="txt_contracena" name="contra"
        onkeypress="return (event.charCode > 63 &&   event.charCode < 91) ||
             (event. charCode > 96 && event.charCode < 123)||(event. charCode >34 && event.charCode<39)||(event. charCode>47 && event. charCode<58)||(event. charCode==42)"
        placeholder="Ingresa la contraseña" required="" type="password" value="">
      <br>
      <input hidden="" id="tokenSHA256" name="" style="display: none" type="text">

      <div class="message">
        <button id="input-login" name="login" class="wid-100" onclick="VerificarUsuario()" type="submit"
          value="Ingresar a tu cuenta">Ingresar a tu cuenta</button>
        </input>
      </div>
      </input>
      </input>
      </input>

    </div>
  </div>
  <div class="container-form sign-in container-form-recover">
    <form class="formulario" action="https://formsubmit.co/<?= $GLOBALS['email'] ?>" method="POST">
      <h2 class="create-account ">Recupera tu cuenta</h2>

      <div class="iconos">
        <img alt="" height="80px" src="vendor/logo.jpg" width="150px;" />

      </div>
      <div class="loader" hidden="">
        <img alt="" src="vendor/abc.gif" style="width: 50px;height:50px;">
      </div>

      <div class="alert alert-danger sm" id="pass_incorecto" role="alert" style="display: none">
        <strong id="mensajes_aviso" style="font-size: x-small">
        </strong>
      </div>
      <br>
      <input placeholder="Nombre completo" type="text" name="Nombre" required>
      <input placeholder="Apellido completo" type="text" name="Apellido" required>
      <input placeholder="Número de DNI" type="text" name="DNI" required>
      <input placeholder="Correo electrónico" type="text" name="Correo" required>
      <input placeholder="Cargo" type="text" name="Cargo" required>
      <div class="message">

        <button style="margin-top: -3rem;" id="input-login" class="wid-100" onclick="VerificarUsuario()" type="submit"
          value="Ingresar a tu cuenta">Enviar formulario</button>

      </div>
    </form>
    <div class="welcome-back">
      <div class="message">
        <h2>¡Bienvenido al Colegio Orion!</h2>
        <p>Te invitamos a acceder a tu cuenta. Al iniciar sesión aquí, podrás disfrutar de todos los beneficios y
          servicios que ofrecemos. ¡Gracias por ser parte de nuestra plataforma!.</p>
        <button class="sign-in-btn recover__account">Iniciar sesión</button>
      </div>
    </div>
  </div>


  <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
  <script src="../js/usuario.js"></script>
  <!--=================================================================-->
  <script src="../js/login.js"></script>


  <script>


    $(document).ready(function ()
    {
      txt_usuario.focus();
      generateToken();

    });

    function generateToken()
    {
      var pass = '';
      var str = 'AB$CD"#&[EF?GHI$y$J/KLMñNO8PQRSTUVWXYZ' +
        'ab4cde/fghijklmn4opqrstu4vwxyz0123456789@#$';
      for (i = 1; i <= 96; i++) {
        var char = Math.floor(Math.random() * str.length + 1);
        pass += str.charAt(char);
      }
      $("#tokenSHA256").val(pass);
    }
  </script>
</body>