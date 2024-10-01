<?php
    session_start(); // Iniciar la sesión
    include '../_conexionMySQL.php'; // Incluir la conexión a la base de datos

// Verificar si se ha enviado un ID de docente a través de GET
if (isset($_GET['id_docente'])) {
    $id_docente = $_GET['id_docente'];

    // Consultar los datos del docente seleccionado
    $sql = "SELECT * FROM docentes WHERE id = $id_docente";
    $result = $conn->query($sql);

    // Verificar si se encontró el docente
    if ($result->num_rows > 0) {
        $docente = $result->fetch_assoc(); // Obtener los datos del docente
    } else {
        echo "Docente no encontrado.";
        exit();
    }
}

// Verificar si el formulario ha sido enviado con el método POST para actualizar el docente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_docente = $_POST['id_docente'];
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $materia = trim($_POST['materia']);

    // Verificar que los campos no estén vacíos
    if (!empty($nombre) && !empty($apellido) && !empty($materia)) {
        // Actualizar los datos del docente en la base de datos
        $sql_update = "UPDATE docentes SET nombre='$nombre', apellido='$apellido', materia='$materia' WHERE id=$id_docente";
        
        if ($conn->query($sql_update) === TRUE) {
            echo "<div class='success'>Docente actualizado exitosamente.</div>";
        } else {
            echo "<div class='error'>Error actualizando docente: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='error'>Por favor, complete todos los campos.</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modificar Docente</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="container">
    <h1>Seleccionar Docente para Modificar</h1>

    <!-- Formulario para seleccionar el docente -->
    <form method="get" action="modificar_docente.php">
        <label for="docente">Docente:</label>
        <select name="id_docente" required>
            <?php
            // Consultar los docentes
            $sql = "SELECT id, nombre, apellido FROM docentes";
            $result = $conn->query($sql);

            // Mostrar los docentes en el dropdown
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . " " . $row['apellido'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Modificar Docente">
    </form>

    <!-- Formulario para modificar los datos del docente -->
    <?php if (isset($docente)): ?>
    <h2>Modificar Datos del Docente</h2>
    <form method="post" action="modificar_docente.php">
        <!-- ID oculto del docente -->
        <input type="hidden" name="id_docente" value="<?php echo $docente['id']; ?>">

        <!-- Campos para modificar los datos del docente -->
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $docente['nombre']; ?>" required><br>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" value="<?php echo $docente['apellido']; ?>" required><br>

        <label for="materia">Materia:</label>
        <input type="text" name="materia" value="<?php echo $docente['materia']; ?>" required><br>

        <!-- Botón para enviar el formulario -->
        <input type="submit" value="Guardar Cambios">
    </form>
    <?php endif; ?>
</div>
</body>
</html>