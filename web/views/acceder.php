<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/lib/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/query.css">
  <link rel="stylesheet" href="../css/noticias.css">
  <link rel="stylesheet" href="../css/globals.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


  <!--Animacones libreriasc -->
  <script src="../js/animaciones.js"></script>
  <link rel="shortcut icon" href="../img/LOGO.png" type="image/x-icon">
  <title>Colegio Orion - Inicio</title>
  <style>
    .modal__login {
      background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
      url('../img/DSC00502.jpg') center/cover no-repeat;
      width: 100%;
      height: 100vh;
      position: fixed;
      left: 0;
      top: 0;
      z-index: 5000;
      overflow: auto;
      display: grid;
      place-items: center;
    }

    .modal__login__center {
      width: 100%;
      max-width: 450px;
      border-radius: 0.5rem;
      padding: 3rem 2rem;
      background-color: white;
      display: grid;
      place-items: center;
      position: relative;
      border-radius: 0.5rem;
    }

    .modal__login__center h4 {
      text-align: center;
      width: 100%;
      margin-top: 2rem;
      font-size: 1.2rem
    }

    .modal__login__center p {
      margin-bottom: 0.5rem;
      font-size: 0.8rem
    }

    .modal__login__center div {
      width: 100%;
      margin-top: 1rem
    }

    .input__password a {
      font: normal normal 400 0.8rem/1rem var(--font-primary);
      display: block;
      text-align: right;
      margin-top: 0.5rem;
      color: #06426a;
    }

    .modal__login__center input {
      width: 100%;
      padding: 0.5rem 1rem;
      border-radius: 0.5rem;
      font: normal normal 400 0.8rem/1rem var(--font-primary);
    }

    .modal__login__center label {
      font: normal normal 700 0.7rem/1rem var(--font-primary);
      text-transform: uppercase;
      letter-spacing: 0.03rem;
    }

    .button__login,
    .button__back {
      margin-top: 3rem;
      padding: 0.5rem 2rem;
      font: normal normal 700 0.8rem/1.5rem var(--font-primary);
      background-color: #06426a;
      transition: 0.3s;
      border-radius: 0.5rem;
      color: white;
      border: none;
      width: 100%
    }

    .button__login:hover,
    .button__login:focus,
    .button__back:hover,
    .button__back:focus {
      filter: brightness(0.8);
    }

    .button__back {
      background-color: transparent;
      color: #06426a;
      text-decoration: none;
      border: 1px solid #06426a;
      display: block;
      width: 100%;
      text-align: center;
      margin-top: 1rem;
    }

    .modal__login__center img {
      width: 8rem;
      height: auto;
      object-fit: cover;
    }

    .input__password {
      position: relative;
    }

    .message__error {
      display: block;
      width: 100%;
      margin-top: 0.5rem;
      font: normal italic 700 0.8rem/1.5rem var(--font-primary);
      color: #ff6a6a;
    }

    .lds-ring {
      display: none;
      place-items: center;
      position: relative;
      width: 34px;
      height: 34px;

    }

    .lds-ring div {
      box-sizing: border-box;
      display: block;
      position: absolute;
      width: 24px;
      height: 24px;
      margin: 8px;
      border: 3px solid #06426a;
      border-radius: 50%;
      animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
      border-color: #06426a transparent transparent transparent;
    }

    .lds-ring div:nth-child(1) {
      animation-delay: -0.45s;
    }

    .lds-ring div:nth-child(2) {
      animation-delay: -0.3s;
    }

    .lds-ring div:nth-child(3) {
      animation-delay: -0.15s;
    }

    @keyframes lds-ring {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }
  </style>
</head>

<body>
  <div class="modal__login">
    <form class="modal__login__center" id="form-login" method="POST">
      <img src="../img/LOGO.png" alt="">
      <h4>Accede a tu cuenta</h4>
      <p>Ingresa a tu cuenta con un solo clic y sumérgete en un mundo de posibilidades.</p>
      <div>
        <label for="correo">Ingresa tu nombre de usuario</label>
        <input type="text" id="correo" name="correo" class="form-control" placeholder="Usuario" required>
      </div>
      <div class="input__password">
        <label for="contrasena">Ingresa tu contraseña</label>
        <input type="password" id="contrasena" name="contrasena" class="form-control" placeholder="u5}^9U;5<3)1"
          required>
        <a href="./contacto.php">¿Olvidaste tu contraseña?</a>
      </div>
      <div class="lds-ring" id="loader">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
      <button type="submit" class="button__login" id="button_login">Ingresa a tu cuenta</button>
      <a class="button__back" href="./index.php">Volver atras</a>
      <span id="message" class="message__error"></span>
    </form>
  </div>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/main.js"></script>
  <script src="../lib/WOW/WOW.min.js"></script>
  <script>
    const $formLogin = document.getElementById("form-login")
    const $message = document.getElementById("message")
    const $loader = document.getElementById("loader")
    const $button = document.getElementById("button_login")

    async function loginUser() {
      const URL = "../ajax/usuarios_ajax.php"
      const formData = new FormData($formLogin)
      formData.append("modulo_usuario", "acceder")
      $loader.style.display = "grid"
      $button.style.display = "none"
      try {
        const res = await fetch(URL, {
          method: "POST",
          body: formData
        })
        const json = await res.json()
        console.log(json)

        $message.innerHTML = json.message
        setTimeout(() => {
          $message.innerHTML = ``
        }, 3000);

        if (json.status === 203) {
          $message.innerHTML = ``
          window.location.href = "./dashboard.php";
        }
      } catch (err) {
        console.log("Sucedio un error", err)
        $message.innerHTML = `Sucedio un error en nuestros servidores, vuelve a intentarlo.`
        setTimeout(() => {
          $message.innerHTML = ``
        }, 3000);
      } finally {
        $loader.style.display = "none"
        $button.style.display = "grid"
      }
    }
    $formLogin.addEventListener("submit", (e) => {
      e.preventDefault()
      loginUser()
    })
  </script>
</body>

</html>