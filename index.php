<!doctype html>
<html lang="es">

<head>
    <title>Panamatec</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
</head>

<body>
    <!-- Inicio del Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none"
                        href="mailto:info@company.com">panamatec@company.com</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">6893-3456</a>
                </div>
                <div>
                    <a class="text-light" href="https://fb.com/templatemo" target="_blank" rel="sponsored"><i
                            class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.instagram.com/" target="_blank"><i
                            class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://twitter.com/" target="_blank"><i
                            class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.linkedin.com/" target="_blank"><i
                            class="fab fa-linkedin fa-sm fa-fw"></i></a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Cierre del Top Nav -->


    <header>
        <!-- Encabezado -->
        <!-- lugar del navbar -->
        <nav class="navbar navbar-expand-lg navbar-light shadow">
            <div class="container d-flex justify-content-between align-items-center">

                <a class="navbar-brand text-success logo h1 align-self-center">
                    Panamatec
                </a>

                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between"
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
                        <a class="nav-icon position-relative text-decoration-none" href="#">
                            <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                            <span
                                class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">7</span>
                        </a>
                        <a class="nav-icon position-relative text-decoration-none" href="#">
                            <i class="fa fa-fw fa-user text-dark mr-3"></i>
                            <span
                                class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">+99</span>
                        </a>
                    </div>
                </div>

            </div>
        </nav>
        <!-- Final del navbar -->
        <!-- Final del encabezado -->
    </header>

    <!-- Modal --> <!-- ESTE MODAL SIRVE PARA LA BUSQUEDA DE UN ARTICULO -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Buscar ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Close Modal -->

    <!-- Inicio del Banner de portada -->
    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="./assets/img/graficaportada.png" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left align-self-center">
                                <h1 class="h1 text-success"><b>GeForce® RTX 2060 SUPER™ </b> GAMING OC 8G</h1>
                                <h3 class="h2">Perfecta y comoda para el gaming</h3>
                                <p style="text-align: justify;">
                                    Características
                                    Desarrollado por GeForce® RTX 2060 SUPER™
                                    Integrado con 8 GB de memoria GDDR6 de 256 bits Interfaz de
                                    sistema de enfriamiento WINDFORCE 3X con ventiladores de giro alternativo
                                    4 tubos de calor de cobre GPU de contacto directo
                                    RGB Fusion 2.0: sincroniza con otros dispositivos AORUS
                                    Placa posterior de meta.
                                    Para saber mas información acerda de RTX 2060 entrar a <a rel="sponsored"
                                        class="text-success"
                                        href="https://www.gigabyte.com/es/Graphics-Card/GV-N206SGAMING-OC-8GC#kf"
                                        target="_blank">GIGABYTE RTX 2060.</a>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="./assets/img/procesadorportada.png" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                            <h1 class="h1 text-success"><b>AMD Ryzen™ </b> 5 8500G</h1>
                                <h3 class="h2">El AMD Ryzen™ 5 8500G es el mejor procesador para computadoras de
                                    escritorio todo en uno con tarjeta gráfica AMD Radeon™ 740M.</h3>
                                <p>
                                    Núcleos/Hilos: 6 núcleos (2 Zen 4 + 4 Zen 4c) / 12 hilos<br>
                                    Frecuencia: Hasta 5.0 GHz (Zen 4)<br>
                                    Memoria: DDR5-5200 MHz (máx. 256 GB, dual channel)<br>
                                    Gráficos Integrados: AMD Radeon™ 740M (4 CUs, 2.8 GHz)<br>
                                    Socket: AM5<br>

                                <p style="text-align: justify;">
                                    para juegos, multitarea y creación de contenido sin necesidad de una GPU
                                    dedicada, para saber mas acerca de este procesador entrar a <a rel="sponsored"
                                        class="text-success"
                                        href="https://www.amd.com/es/products/processors/desktops/ryzen/8000-series/amd-ryzen-5-8500g.html#product-specs"
                                        target="_blank">AMD Ryzen™ 5 8500G.</a>
                                </p>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="./assets/img/madreportada.png" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                            <h1 class="h1 text-success"><b>TUF Z370-PLUS </b> 5 8500G</h1>
                                <p>
                                    TUF la tarjeta madre para juegos están construidas para sobrevivir y prosperar en
                                    cada campo de batalla. TUF Z370-Plus Gaming es el fundamento perfecto para su
                                    plataforma de batalla ATX: una fuerza sólida, duradera y camuflada que es apta para
                                    las peleas del día al día, y con la durabilidad para manejar múltiples
                                    actualizaciones para las campañas de mañana.

                                <p style="text-align: justify;">
                                    para saber mas acerca de esta tarjeta madre entrar a
                                    <a rel="sponsored" class="text-success"
                                        href="https://www.amd.com/es/products/processors/desktops/ryzen/8000-series/amd-ryzen-5-8500g.html#product-specs"
                                        target="_blank">TUF Z370-PLUS GAMING.</a>
                                </p>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel"
            role="button" data-bs-slide="prev">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel"
            role="button" data-bs-slide="next">
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
    <!-- Final del Banner de portada -->

    <!-- Inicio de producto favorito -->
    <section class="bg-light">
        <div class="container py-5">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Productos destacados</h1>
                    <p>
                        Productos favorito de nuestros clientes. ¿Te animas a probarlos?
                    </p>
                </div>
            </div>
            <div class="row">

                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="./assets/img/graficadestacado.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li class="text-right">$199.99</li>
                            </ul>
                            <a><strong>ASUS GTX 1650 4GB GDDR5</strong></a>
                            <p class="card-text">
                                Aspectos Destacados
                                <li>
                                    Marca Chipset: NVIDIA
                                </li>
                                <li>
                                    Marca: ASUS
                                </li>
                                <li>
                                    Tamaño de gráficos de RAM: 4 GB
                                </li>

                            </p>

                            <p style="text-align: center;">
                                <a class=text-success href="tienda.php">
                                    VER EN LA TIENDA
                                </a>
                            </p>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="./assets/img/ramdestacado.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li class="text-right">$39.99</li>
                            </ul>
                            <a><strong>Corsair Vengeance LPX</strong></a>
                            <p class="card-text">
                                Aspectos Destacados
                                <li>
                                    32GB RAM
                                </li>
                                <li>
                                    Velocidad de 3200MHz
                                </li>
                                <li>
                                    DDR4
                                </li>

                            </p>

                            <p style="text-align: center;">
                                <a class=text-success href="tienda.php">
                                    VER EN LA TIENDA
                                </a>
                            </p>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="https://hpstorecuador.com/cdn/shop/files/HP_240_G74_grande.jpg?v=1726169254" class="card-img-top" alt="...">
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li class="text-right">$299.99</li>
                            </ul>
                            <a><strong>Laptop Hp Probook 450 G10</strgon></a>
                            <p class="card-text">
                                Aspectos Destacados
                                <li>
                                    Pantalla HD 15.6 pulgadas
                                </li>
                                <li>
                                    Intel core i5-1335U
                                </li>
                                <li>
                                    8GB RAM
                                </li>

                            </p>

                            <p style="text-align: center;">
                                <a class=text-success href="tienda.php">
                                    VER EN LA TIENDA
                                </a>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Final del producto favorito -->

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
                            <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i
                                    class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank"
                                href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i
                                    class="fab fa-twitter fa-lg fa-fw"></i></a>
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
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Final del footer -->

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>