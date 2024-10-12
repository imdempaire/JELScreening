<?php
session_start();
include '../_conexionMySQL.php'; // Asegúrate de que este archivo contiene la conexión a la base de datos

$GLOBALS['titulo'] = "Ver Evaluación Docente";
include '../_header.php';

// Obtener el id_docente de la solicitud GET
$id_docente = isset($_GET['id_docente']) ? $_GET['id_docente'] : null;

if ($id_docente) {
    // Consulta para obtener las evaluaciones del docente
    $sql = "SELECT * FROM docentes_evaluaciones WHERE id_docente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_docente);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $_SESSION['message'] = "No se ha proporcionado un ID de docente.";
    header("Location: ListadoObservacionDocente.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Evaluación Docente</title>
    <link rel="stylesheet" type="text/css" href="/screening/css/styles.css?2">
    <link rel="stylesheet" type="text/css" href="/screening/css/stylesListado.css?2">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>Evaluaciones del Docente</h1>
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
                    <th>ID Evaluación</th>
                    <th>Evaluador</th>
                    <th>Fecha</th>
                    <th>Detalles</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['evaluador']); ?></td>
                            <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                            <td>
                                <a href="verDetallesEvaluacionDocente.php?id_evaluacion=<?php echo $row['id']; ?>" class="btn btn-info">Ver Detalles</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No hay evaluaciones registradas para este docente.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <br><?php include '../_footer.php';?>
</body>
</html>