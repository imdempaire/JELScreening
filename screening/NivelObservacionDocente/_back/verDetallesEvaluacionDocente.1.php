<?php
session_start();
include '../_conexionMySQL.php'; // Asegúrate de que este archivo contiene la conexión a la base de datos

$GLOBALS['titulo'] = "Detalles de Evaluación Docente";
include '../_header.php';

// Obtener el id_evaluacion de la solicitud GET
$id_evaluacion = isset($_GET['id_evaluacion']) ? $_GET['id_evaluacion'] : null;

if ($id_evaluacion) {
    // Consulta para obtener los detalles de la evaluación
    $sql = "SELECT * FROM docentes_resultados_evaluacion WHERE id_evaluacion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_evaluacion);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $_SESSION['message'] = "No se ha proporcionado un ID de evaluación.";
    header("Location: verEvaluacionDocente.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Evaluación Docente</title>
    <link rel="stylesheet" type="text/css" href="/screening/css/styles.css?2">
    <link rel="stylesheet" type="text/css" href="/screening/css/stylesListado.css?2">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>Detalles de la Evaluación</h1>
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
                    <th>ID Criterio</th>
                    <th>Resultado</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id_criterio']); ?></td>
                            <td><?php echo htmlspecialchars($row['resultado']); ?></td>
                            <td><?php echo htmlspecialchars($row['observaciones']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No hay detalles registrados para esta evaluación.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <br><?php include '../_footer.php';?>
</body>
</html>