<?php
session_start();
include '../_conexionMySQL.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM evaluaciones WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $id_estudiante = $_POST['id_estudiante'];
    $grado = $_POST['grado'];
    $division = $_POST['division'];
    $total_puntos = $_POST['total_puntos'];
    $fecha = $_POST['fecha'];

    $sql = "UPDATE evaluaciones SET nombre = ?, apellido = ?, id_estudiante = ?, grado = ?, division = ?, total_puntos = ?, fecha = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisssii", $nombre, $apellido, $id_estudiante, $grado, $division, $total_puntos, $fecha, $id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Registro actualizado exitosamente.";
        header("Location: listado.php");
        exit();
    } else {
        $_SESSION['message'] = "Error al actualizar el registro.";
    }
    $stmt->close();
    $conn->close();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Evaluación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Editar Evaluación</h1>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-info">
                <?= $_SESSION['message'] ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        <form action="editar.php?id=<?php echo $id; ?>" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($row['nombre']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo htmlspecialchars($row['apellido']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="id_estudiante" class="form-label">ID Estudiante</label>
                <input type="text" class="form-control" id="id_estudiante" name="id_estudiante" value="<?php echo htmlspecialchars($row['id_estudiante']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="grado" class="form-label">Grado</label>
                <input type="text" class="form-control" id="grado" name="grado" value="<?php echo htmlspecialchars($row['grado']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="division" class="form-label">División</label>
                <input type="text" class="form-control" id="division" name="division" value="<?php echo htmlspecialchars($row['division']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="total_puntos" class="form-label">Total Puntos</label>
                <input type="text" class="form-control" id="total_puntos" name="total_puntos" value="<?php echo htmlspecialchars($row['total_puntos']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo htmlspecialchars($row['fecha']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>