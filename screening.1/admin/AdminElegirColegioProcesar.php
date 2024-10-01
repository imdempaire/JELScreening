<?php session_start(); // Inicia la sesión

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Guarda la opción elegida en una variable de $_SESSION
    $_SESSION['colegio'] = $_POST['colegio'];
    
    // Esto lo hago para que ande el listado de Nivel Escritura
    // $_SESSION["Nombre"] = $_POST['colegio'];
    
    // Redirige a la página principal (index.php)
    header("Location: /screening/index.php");
    exit();
}
?>
