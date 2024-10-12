<?php session_start(); // Iniciar la sesión
include '../_conexionMySQL.php'; // Incluir la conexión a la base de datos

$GLOBALS['titulo'] = "Plataforma IA de Screening";
include '../_header.php'; // Incluir el header

// Obtener el id_colegio de la sesión
$id_colegio = $_SESSION['id_colegio'];

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $materia = trim($_POST['materia']);

    // Verificar que los campos no estén vacíos
    if (!empty($nombre) && !empty($apellido) && !empty($materia)) {
        // Insertar el nuevo docente en la tabla docentes
        $sql = "INSERT INTO docentes (id_colegio, nombre, apellido, materia) VALUES ('$id_colegio', '$nombre', '$apellido', '$materia')";
        
        if ($conn->query($sql) === TRUE) {
            $success_message = "Docente registrado exitosamente.";
        } else {
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $error_message = "Por favor, complete todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Alta de Docentes</title>
    <link rel="stylesheet" type="text/css" href="docentes_styles.css">

    <link rel="stylesheet" href="styles.css?v1">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/screening/css/listado.css">
    <script src="https://kit.fontawesome.com/e1d55cc160.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <h1>Alta de Docentes</h1>

    <!-- Mostrar mensajes de éxito o error -->
    <?php if(isset($success_message)) { echo "<div class='success'>{$success_message}</div>"; } ?>
    <?php if(isset($error_message)) { echo "<div class='error'>{$error_message}</div>"; } ?>

    <form method="post" action="docentes_alta.php">
        <!-- Campo para el nombre del docente -->
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <!-- Campo para el apellido del docente -->
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" required><br>

        <!-- Campo para la materia del docente -->
        <label for="materia">Materia:</label>
        <input type="text" name="materia" required><br>

        <!-- Botón para enviar el formulario -->
        <!--  <input type="submit" value="Registrar Docente"> -->
        <button type="submit" class="btn btn-primary">Registrar Docente</button>
    </form>
</div>

<?php include '../_footer.php';?>

</body>
</html>