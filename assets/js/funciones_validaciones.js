// VALIDAR CAMPOS PARA LETRAS
function validarLetraSc() {
    var campo1 = document.getElementById("");
    var letras = campo1.value.trim();
    if (!/^[a-zA-ZáéíóúüÁÉÍÓÚÜ\s.,?¿/]+$/.test(letras)) {
        mostrarAlertaLetra("Este campo no acepta numeros");
        campo1.value = letras.replace(/[^a-zA-ZáéíóúüÁÉÍÓÚÜ\s.,?¿/]/g, '');
    }
}

function mostrarAlertaLetra(mensaje) {
    var alertaLetra = document.getElementById("alertaLetra");
    var mensajeAlertaLetra = document.getElementById("mensajeAlertaLetra");
    mensajeAlertaLetra.textContent = mensaje;
    alertaLetra.style.display = "block";
}

//Temporalmente puesto aquí
//<div class="alert alert-warning alert-dismissible fade show mt-3 mb-2 mx-4" id="alertaDetalle" style="display: none;">
//	<i class="bi bi-exclamation-triangle-fill"></i>
//	<strong>Warning:</strong>
//	<span id="mensajeAlertaDetalle"></span>
//	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
//</div>

//VALIDAR CAMPOS PARA NÚMEROS
function validarSoloNumeros(inputElement) {
    const valor = inputElement.value.trim();
    const esNumeroValido = /^(\d+)?(\.\d+)?$/.test(valor);
    
    if (!esNumeroValido) {
      inputElement.value = ''; // Con esto borra el contenido del campo si no es válido
    }
  
    return esNumeroValido;
  }

  //BOTONES