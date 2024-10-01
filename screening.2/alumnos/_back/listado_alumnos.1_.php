<?php
session_start();
include '../_conexionMySQL.php';
$GLOBALS['titulo'] = "Listado de Alumnos";
include '../_header.php';

// Obtener el id_colegio de la sesión
$id_colegio = $_SESSION['id_colegio'];

// Modificar la consulta SQL para filtrar por id_colegio
// $sql = "SELECT id_estudiante, nombre, apellido FROM alumnos";
// $result = $conn->query($sql);

$sql = "SELECT id_estudiante, nombre, apellido FROM alumnos WHERE id_colegio = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id_colegio);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Alumnos</title>

    <link rel="stylesheet" href="styles.css?v1">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">

    <!-- Enlace a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Enlace a Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    

</head>
<body>
    <div class="container">
        <h1>Listado de Alumnos</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID del Estudiante</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id_estudiante']); ?></td>
                            <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($row['apellido']); ?></td>
                            <td>
                                <a href="modificar_alumno.php?id=<?php echo $row['id_estudiante']; ?>" class="btn btn-warning">Modificar</a>
                                <a href="eliminar_alumno.php?id=<?php echo $row['id_estudiante']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este alumno?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No hay alumnos registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>