<?php
// Establecer conexión con el servidor
$conn = new mysqli("localhost","root","","cvd_database");
// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>