function verificarImagen(e) {
  document.addEventListener("DOMContentLoaded", function () {
    const $imagen = document.querySelector(`.${e}`);
    $imagen.setAttribute(
      "src",
      "https://campus-colegiosorion.net.pe/apiimagenes-colegioorion/usuarios/image.png"
    );
  });
}
