<?php
include('conexion.php'); // Asegúrate de que este archivo contiene la conexión a la base de datos

// Obtener las categorías principales
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

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">

    <style>
        .fixed-image {
            width: 100%;
            height: 300px;
            /* Puedes ajustar este alto si quieres más grande o pequeño */
            object-fit: cover;
            /* Corta la imagen para que se ajuste sin deformarla */
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
<!-- Inicio del Top Nav -->
<nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:panamatec@company.com">panamatec@company.com</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:6893-3456">6893-3456</a>
                </div>
                <div>
                    <a class="text-light" href="https://fb.com/templatemo" target="_blank"><i class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://twitter.com/" target="_blank"><i class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin fa-sm fa-fw"></i></a>
                </div>
            </div>
        </div>
    </nav>
<!-- Cierre del Top Nav -->

<!-- Encabezado -->
<nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container d-flex justify-content-between align-items-center">

        <a class="navbar-brand text-success logo h1 align-self-center" href="index.html">
            Panamatec
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="align-self-center collapse navbar-collapse flex-fill d-lg-flex justify-content-lg-between"
            id="templatemo_main_nav">
            <div class="flex-fill">
                <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Inicio</a>
                    </li>
                </ul>
            </div>
            <div class="navbar align-self-center d-flex">
                <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                    <div class="input-group">
                        <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                        <div class="input-group-text">
                            <i class="fa fa-fw fa-search"></i>
                        </div>
                    </div>
                </div>
                <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal"
                    data-bs-target="#templatemo_search">
                    <i class="fa fa-fw fa-search text-dark mr-2"></i>
                </a>

                <!-- Carrito -->
                <button class="btn" data-bs-toggle="modal" data-bs-target="#modalCarrito">
                    🛒 Carrito (<span id="contador-carrito">0</span>)
                </button>
                <!-- Fin del carrito -->

            </div>
        </div>

    </div>
</nav>
<!-- Final del encabezado -->

   <!-- Inicio del contenido -->
<div class="container py-5">
    <div class="row">
        <!-- Inicio del menu de categorias -->
        <div class="col-lg-3">
            <h1 class="h2 pb-4">CATEGORIAS</h1>
            <ul class="list-unstyled templatemo-accordion" id="accordion">
                <?php
                    $indice = 0;
                    while ($categoria = $result_categorias->fetch_assoc()) {
                        $indice++;
                        echo '
                            <li class="pb-3">
                                <a class="collapsed d-flex justify-content-between h3 text-decoration-none" data-toggle="collapse" href="#collapse' . $indice . '" role="button" aria-expanded="false" aria-controls="collapse' . $indice . '">
                                    ' . $categoria['nombre'] . '
                                    <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                                </a>
                                <ul id="collapse' . $indice . '" class="collapse list-unstyled pl-3">';

                                $subcategorias = obtenerSubcategorias($conexion, $categoria['id']);
                                while ($subcategoria = $subcategorias->fetch_assoc()) {
                                    $url_subcategoria = 'categoria_' . strtolower(str_replace(' ', '_', $subcategoria['nombre'])) . '.php';
                                    echo '<li><a class="text-decoration-none" href="' . $url_subcategoria . '">' . $subcategoria['nombre'] . '</a></li>';
                                }

                                echo '
                                </ul>
                            </li>';
                    }   
                ?>
            </ul>
        </div>
        <!-- Fin del menu de categorias -->

        <!-- Inicio del contenido de productos -->
        <div class="col-lg-9">
            <div class="row">
                <div class="col-md-12 text-center mb-4">
                    <a class="h3 text-dark text-decoration-none">TARJETAS MADRES</a>
                </div>
            </div>

            <!-- Productos de la categoría "Tarjeta Madre" -->
            <div class="row">
                <?php
                $sql_productos = "
                    SELECT productos.*, categorias.nombre AS categoria_nombre 
                    FROM productos 
                    INNER JOIN categorias ON productos.categoria_id = categorias.id 
                    WHERE categorias.nombre = 'Tarjeta Madre'
                ";
                $result_productos = $conexion->query($sql_productos);

                if ($result_productos->num_rows > 0):
                    while ($producto = $result_productos->fetch_assoc()):
                        // Verificar si la cantidad es 0
                        $deshabilitado = ($producto['cantidad'] == 0) ? 'disabled' : '';
                ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 product-wap">
                                <img src="<?php echo htmlspecialchars($producto['imagen']); ?>"
                                    class="card-img-top fixed-image"
                                    alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo htmlspecialchars($producto['nombre']); ?>
                                    </h5>
                                    <p class="card-text">
                                        <?php echo htmlspecialchars($producto['descripcion']); ?>
                                    </p>
                                    <p class="card-text"><strong>Precio:</strong> $
                                        <?php echo number_format($producto['precio'], 2); ?>
                                    </p>
                                    <p class="card-text">
                                        <small class="text-muted">Categoría:
                                            <?php echo htmlspecialchars($producto['categoria_nombre']); ?>
                                        </small>
                                    </p>
                                    <p class="card-text">
                                        <small class="text-muted">Cantidad disponible:
                                            <?php echo htmlspecialchars($producto['cantidad']); ?>
                                        </small>
                                    </p>
                                    <!-- Botón para agregar al carrito (deshabilitado si cantidad es 0) -->
                                    <button class="btn btn-primary agregar-carrito <?php echo $deshabilitado; ?>"
                                    data-id="<?php echo $producto['id']; ?>"
                                    data-nombre="<?php echo htmlspecialchars($producto['nombre']); ?>"
                                    data-precio="<?php echo number_format($producto['precio'], 2); ?>"
                                    data-cantidad="<?php echo $producto['cantidad']; ?>"
                                    data-descripcion="<?php echo htmlspecialchars($producto['descripcion']); ?>" 
                                    data-imagen="<?php echo htmlspecialchars($producto['imagen']); ?>" 
                                    <?php echo $deshabilitado; ?>>
                                    <?php echo ($producto['cantidad'] == 0) ? 'Sin stock' : 'Agregar al carrito'; ?>
                                </button>
                                </div>
                            </div>
                        </div>
                <?php
                    endwhile;
                else:
                    echo "<div class='col-12'><p class='text-danger text-center'>No hay productos disponibles en esta categoría.</p></div>";
                endif;
                ?>
            </div>
            <!-- Fin de los productos de la categoría "Tarjeta Madre" -->
        </div>
        <!-- Fin del contenido de productos -->

        <!-- Paginación -->
        <div class="row">
            <ul class="pagination pagination-lg justify-content-end">
                <li class="page-item disabled">
                    <a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0" href="#" tabindex="-1">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link rounded-0 shadow-sm border-top-0 border-left-0 text-dark" href="#">3</a>
                </li>
            </ul>
        </div>
        <!-- Fin de la paginación -->

    </div>
</div>
<!-- Fin del contenido -->

<!-- Modal de busqueda -->
<div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="w-100 pt-1 mb-5 text-right">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="buscar.php" method="get" class="modal-content modal-body border-0 p-0">
            <div class="input-group mb-2">
                <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                <button type="submit" class="input-group-text bg-success text-light">
                    <i class="fa fa-fw fa-search text-white"></i>
                </button>
            </div>
        </form>
    </div>
</div>
<!-- Fin del modal de busqueda -->

<!-- Inicio del Modal del carrito -->
<div class="modal fade" id="modalCarrito" tabindex="-1" aria-labelledby="modalCarritoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Carrito de Compras</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <ul id="lista-carrito" class="list-group mb-3">
                    <!-- Productos agregados -->
                </ul>
                <h5>Subtotal (sin impuesto): $<span id="subtotal-carrito">0.00</span></h5>
                <h5>Impuesto (7%): $<span id="monto-impuesto">0.00</span></h5>
                <h5>Total: $<span id="total-carrito">0.00</span></h5>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" id="eliminar-todo">Vaciar carrito</button>
                <!-- Botón de Finalizar compra como enlace -->
                <a href="completar_compra.php" id="finalizar-compra" class="btn btn-success">
                    Finalizar compra
                </a>

                <script>
                document.getElementById('finalizar-compra').addEventListener('click', (e) => {
                    // Guardar los productos del carrito en localStorage
                    localStorage.setItem('carrito', JSON.stringify(carrito));
                });
                </script>
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Final del modal -->

<!-- Inicio del footer -->
<footer class="bg-dark" id="tempaltemo_footer">
    <div class="container">
        <div class="row">

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-success border-bottom pb-3 border-light logo">Panamatec</h2>
                <ul class="list-unstyled text-light footer-link-list">
                    <li>
                        <i class="fas fa-map-marker-alt fa-fw"></i>
                        Panamá city, Panamá
                    </li>
                    <li>
                        6893-3456
                    </li>
                    <li>
                        <i class="fa fa-envelope fa-fw"></i>
                        <a class="text-decoration-none" href="mailto:info@company.com">panamatec@company.com</a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="row text-light mb-4">
            <div class="col-12 mb-3">
                <div class="w-100 my-3 border-top border-light"></div>
            </div>
            <div class="col-auto me-auto">
                <ul class="list-inline text-left footer-icons">
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/">
                            <i class="fab fa-facebook-f fa-lg fa-fw"></i>
                        </a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/">
                            <i class="fab fa-instagram fa-lg fa-fw"></i>
                        </a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/">
                            <i class="fab fa-twitter fa-lg fa-fw"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="w-100 bg-black py-3">
        <div class="container">
            <div class="row pt-2">
                <div class="col-12">
                    <p class="text-left text-light">
                        Copyright &copy; 2025 Panamatec
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Final del footer -->

<script>
document.addEventListener('DOMContentLoaded', () => {
    const listaCarrito = document.getElementById('lista-carrito');
    const subtotalCarrito = document.getElementById('subtotal-carrito');
    const montoImpuesto = document.getElementById('monto-impuesto');
    const totalCarrito = document.getElementById('total-carrito');
    const contadorCarrito = document.getElementById('contador-carrito');  // Agregar el contador del carrito

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
                    <small>${producto.descripcion}</small> <!-- Mostrar la descripción -->
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

        const montoImpuestoValor = total * 0.07;
        const totalConImpuesto = total + montoImpuestoValor;

        subtotalCarrito.textContent = total.toFixed(2);
        montoImpuesto.textContent = montoImpuestoValor.toFixed(2);
        totalCarrito.textContent = totalConImpuesto.toFixed(2);

        // Actualizar el contador de productos en el carrito en el nav
        contadorCarrito.textContent = totalProductos;  // Actualizar el contador de productos

        // Guardar el carrito actualizado en localStorage
        localStorage.setItem('carrito', JSON.stringify(carrito));
    }

    document.querySelectorAll('.agregar-carrito').forEach(boton => {
        boton.addEventListener('click', () => {
            const nombre = boton.getAttribute('data-nombre');
            const precio = parseFloat(boton.getAttribute('data-precio'));
            const id = boton.getAttribute('data-id');
            const cantidadDisponible = parseInt(boton.getAttribute('data-cantidad'));
            const descripcion = boton.getAttribute('data-descripcion'); // Obtener la descripción
            const imagen = boton.getAttribute('data-imagen'); // Obtener la imagen

            const index = carrito.findIndex(p => p.id === id);
            if (index !== -1) {
                if (carrito[index].cantidad < cantidadDisponible) {
                    carrito[index].cantidad++;
                } else {
                    alert('¡No hay más stock disponible para este producto!');
                }
            } else {
                carrito.push({ id, nombre, precio, cantidad: 1, cantidadDisponible, descripcion, imagen });
            }

            actualizarCarrito();
        });
    });

    window.cambiarCantidad = function (index, cambio) {
        const producto = carrito[index];

        if (cambio === 1 && producto.cantidad < producto.cantidadDisponible) {
            producto.cantidad += cambio;
        } else if (cambio === -1) {
            producto.cantidad += cambio;
            if (producto.cantidad <= 0) {
                carrito.splice(index, 1);
            }
        } else if (cambio === 1 && producto.cantidad >= producto.cantidadDisponible) {
            alert('¡Ya alcanzaste el stock máximo disponible!');
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

    <!-- Inicio de scripts -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- Final de scripts -->

</body>
</html>