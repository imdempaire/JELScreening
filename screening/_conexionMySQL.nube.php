<?php

// Conexión a la base de datos
// $servername = "localhost"; $username = "root"; $password = ""; $dbname = "test_db";
$servername = "jelaprendizajecom.netfirmsmysql.com"; $username = "nacho"; $password = "nacho2024"; $dbname = "jeldata_24";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);
// $conexion = new mysqli($servername, $username, $password, $dbname); // loginJel.php lo llama

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

?>