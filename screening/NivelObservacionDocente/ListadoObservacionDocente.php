<<?php
session_start();
include '../_conexionMySQL.php'; // Asegúrate de que este archivo contiene la conexión a la base de datos

// Obtener el nombre del colegio de la sesión
// Deberia ser Colegio, no nombre! Corregir en algun momento.
// $nombre_colegio = $_SESSION["Nombre"];
$id_colegio = $_SESSION["id_colegio"];
if ($_SESSION['Nombre'] == "Admin") {
    $nombre_colegio = $_SESSION['colegio'];
} else {
    $nombre_colegio = $_SESSION["Nombre"];
}

$GLOBALS['titulo'] = "Listado de Observación de Docentes";
include '../_header.php';

// Consultar la base de datos para obtener los docentes
// $sql = "SELECT * FROM docentes_evaluaciones WHERE id_colegio = '$id_colegio'";

// Consulta para obtener las evaluaciones de los docentes junto con sus nombres y apellidos
$sql = "SELECT de.id, d.nombre, d.apellido, de.id_colegio, de.evaluador, de.titulo, de.fecha 
        FROM docentes_evaluaciones de
        JOIN docentes d ON de.id_docente = d.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Observación de Docentes</title>
    <link rel="stylesheet" type="text/css" href="/screening/css/styles.css?2">
    <link rel="stylesheet" type="text/css" href="/screening/css/stylesListado.css?2">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>Listado de Observación de Docentes</h1>
    </div>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info">
            <?= $_SESSION['message'] ?>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>ID Colegio</th>
                    <th>Evaluador</th>
                    <th>Titulo de la evaluacion</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($row['apellido']); ?></td>
                            <td><?php echo htmlspecialchars($row['id_colegio']); ?></td>
                            <td><?php echo htmlspecialchars($row['evaluador']); ?></td>
                            <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                            <td>
                                <a href="verDetallesEvaluacionDocente.php?id_evaluacion=<?php echo $row['id']; ?>" class="btn btn-info">VER</a>
                            </td>
                            <td>
                                <a href="imprimirDetallesEvaluacionDocente.php?id_evaluacion=<?php echo $row['id']; ?>" class="btn btn-info">IMPRIMIR</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No hay evaluaciones registradas para este docente.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <br><?php include '../_footer.php';?>
</body>
</html>