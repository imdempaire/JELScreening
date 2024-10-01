<?php session_start(); // Inicia la sesión
    include '../_conexionMySQL.php'; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Guarda la opción elegida en una variable de $_SESSION
    $_SESSION['colegio'] = $_POST['colegio'];

    $sql_colegios = "SELECT DISTINCT Usuario FROM colegios WHERE Colegio = ?";
    $stmt = $conn->prepare($sql_colegios);
    $stmt->bind_param("s", $_POST['colegio']);
    $stmt->execute();
    $result_usuario = $stmt->get_result();
    $_SESSION['id_colegio'] = $result_usuario->fetch_assoc()['Usuario'];
    
    // Esto lo hago para que ande el listado de Nivel Escritura
    // $_SESSION["Nombre"] = $_POST['colegio'];
    
    // Redirige a la página principal (index.php)
    header("Location: /screening/index.php");
    exit();
}
?>
