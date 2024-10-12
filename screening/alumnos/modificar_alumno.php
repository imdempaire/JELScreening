<?php                                   
session_start();                        
include '../_conexionMySQL.php';        
$GLOBALS['titulo'] = "Modificar Alumno";
include '../_header.php';

// Obtener el id_colegio de la sesión
$id_colegio = $_SESSION['id_colegio'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_estudiante = $_POST['id_estudiante'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];

    // $sql = "UPDATE alumnos SET nombre = ?, apellido = ? WHERE id_estudiante = ?";
    $sql = "UPDATE alumnos SET nombre = ?, apellido = ? WHERE id_estudiante = ? AND id_colegio = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $nombre, $apellido, $id_estudiante, $id_colegio);

    if ($stmt->execute()) {
        echo "<p>Alumno modificado exitosamente.</p>";
    } else {
        echo "<p>Error al modificar el alumno: " . $stmt->error . "</p>";
    }

    $stmt->close();
} else {
    $id_estudiante = $_GET['id'];
    $sql = "SELECT id_estudiante, nombre, apellido, grado, division FROM alumnos WHERE id_estudiante = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_estudiante);
    $stmt->execute();
    $stmt->bind_result($id_estudiante, $nombre, $apellido, $grado, $division);
    $stmt->fetch();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Alumno</title>

    <link rel="stylesheet" href="styles.css?v1">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/screening/css/listado.css">

</head>
<body>
    <div class="container">
        <h1>Modificar Alumno</h1>
        <form method="post" action="modificar_alumno.php">
            <!-- <input type="hidden" name="id_estudiante" value="<?php echo htmlspecialchars($id_estudiante); ?>"> -->
            <div class="mb-3">
                <label for="id_estudiante" class="form-label">ID del Estudiante</label>
                <input type="text" class="form-control" id="id_estudiante" name="id_estudiante" value="<?php echo htmlspecialchars($id_estudiante); ?>" required>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo htmlspecialchars($apellido); ?>" required>
            </div>
            <div class="mb-3">
                <label for="grado" class="form-label">Grado</label>
                <!-- <input type="text" class="form-control" id="grado" name="grado" value="<?php echo htmlspecialchars($grado); ?>" required> -->
                <select class="form-control" id="grado" name="grado" value="<?php echo htmlspecialchars($grado); ?>" required>
                    <option value="1er grado">1er grado</option>
                    <option value="2do grado">2do grado</option>
                    <option value="3er grado">3er grado</option>
                    <option value="4to grado">4to grado</option>
                    <option value="5to grado">5to grado</option>
                    <option value="6to grado">6to grado</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="division" class="form-label">División</label>
                <input type="text" class="form-control" id="division" name="division" value="<?php echo htmlspecialchars($division); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Modificar</button>
        </form>
    </div>

    <?php include '../_footer.php';?>

</body>
</html>