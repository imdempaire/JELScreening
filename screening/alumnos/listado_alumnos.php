<?php
session_start();
include '../_conexionMySQL.php';
$GLOBALS['titulo'] = "Plataforma IA de Screening";
include '../_header.php';

// Obtener el id_colegio de la sesión
$id_colegio = $_SESSION['id_colegio'];

// $sql = "SELECT id_estudiante, nombre, apellido FROM alumnos";
// $result = $conn->query($sql);

// Si es Admin, mostrar todos los alumnos
if($_SESSION['id_colegio'] == 'Admin'){

    // Si el Admin ha seleccionado un colegio, mostrar los alumnos de ese colegio
    if (isset($_SESSION['colegio'])) {
        
        // COMPLECTAR ESTE CÓDIGO!!! - Obtener el id_colegio del colegio seleccionado
        

        $sql = "SELECT id_estudiante, id_colegio, nombre, apellido, fecha_nacimiento, sexo FROM alumnos";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

    // Si el Amin no ha seleccionado un colegio, mostrar todos los alumnos
    } else {
        $sql = "SELECT id_estudiante, id_colegio, nombre, apellido, fecha_nacimiento, sexo FROM alumnos";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    }

} else {
    $sql = "SELECT id_estudiante, nombre, apellido, fecha_nacimiento, sexo FROM alumnos WHERE id_colegio = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id_colegio);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Alumnos</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">

    <!-- Enlace a Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="/screening/css/listado.css">
    
</head>
<body>
    <div class="container">
        <h1>Listado de Alumnos</h1>
        <table class="table">
            <thead>
                <tr>
                    <!-- Si el usuario es Admin, mostrar la columna Colegio -->
                    <?php if($_SESSION['id_colegio'] == 'Admin') {echo "<th>Colegio</th>";} ?>
                    <th>ID del Estudiante</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Sexo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <?php if($_SESSION['id_colegio'] == 'Admin') {
                            $sql = "SELECT Colegio FROM usuarios WHERE Usuario = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $row['id_colegio']);
                            $stmt->execute();
                            $result2 = $stmt->get_result();
                            $row2 = $result2->fetch_assoc();
                            echo "<td>" . $row2['Colegio'] . "</td>"; } 
                            ?>

                            <td><?php echo htmlspecialchars($row['id_estudiante']); ?></td>
                            <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($row['apellido']); ?></td>
                            <td><?php echo htmlspecialchars($row['fecha_nacimiento']); ?></td>
                            <td><?php echo htmlspecialchars($row['sexo']); ?></td>
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