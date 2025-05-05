<?php
// Conexión a la base de datos
include 'conexion.php';

$busqueda = isset($_GET['q']) ? trim($_GET['q']) : '';

// Consulta de búsqueda
if ($busqueda != '') {
    $sql = "SELECT productos.*, categorias.nombre AS categoria_nombre
            FROM productos
            INNER JOIN categorias ON productos.categoria_id = categorias.id
            WHERE productos.nombre LIKE ? 
            OR productos.descripcion LIKE ? 
            OR categorias.nombre LIKE ?";

    if ($stmt = mysqli_prepare($conexion, $sql)) {
        $likeBusqueda = "%" . $busqueda . "%";
        mysqli_stmt_bind_param($stmt, 'sss', $likeBusqueda, $likeBusqueda, $likeBusqueda);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }
}

// Obtener categorías principales
$sql_categorias = "SELECT * FROM categorias WHERE categoria_padre_id IS NULL";
$result_categorias = $conexion->query($sql_categorias);

// Función para obtener subcategorías
function obtenerSubcategorias($conexion, $categoria_id) {
    $sql_subcategorias = "SELECT * FROM categorias WHERE categoria_padre_id = $categoria_id";
    return $conexion->query($sql_subcategorias);
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <title>Panamatec</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="assets/img/panamatec_icono.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">

    <style>
        .fixed-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .product-wap {
            display: flex;
            flex-direction: column;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand text-success logo h1" href="index.html">Panamatec</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#templatemo_main_nav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse flex-fill d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill"></div>
                <div class="navbar d-flex">
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <button class="btn" data-bs-toggle="modal" data-bs-target="#modalCarrito">
                        🛒 Carrito (<span id="contador-carrito">0</span>)
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- CONTENIDO PRINCIPAL -->
    <div class="container py-5">
        <div class="row">
            <!-- CATEGORÍAS -->
            <div class="col-lg-3">
                <h1 class="h2 pb-4">CATEGORÍAS</h1>
                <ul class="list-unstyled templatemo-accordion" id="accordion">
                    <?php
                    $indice = 0;
                    while ($categoria = $result_categorias->fetch_assoc()) {
                        $indice++;
                        echo '
                        <li class="pb-3">
                            <a class="collapsed d-flex justify-content-between h3 text-decoration-none" data-toggle="collapse" href="#collapse' . $indice . '" role="button">
                                ' . $categoria['nombre'] . '
                                <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                            </a>
                            <ul id="collapse' . $indice . '" class="collapse list-unstyled pl-3">';
                        
                        $subcategorias = obtenerSubcategorias($conexion, $categoria['id']);
                        while ($subcategoria = $subcategorias->fetch_assoc()) {
                            $url = 'categoria_' . strtolower(str_replace(' ', '_', $subcategoria['nombre'])) . '.php';
                            echo '<li><a class="text-decoration-none" href="' . $url . '">' . $subcategoria['nombre'] . '</a></li>';
                        }

                        echo '</ul></li>';
                    }
                    ?>
                </ul>
            </div>

            <!-- PRODUCTOS -->
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-12 text-center mb-4">
                        <a class="h3 text-dark text-decoration-none">RESULTADOS DE BÚSQUEDA PARA: 
                            <strong><?php echo htmlspecialchars($busqueda); ?></strong>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <?php while ($producto = mysqli_fetch_assoc($result)): 
                        $deshabilitado = ($producto['cantidad'] == 0) ? 'disabled' : '';
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 product-wap">
                            <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" class="card-img-top fixed-image" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                                <p class="card-text"><strong>Precio:</strong> $<?php echo number_format($producto['precio'], 2); ?></p>
                                <p class="card-text"><small class="text-muted">Categoría: <?php echo htmlspecialchars($producto['categoria_nombre']); ?></small></p>
                                <p class="card-text"><small class="text-muted">Cantidad disponible: <?php echo htmlspecialchars($producto['cantidad']); ?></small></p>
                                <button class="btn btn-primary agregar-carrito <?php echo $deshabilitado; ?>"
                                        data-id="<?php echo $producto['id']; ?>"
                                        data-nombre="<?php echo htmlspecialchars($producto['nombre']); ?>"
                                        data-precio="<?php echo number_format($producto['precio'], 2); ?>"
                                        data-cantidad="<?php echo $producto['cantidad']; ?>"
                                        <?php echo $deshabilitado; ?>>
                                    <?php echo ($producto['cantidad'] == 0) ? 'Sin stock' : 'Agregar al carrito'; ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL CARRITO -->
    <div class="modal fade" id="modalCarrito" tabindex="-1" aria-labelledby="modalCarritoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Carrito de Compras</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <ul id="lista-carrito" class="list-group mb-3"></ul>
                    <h5>Subtotal (sin impuesto): $<span id="subtotal-carrito">0.00</span></h5>
                    <h5>Impuesto (7%): $<span id="monto-impuesto">0.00</span></h5>
                    <h5>Total: $<span id="total-carrito">0.00</span></h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" id="eliminar-todo">Vaciar carrito</button>
                    <button class="btn btn-success">Finalizar compra</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const listaCarrito = document.getElementById('lista-carrito');
            const subtotalCarrito = document.getElementById('subtotal-carrito');
            const montoImpuesto = document.getElementById('monto-impuesto');
            const totalCarrito = document.getElementById('total-carrito');
            const contadorCarrito = document.getElementById('contador-carrito'); // Agrega el contador

            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

            function actualizarCarrito() {
                listaCarrito.innerHTML = '';
                let total = 0;
                let totalProductos = 0;

                carrito.forEach((producto, index) => {
                    total += producto.precio * producto.cantidad;
                    totalProductos += producto.cantidad;

                    const item = document.createElement('li');
                    item.className = 'list-group-item d-flex justify-content-between align-items-center';
                    item.innerHTML = `
                <div class="d-flex flex-column">
                    <strong>${producto.nombre}</strong>
                    <small>$${producto.precio.toFixed(2)} c/u</small>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-sm btn-outline-secondary" onclick="cambiarCantidad(${index}, -1)">−</button>
                    <span>${producto.cantidad}</span>
                    <button class="btn btn-sm btn-outline-secondary" onclick="cambiarCantidad(${index}, 1)">+</button>
                    <button class="btn btn-sm btn-danger" onclick="eliminarProducto(${index})">Eliminar</button>
                </div>
            `;
                    listaCarrito.appendChild(item);
                });

                // Actualizar los valores del carrito
                const montoImpuestoValor = total * 0.07;
                const totalConImpuesto = total + montoImpuestoValor;

                subtotalCarrito.textContent = total.toFixed(2);
                montoImpuesto.textContent = montoImpuestoValor.toFixed(2);
                totalCarrito.textContent = totalConImpuesto.toFixed(2);

                // Actualiza el contador del carrito
                contadorCarrito.textContent = totalProductos;  // Actualiza el contador con el número de productos

                // Guarda el carrito en localStorage
                localStorage.setItem('carrito', JSON.stringify(carrito));
            }

            // Función para agregar productos al carrito
            document.querySelectorAll('.agregar-carrito').forEach(boton => {
                boton.addEventListener('click', () => {
                    const nombre = boton.getAttribute('data-nombre');
                    const precio = parseFloat(boton.getAttribute('data-precio'));
                    const id = boton.getAttribute('data-id');

                    const index = carrito.findIndex(p => p.id === id);
                    if (index !== -1) {
                        carrito[index].cantidad++;
                    } else {
                        carrito.push({ id, nombre, precio, cantidad: 1 });
                    }

                    actualizarCarrito();
                });
            });

            window.cambiarCantidad = function (index, cambio) {
                carrito[index].cantidad += cambio;
                if (carrito[index].cantidad <= 0) {
                    carrito.splice(index, 1);
                }
                actualizarCarrito();
            }

            window.eliminarProducto = function (index) {
                carrito.splice(index, 1);
                actualizarCarrito();
            }

            document.getElementById('eliminar-todo').addEventListener('click', () => {
                carrito = [];
                actualizarCarrito();
            });

            actualizarCarrito();
        });

    </script>

    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->

</body>
</html>