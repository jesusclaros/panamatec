<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Administrador</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #ffffff; /* blanco */
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }

    .login-container {
      background-color: #e0f9d7; /* verde lima suave */
      border-radius: 10px;
      padding: 2rem;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
    }

    .form-control {
      border: 1px solid #a3d9a5;
    }

    .form-label {
      font-weight: 500;
    }

    @media (max-height: 500px) {
      .login-container {
        padding: 1rem;
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h4 class="text-center mb-4">Acceso Administrador</h4>
    <form>
      <div class="mb-3">
        <label for="adminId" class="form-label">ID</label>
        <input type="text" class="form-control" id="adminId" placeholder="ID de administrador">
      </div>
      <div class="mb-3">
        <label for="adminName" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="adminName" placeholder="Tu nombre">
      </div>
      <div class="mb-3">
        <label for="adminEmail" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" id="adminEmail" placeholder="correo@ejemplo.com">
      </div>
      <div class="mb-3">
        <label for="adminPassword" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="adminPassword" placeholder="Contraseña">
      </div>
      <button type="submit" class="btn btn-success w-100">Iniciar sesión</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
