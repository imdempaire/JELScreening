<?php
session_start();
include '../_conexionMySQL.php'; // Asegúrate de que este archivo contiene la conexión a la base de datos

$GLOBALS['titulo'] = "Oberservación de Docentes";
include '../_header.php';

// Obtener el id_evaluacion de la solicitud GET
$id_evaluacion = isset($_GET['id_evaluacion']) ? $_GET['id_evaluacion'] : null;

if ($id_evaluacion) {
    // Consulta para obtener los datos de la evaluación
    $sql_evaluacion = "SELECT de.id, d.nombre, d.apellido, de.id_colegio, de.evaluador, de.fecha 
                       FROM docentes_evaluaciones de
                       JOIN docentes d ON de.id_docente = d.id
                       WHERE de.id = ?";
    $stmt_evaluacion = $conn->prepare($sql_evaluacion);
    $stmt_evaluacion->bind_param("i", $id_evaluacion);
    $stmt_evaluacion->execute();
    $result_evaluacion = $stmt_evaluacion->get_result();
    $evaluacion = $result_evaluacion->fetch_assoc();

    // Consulta para obtener los detalles de la evaluación junto con bloque y categoría
    $sql_detalles = "SELECT dc.bloque, dc.categoria, dc.descripcion, dre.resultado, dre.observaciones 
                     FROM docentes_resultados_evaluacion dre
                     JOIN docentes_criterios dc ON dre.id_criterio = dc.id
                     WHERE dre.id_evaluacion = ?";
    $stmt_detalles = $conn->prepare($sql_detalles);
    $stmt_detalles->bind_param("i", $id_evaluacion);
    $stmt_detalles->execute();
    $result_detalles = $stmt_detalles->get_result();

    // Organizar los detalles en un array multidimensional
    $detalles = [];
    while ($row = $result_detalles->fetch_assoc()) {
        $detalles[$row['bloque']][$row['categoria']][] = $row;
    }
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
    <title>Detalles de Evaluación Docente para Imprimir</title>
    <link rel="stylesheet" type="text/css" href="/screening/css/styles.css?2">
    <link rel="stylesheet" type="text/css" href="/screening/css/stylesListado.css?2">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .container {
            width: 80%;
            margin: auto;
        }
        .header, .details {
            margin-bottom: 20px;
        }
        .header h1 {
            text-align: center;
        }
        .details h2 {
            margin-top: 20px;
        }
        .details p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Detalles de la Evaluación</h1>
            <p><strong>Docente:</strong> <?php echo htmlspecialchars($evaluacion['nombre'] . ' ' . $evaluacion['apellido']); ?></p>
            <p><strong>ID Colegio:</strong> <?php echo htmlspecialchars($evaluacion['id_colegio']); ?></p>
            <p><strong>Evaluador:</strong> <?php echo htmlspecialchars($evaluacion['evaluador']); ?></p>
            <p><strong>Fecha:</strong> <?php echo htmlspecialchars($evaluacion['fecha']); ?></p>
        </div>

        <div class="details">
            <?php if (!empty($detalles)): ?>
                <?php foreach ($detalles as $bloque => $categorias): ?>
                    <h2><center><?php echo htmlspecialchars($bloque); ?></center></h2>
                    <?php foreach ($categorias as $categoria => $items): ?>
                        <h3><?php echo htmlspecialchars($categoria); ?></h3>
                        <?php foreach ($items as $item): ?>
                            <p><strong>Descripción:</strong> <?php echo htmlspecialchars($item['descripcion']); ?></p>
                            <p><strong>Resultado:</strong> <?php echo htmlspecialchars($item['resultado'] == 1 ? 'Sí' : 'No'); ?></p>
                            <p><strong>Observaciones:</strong> <?php echo htmlspecialchars($item['observaciones']); ?></p>
                            <hr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay detalles registrados para esta evaluación.</p>
            <?php endif; ?>
        </div>
    </div>

    <br><?php include '../_footer.php';?>
</body>
</html>