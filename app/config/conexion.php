<?php 

$host = "localhost";
$user = "root";
$password = "";
$database = "transformetal";

// Inicializar conexión MySQLi con opciones
$connect = mysqli_init();
mysqli_options($connect, MYSQLI_OPT_CONNECT_TIMEOUT, 60); // Tiempo de espera de 60 segundos

// Intentar conectar
if (!mysqli_real_connect($connect, $host, $user, $password, $database)) {
    die("Error de conexión: " . mysqli_connect_error());
}

echo "<script>console.log('Conexión exitosa');</script>";

// Verificar si la conexión sigue activa antes de ejecutar consultas
if (!mysqli_ping($connect)) {
    die("Error: La conexión con MySQL se ha perdido.");
}

?>
