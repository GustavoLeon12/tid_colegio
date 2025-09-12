const mostrarIcon = document.getElementById("mostrarIcon");
const contenido = document.getElementById("contenido");
const $formAdmision = document.getElementById("formAdmision");

document.addEventListener("click", (e) => {
  dinamicScrollAdmision(e.target);
  openFormAdmision(e.target);
});

function openFormAdmision(target) {
  if (target.className.includes("open-form-admision")) {
    $formAdmision.classList.toggle("active-form-admision");
  }
}

function dinamicScrollAdmision(target) {
  if (target.className.includes("inicial")) {
    setAndRedirect("inicial");
  } else if (target.className.includes("primaria")) {
    setAndRedirect("primaria");
  } else if (target.className.includes("secundaria")) {
    setAndRedirect("secundaria");
  }
}

function setAndRedirect(value) {
  localStorage.setItem("ADMISION_CLICK", value);
  window.location.href = "./admision.php";
}
