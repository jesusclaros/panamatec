<?php
session_start();
include 'conexion.php'; // tu archivo de conexión

// Obtener productos
$productos = $conexion->query("SELECT * FROM productos");

// Procesar agregar o editar producto
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = floatval($_POST['precio']);
    $imagen = $_POST['imagen'];
    $categoria_id = intval($_POST['categoria_id']);
    $cantidad = intval($_POST['cantidad']); // Nuevo campo cantidad

    if ($id == 0) {
        // Agregar nuevo producto
        $conexion->query("INSERT INTO productos (nombre, descripcion, precio, imagen, categoria_id, cantidad)
                          VALUES ('$nombre', '$descripcion', $precio, '$imagen', $categoria_id, $cantidad)");
    } else {
        // Editar producto existente
        $conexion->query("UPDATE productos SET 
            nombre = '$nombre',
            descripcion = '$descripcion',
            precio = $precio,
            imagen = '$imagen',
            categoria_id = $categoria_id,
            cantidad = $cantidad
            WHERE id = $id");
    }
    header('Location: admin_productos.php');
    exit();
}

// Procesar eliminar producto
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    $conexion->query("DELETE FROM productos WHERE id = $id");
    header('Location: admin_productos.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Administrador de los productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container py-4">

    <!-- Título principal estilo navbar -->
    <div class="text-center mb-4">
        <a class="navbar-brand text-success logo h1 align-self-center" href="index.html" style="font-size: 48px;">
            Panamatec
        </a>
    </div>

    <!-- Subtítulo "Administrar Productos" -->
    <h1 class="mb-4 text-center">Administrar Productos</h1>

    <!-- Botón para agregar producto -->
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#modalProducto"
            onclick="nuevoProducto()">Agregar Producto</button>
    </div>

    <!-- Tabla de productos -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Categoría ID</th>
                <th>Cantidad</th> <!-- Nueva columna -->
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($producto = $productos->fetch_assoc()) { ?>
            <tr>
                <td><?= $producto['id'] ?></td>
                <td><?= htmlspecialchars($producto['nombre']) ?></td>
                <td><?= htmlspecialchars($producto['descripcion']) ?></td>
                <td>$<?= number_format($producto['precio'], 2) ?></td>
                <td><img src="<?= htmlspecialchars($producto['imagen']) ?>" width="50"></td>
                <td><?= $producto['categoria_id'] ?></td>
                <td><?= $producto['cantidad'] ?></td> <!-- Mostrar cantidad -->
                <td>
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary btn-sm"
                            onclick='editarProducto(<?= json_encode($producto) ?>)'>Editar</button>
                        <a href="?eliminar=<?= $producto['id'] ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('¿Eliminar producto?')">Eliminar</a>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

<!-- Modal Agregar/Editar Producto -->
<div class="modal fade" id="modalProducto" tabindex="-1" aria-labelledby="modalProductoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalProductoLabel">Agregar / Editar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id" value="0">

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" step="0.01" name="precio" id="precio" class="form-control" required min="0.01">
                </div>

                <div class="mb-3">
                    <label for="imagen" class="form-label">URL de la Imagen</label>
                    <input type="text" name="imagen" id="imagen" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="categoria_id" class="form-label">Categoría</label>
                    <select name="categoria_id" id="categoria_id" class="form-select" required>
                        <option value="">Seleccione una categoría</option>
                        <?php
                        $categorias2 = $conexion->query("SELECT * FROM categorias WHERE nombre NOT IN ('Accesorios de Computadora', 'Componentes de PC', 'Computadoras')");
                        while ($cat = $categorias2->fetch_assoc()) {
                            echo "<option value='{$cat['id']}'>" . htmlspecialchars($cat['nombre']) . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad en stock</label>
                    <input type="number" name="cantidad" id="cantidad" class="form-control" required min="0">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar Producto</button>
            </div>
        </form>
    </div>
</div>

<script>
function nuevoProducto() {
    document.getElementById('id').value = 0;
    document.getElementById('nombre').value = '';
    document.getElementById('descripcion').value = '';
    document.getElementById('precio').value = '';
    document.getElementById('imagen').value = '';
    document.getElementById('categoria_id').value = '';
    document.getElementById('cantidad').value = '';
}

function editarProducto(producto) {
    document.getElementById('id').value = producto.id;
    document.getElementById('nombre').value = producto.nombre;
    document.getElementById('descripcion').value = producto.descripcion;
    document.getElementById('precio').value = producto.precio;
    document.getElementById('imagen').value = producto.imagen;
    document.getElementById('categoria_id').value = producto.categoria_id;
    document.getElementById('cantidad').value = producto.cantidad;
    var modal = new bootstrap.Modal(document.getElementById('modalProducto'));
    modal.show();
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
