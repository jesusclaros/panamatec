<!doctype html>
<html lang="es">

<head>
    <title>Panamatec - Login Administrador</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <!-- Íconos y estilos personalizados -->
    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">

    <style>
        body {
            background-color: #ffffff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
        }

        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-container {
            background-color: #e0f9d7;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .form-control {
            border: 1px solid #a3d9a5;
        }

        .form-label {
            font-weight: 500;
        }
    </style>
</head>

<body>

    <!-- Alerta de validación -->
    <div class="alert alert-warning alert-dismissible fade show mt-3 mb-2 mx-4" id="alertaLetra" style="display: none;">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <strong>Warning:</strong>
        <span id="mensajeAlertaLetra"></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <!-- Header/Nav -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light shadow">
            <div class="container d-flex justify-content-between align-items-center">
                <a class="navbar-brand text-success logo h1 align-self-center" href="index.php">
                    Panamatec
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#templatemo_main_nav" aria-controls="templatemo_main_nav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse flex-fill d-lg-flex justify-content-lg-between"
                    id="templatemo_main_nav">
                    <div class="flex-fill">
                        <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="about.html">Acerca de nosotros</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="tienda.php">Tienda</a>
                            </li>
                        </ul>
                    </div>
                    <div class="navbar align-self-center d-flex">
                        <a class="nav-icon position-relative text-decoration-none" href="loginadmin.php">
                            <i class="fa fa-fw fa-user text-dark me-2"></i>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light text-dark">+99</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Contenido principal -->
    <main>
        <div class="login-container">
            <h4 class="text-center mb-4">Acceso Administrador</h4>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="adminId" class="form-label">ID</label>
                    <input type="text" class="form-control" id="adminId" name="adminId" placeholder="ID de administrador">
                </div>
                <div class="mb-3">
                    <label for="adminName" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="adminName" name="adminName" placeholder="Tu nombre"
                        oninput="validarLetraSc()">
                </div>
                <div class="mb-3">
                    <label for="adminEmail" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="adminEmail" name="adminEmail"
                        placeholder="correo@ejemplo.com">
                </div>
                <div class="mb-3">
                    <label for="adminPassword" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="adminPassword" name="adminPassword"
                        placeholder="Contraseña">
                </div>
                <button type="submit" class="btn btn-success w-100">Iniciar sesión</button>
            </form>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6/3Yk8R6tE2n8pACB1zNz5aTw80c+FzD6aF+7UO6DJoTjF5vmjI"
        crossorigin="anonymous"></script>

    <!-- Script de validación -->
    <script>
      const nombreInput = document.getElementById("adminName");
      const alerta = document.getElementById("alertaLetra");
      const mensaje = document.getElementById("mensajeAlertaLetra");
      const soloLetras = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;

      // Bloquear teclas no permitidas
      nombreInput.addEventListener("keypress", function (event) {
          const char = String.fromCharCode(event.which);
          if (!soloLetras.test(char)) {
              event.preventDefault();
          }
      });

      // Bloquear pegado inválido
      nombreInput.addEventListener("paste", function (event) {
          const pastedData = (event.clipboardData || window.clipboardData).getData("text");
          if (!soloLetras.test(pastedData)) {
              event.preventDefault();
              mensaje.textContent = "No se pueden pegar caracteres no permitidos (solo letras y espacios).";
              alerta.style.display = "block";
          }
      });

      // Validar al salir del campo
      nombreInput.addEventListener("blur", function () {
          if (!soloLetras.test(nombreInput.value)) {
              mensaje.textContent = "Completa el campo Nombre solo con letras antes de continuar.";
              alerta.style.display = "block";
              setTimeout(() => {
                  nombreInput.focus();
              }, 10);
          } else {
              alerta.style.display = "none";
          }
      });
    </script>
    <script>
        const idInput = document.getElementById("adminId");
        const soloNumeros = /^[0-9]+$/;

        // Bloquear teclas no numéricas
        idInput.addEventListener("keypress", function (event) {
            const char = String.fromCharCode(event.which);
            if (!soloNumeros.test(char)) {
                event.preventDefault();
            }
        });

        // Bloquear pegar contenido inválido
        idInput.addEventListener("paste", function (event) {
            const pastedData = (event.clipboardData || window.clipboardData).getData("text");
            if (!soloNumeros.test(pastedData)) {
                event.preventDefault();
            }
        });

        // Impedir salir del campo si no es válido (sin mostrar alerta)
        idInput.addEventListener("blur", function () {
            if (!soloNumeros.test(idInput.value)) {
                setTimeout(() => {
                    idInput.focus();
                }, 10);
            }
        });
      </script>



</body>

</html>

