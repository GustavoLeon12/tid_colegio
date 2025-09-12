<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/lib/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/globals.css">
  <link rel="stylesheet" href="../css/error.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="shortcut icon" href="../img/LOGO.png" type="image/x-icon">
  <title>Colegio Orion - Error 404</title>
</head>

<body>
  <?php
        require_once './components/navigation.php';
    ?>
  <main>
    <section class="section__error">
      <div class="content__error">
        <img src="../img/error_404.svg" alt="error 404">
        <h2 class="mt-5">No encontramos la página que buscabas</h2>
        <p class="mt-2">Lamentamos informarte que no hemos podido localizar la página que estás buscando. Parece que la
          dirección web
          que ingresaste no coincide con ninguna página en nuestro sitio. Por favor, verifica la URL e inténtalo de
          nuevo. </p>
        <a class="mt-4" href="./index.php">Volver al inicio</a>
      </div>
    </section>
  </main>
  <div class="footer">
    <?php
        require_once './components/footer.php';
    ?>
  </div>
</body>

</html>