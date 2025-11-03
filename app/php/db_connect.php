<?php
// Configuración de conexión a la base de datos
$hostname = "db"; // Cambia según tu configuración
$username = "admin";
$password = "test";
$db = "database";

// Crear la conexión
$conn = mysqli_connect($hostname, $username, $password, $db);

// Verificar la conexión
if (!$conn) {
    die("Konexioak huts egin du: " . mysqli_connect_error());
}
?>