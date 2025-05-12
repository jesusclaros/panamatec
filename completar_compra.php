<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'];
    $nombre = $_POST['nombre'];
    $numero_tarjeta = $_POST['numero'];
    $fecha = $_POST['fecha'];
    $cvv = $_POST['cvv'];
    $total = $_POST['total'];
    $impuesto = $_POST['impuesto'];

    // Conexión a la base de datos de tarjetas (ajusta si usas una sola base)
    $conn = new mysqli("localhost", "root", "", "panamatec");
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Buscar tarjeta
    $stmt = $conn->prepare("SELECT id, monto FROM tarjetas WHERE tipo = ? AND numero_tarjeta = ? AND fecha_expiracion = ? AND cvv = ?");
    $stmt->bind_param("ssss", $tipo, $numero_tarjeta, $fecha, $cvv);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id_tarjeta, $monto_actual);
        $stmt->fetch();

        if ($monto_actual >= $total) {
            // Descontar el monto
            $nuevo_monto = $monto_actual - $total;
            $update = $conn->prepare("UPDATE tarjetas SET monto = ? WHERE id = ?");
            $update->bind_param("di", $nuevo_monto, $id_tarjeta);
            $update->execute();

            // Guardar la compra en la base de datos 'panamtec'
            $insertCompra = $conn->prepare("INSERT INTO compra (nombre_cliente, monto_total, itbms) VALUES (?, ?, ?)");
            $insertCompra->bind_param("sdd", $nombre, $total, $impuesto);
            $insertCompra->execute();

            // Obtener el id de la compra realizada
            $id_compra = $insertCompra->insert_id;

            // Guardar los detalles de la compra en la tabla de 'detalle_compra'
            $productos = json_decode($_POST['productos'], true); // Obtener los productos desde el formulario (en formato JSON)
            foreach ($productos as $producto) {
                // Insertar el detalle de la compra
                $insertDetalle = $conn->prepare("INSERT INTO detalle_compra (id_compra, producto_nombre, descripcion, precio_unitario, cantidad, total_producto) VALUES (?, ?, ?, ?, ?, ?)");
                $insertDetalle->bind_param("issdii", $id_compra, $producto['nombre'], $producto['descripcion'], $producto['precio'], $producto['cantidad'], $producto['total']);
                $insertDetalle->execute();

                // Actualizar la cantidad de productos en la base de datos
                $updateProducto = $conn->prepare("UPDATE productos SET cantidad = cantidad - ? WHERE id = ?");
                $updateProducto->bind_param("ii", $producto['cantidad'], $producto['id']); // Restar la cantidad del producto
                $updateProducto->execute();
            }

            echo "<script>alert('¡Compra realizada exitosamente!'); localStorage.removeItem('carrito'); window.location.href = 'tienda.php';</script>";
            exit;
        } else {
            echo "<script>alert('Fondos insuficientes.');</script>";
        }
    } else {
        echo "<script>alert('Datos de tarjeta incorrectos.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Completar Compra</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>PRODUCTOS DEL CARRITO</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody id="productos-comprados">
        </tbody>
    </table>

    <div class="mb-3">
        <p><strong>Subtotal:</strong> $<span id="subtotal"></span></p>
        <p><strong>Impuesto (7%):</strong> $<span id="impuesto"></span></p>
        <p><strong>Total:</strong> $<span id="total"></span></p>
    </div>

    <h3>FORMA DE PAGO</h3>
<form method="POST" id="form-pago">
    <div class="mb-3">
        <label for="tipo" class="form-label">Tipo de tarjeta:</label>
        <select name="tipo" id="tipo" class="form-select" required>
            <option value="">Seleccione</option>
            <option value="credito">Crédito</option>
            <option value="debito">Débito</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre del titular:</label>
        <input type="text" name="nombre" id="nombre" class="form-control" required pattern="^[A-Za-zÁÉÍÓÚÑáéíóúñ ]{2,}$" title="Solo letras y espacios." maxlength="50">
    </div>

    <div class="mb-3">
        <label for="numero" class="form-label">Número de tarjeta:</label>
        <input type="text" name="numero" id="numero" class="form-control" required pattern="^\d{16}$" maxlength="16" title="Debe contener 16 dígitos numéricos.">
    </div>

    <div class="mb-3">
        <label for="fecha" class="form-label">Fecha de expiración (MM/AA):</label>
        <input type="text" name="fecha" id="fecha" class="form-control" placeholder="MM/AA" required pattern="^(0[1-9]|1[0-2])\/\d{2}$" title="Formato válido: MM/AA" maxlength="5">
    </div>

    <div class="mb-3">
        <label for="cvv" class="form-label">CVV:</label>
        <input type="text" name="cvv" id="cvv" class="form-control" required pattern="^\d{3,4}$" maxlength="4" title="Debe contener 3 o 4 dígitos.">
    </div>

    <!-- Campos ocultos -->
    <input type="hidden" name="total" id="totalInput">
    <input type="hidden" name="impuesto" id="impuestoInput">
    <input type="hidden" name="productos" id="productosInput">

    <button type="submit" class="btn btn-success">Realizar pago</button>
</form>

<script>
    // Cargar productos desde localStorage y calcular totales (sin cambios)
    const productosComprados = document.getElementById('productos-comprados');
    const subtotalElement = document.getElementById('subtotal');
    const impuestoElement = document.getElementById('impuesto');
    const totalElement = document.getElementById('total');
    const productosInput = document.getElementById('productosInput');
    const totalInput = document.getElementById('totalInput');
    const impuestoInput = document.getElementById('impuestoInput');

    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    let subtotal = 0;

    carrito.forEach(producto => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${producto.nombre}</td>
            <td>${producto.descripcion}</td>
            <td>$${producto.precio.toFixed(2)}</td>
            <td>${producto.cantidad}</td>
            <td>$${(producto.precio * producto.cantidad).toFixed(2)}</td>
        `;
        productosComprados.appendChild(row);
        subtotal += producto.precio * producto.cantidad;
    });

    const itbms = subtotal * 0.07;
    const total = subtotal + itbms;

    subtotalElement.textContent = subtotal.toFixed(2);
    impuestoElement.textContent = itbms.toFixed(2);
    totalElement.textContent = total.toFixed(2);

    totalInput.value = total.toFixed(2);
    impuestoInput.value = itbms.toFixed(2);
    productosInput.value = JSON.stringify(carrito);

    // Validación adicional por JavaScript
    const form = document.getElementById('form-pago');
    form.addEventListener('submit', function(e) {
        const nombre = document.getElementById('nombre').value.trim();
        const numero = document.getElementById('numero').value;
        const fecha = document.getElementById('fecha').value;
        const cvv = document.getElementById('cvv').value;

        const regexNombre = /^[A-Za-zÁÉÍÓÚÑáéíóúñ ]+$/;
        const regexFecha = /^(0[1-9]|1[0-2])\/\d{2}$/;

        if (!regexNombre.test(nombre)) {
            alert("El nombre solo debe contener letras y espacios.");
            e.preventDefault();
        } else if (!/^\d{16}$/.test(numero)) {
            alert("El número de tarjeta debe tener exactamente 16 dígitos.");
            e.preventDefault();
        } else if (!regexFecha.test(fecha)) {
            alert("La fecha debe tener el formato MM/AA.");
            e.preventDefault();
        } else if (!/^\d{3,4}$/.test(cvv)) {
            alert("El CVV debe tener 3 o 4 dígitos.");
            e.preventDefault();
        }
    });
</script>

<script>
    // Permitir solo letras y espacios
    document.getElementById('nombre').addEventListener('input', function (e) {
        this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚÜÑáéíóúüñ\s]/g, '');
    });

    // Solo números en el número de tarjeta
    document.getElementById('numero').addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '').slice(0, 16); // máximo 16 dígitos
    });

    // Solo números y "/" en la fecha (máx 5 caracteres)
    document.getElementById('fecha').addEventListener('input', function () {
        this.value = this.value.replace(/[^0-9\/]/g, '').slice(0, 5);
    });

    // Solo números en CVV (máx 4 dígitos)
    document.getElementById('cvv').addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '').slice(0, 4);
    });
</script>

</body>
</html>

