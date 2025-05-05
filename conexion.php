<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "panamatec"; // Cambia esto si tu base de datos tiene otro nombre

$conexion = mysqli_connect($host, $user, $pass, $dbname);

if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}
?>


