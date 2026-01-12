const URL = "https://apiperu.net/api/dni";

async function consultarDNI(buttonHTML, dniHTML, nameHTML, lastnameHTML) {
  const $button = document.getElementById(buttonHTML);
  const $nameHTML = document.getElementById(nameHTML);
  const $lastnameHTML = document.getElementById(lastnameHTML);
  const dniNumero = document.getElementById(dniHTML).value;

  try {
    $button.innerHTML = `<div class="lds-dual-ring"></div>`;
    $button.setAttribute("disabled", true);
    const token = "CtsuKdVzTkFmqdw01CDRXkXY1TGQ7FdpYUdMovlDU1jWnIDfBJ";
    const response = await fetch(
      `https://apiperu.net/api/dni/${dniNumero}?api_token=${token}`
    );
    if (!response.ok) {
      throw new Error(
        `Error de respuesta del servidor: ${response.statusText}`
      );
    }
    const responseData = await response.json();
    const apellidos = `${responseData.data.apellido_paterno} ${responseData.data.apellido_materno}`;
    const nombre = responseData.data.nombres;
    $lastnameHTML.value = apellidos;
    $nameHTML.value = nombre;
    $button.parentElement.nextElementSibling.innerHTML = "";
  } catch (error) {
    $button.parentElement.nextElementSibling.innerHTML =
      "No se encontro el DNI ingresado";
  } finally {
    $button.removeAttribute("disabled");
    $button.innerHTML = `
    <svg
      xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report-search" width="24"
      height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
      stroke-linecap="round" stroke-linejoin="round">
      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
      <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697" />
      <path d="M18 12v-5a2 2 0 0 0 -2 -2h-2" />
      <path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
      <path d="M8 11h4" />
      <path d="M8 15h3" />
      <path d="M16.5 17.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0" />
      <path d="M18.5 19.5l2.5 2.5" />
    </svg>
  `;
  }
}

function elegirTipoDocu(e, button) {
  const event = document.getElementById(e);
  const $button = document.getElementById(button);
  console.log(event.value);
  if (event.value === "1") {
    $button.style.display = "block";
  } else {
    $button.style.display = "none";
  }
}
