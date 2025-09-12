<?php
	require_once '../../global.php';
?>
<head>
    <link rel="stylesheet" href="modalform_admision/modal.css">
</head>
<div class="modal__admision" id="formAdmision">
  <div class="form-contact container mt-5 ">
    <button class="button__close__contact open-form-admision"><i class="fas fa-times"></i></button>
    <form id="contact-form" action="https://formsubmit.co/colegiooriontarma@gmail.com" method="POST" onsubmit="limpiarFormulario()">
      <h4 class="mb-1"><i class="fas fa-user-alt icon__form" style="padding-right: 15px;"></i> Datos del padre de familia</h4>
      <p class="mb-4" style="text-align:justify;">Agradecemos su interés en reservar una vacante para su hijo(a) en nuestro colegio. 
        Para agilizar el proceso, le solicitamos que complete el siguiente formulario con la información necesaria.
      </p>
      
      <div class="nombre-apellidos d-flex justify-content-between mb-3">
        <div>
          <label for="nombre">Ingresa tu nombre:</label>
          <input type="text" class="form-control" id="nombre" placeholder="Nombres" name="Nombre" required>
        </div>
        <div>
          <label for="apellido">Ingresa tu apellido:</label>
          <input type="text" class="form-control" id="apellido" name="Apellido" placeholder="Apellidos" required>
        </div>
      </div>
      
      <label for="tipoDocumento">Selecciona el tipo de documento:</label>
      <div class="mb-3 input-group">
        <select class="form-select custom-select" id="tipoDocumento" required>
          <option value="" disabled selected>Seleccione el tipo de documento</option>
          <option value="DNI">DNI</option>
          <option value="Cédula de ciudadanía">Cédula de ciudadanía</option>
          <option value="Pasaporte">Pasaporte</option>
        </select>
      </div>
      
      <div class="mb-3">
        <label for="numDoc">Ingresa tu número documento:</label>
        <input type="text" class="form-control" id="numDoc" name="DNI" placeholder="Número de documento" required>
      </div>
      <div class="mb-3">
        <label for="email">Ingresa tu correo electronico:</label>
        <input type="email" class="form-control" id="email" name="Correo electronico" placeholder="Correo electronico">
      </div>
      <div class="mb-3">
        <label for="telefono">Ingresa tu número de celular:</label>
        <input type="tel" maxlength="9" pattern="[0-9]{9}" class="form-control" id="telefono" name="Número de celular" placeholder="Teléfono" 
        required>
      </div>
      <div class="aceptop-check">
        <input class="form-check-input" type="checkbox" id="terminosCheckbox" name="Terminos y condiciones" value="Acepto" required>
        <label for="terminosCheckbox">Acepto los Terminos y Condiciones </label>
      </div>
      
      <!-- Configuraciones adicionales -->
      <input type="hidden" name="_captcha" value="false">
      <input type="hidden" name="_subject" value="Solicita vacante - Plataforma Orion">
      <input type="hidden" name="_template" value="table">

      <button type="submit" class="btn text-white w-100 mt-4">SOLICITAR INFORMACION</button>
    </form>

<script>
  function limpiarFormulario() {
    // Espera 50 milisegundos antes de limpiar el formulario
    setTimeout(function() {
      document.getElementById("contact-form").reset();
    }, 50);
  }
  // Limitar el número de dígitos del número de documento según el tipo de documento
  document.getElementById('tipoDocumento').addEventListener('change', function() {
    const numDocInput = document.getElementById('numDoc');
    const tipoDocumento = this.value;

    if (tipoDocumento === 'DNI' || tipoDocumento === 'Cédula de ciudadanía') {
      numDocInput.setAttribute('maxlength', '8');
      numDocInput.setAttribute('pattern', '\\d{8}');
      numDocInput.setAttribute('title', 'El número de documento debe tener 8 dígitos.');
    } else if (tipoDocumento === 'Pasaporte') {
      numDocInput.setAttribute('maxlength', '20');
      numDocInput.setAttribute('pattern', '\\d{1,20}');
      numDocInput.setAttribute('title', 'El número de pasaporte puede tener hasta 20 dígitos.');
    }
  });
</script>

  </div>
</div>