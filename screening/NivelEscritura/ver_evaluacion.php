<?php
    session_start();
    include '../_conexionMySQL.php';

// Obtener el ID de la evaluación desde la URL
$evaluacion_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Consultar la base de datos para obtener los detalles de la evaluación
$sql = "SELECT * FROM evaluaciones WHERE id = $evaluacion_id";
$result = $conn->query($sql);

// Verificar si se encontró la evaluación
if ($result->num_rows > 0) {
    $evaluacion = $result->fetch_assoc();
} else {
    die("Evaluación no encontrada.");
}

    // $conn->close();

    // Incluir los archivos de descripciones, recomendaciones y ejercicios
    include '1-mapearvalores.php';
    include '2-recomendaciones.php';
    include '3-ejercicios.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de la Evaluación</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css?v1">
</head>
<body>

    <?php   $GLOBALS['titulo'] = "Detalle de Evaluacion";
            include '../_header.php';
    ?>

    <h1>Detalle de la Evaluación</h1>
    <div class="result-container">
        <p><strong>Alumno:</strong> <?php echo htmlspecialchars($evaluacion['nombre'] . ' ' . $evaluacion['apellido']); ?></p>
        <p><strong>ID del Estudiante:</strong> <?php echo htmlspecialchars($evaluacion['id_estudiante']); ?></p>
        <p><strong>Grado:</strong> <?php echo htmlspecialchars($evaluacion['grado']); ?></p>
        <h2>Puntuaciones Detalladas y Recomendaciones:</h2>
        <ul>
            <li><strong>Tipografía:</strong> <?php echo $descripciones['tipografia'][$evaluacion['tipografia']]; ?> - <em><?php echo $recomendaciones['tipografia'][$evaluacion['tipografia']]; ?></em></li>
            <li><strong>Claridad:</strong> <?php echo $descripciones['claridad'][$evaluacion['claridad']]; ?> - <em><?php echo $recomendaciones['claridad'][$evaluacion['claridad']]; ?></em></li>
            <li><strong>Tamaño:</strong> <?php echo $descripciones['tamaño'][$evaluacion['tamaño']]; ?> - <em><?php echo $recomendaciones['tamaño'][$evaluacion['tamaño']]; ?></em></li>
            <li><strong>Presión:</strong> <?php echo $descripciones['presion'][$evaluacion['presion']]; ?> - <em><?php echo $recomendaciones['presion'][$evaluacion['presion']]; ?></em></li>
            <li><strong>Emplazamiento en el Renglón:</strong> <?php echo $descripciones['emplazamiento_renglon'][$evaluacion['emplazamiento_renglon']]; ?> - <em><?php echo $recomendaciones['emplazamiento_renglon'][$evaluacion['emplazamiento_renglon']]; ?></em></li>
            <li><strong>Repeticiones:</strong> <?php echo $descripciones['repeticiones'][$evaluacion['repeticiones']]; ?> - <em><?php echo $recomendaciones['repeticiones'][$evaluacion['repeticiones']]; ?></em></li>
            <li><strong>Vocabulario:</strong> <?php echo $descripciones['vocabulario'][$evaluacion['vocabulario']]; ?> - <em><?php echo $recomendaciones['vocabulario'][$evaluacion['vocabulario']]; ?></em></li>
            <li><strong>Conectores:</strong> <?php echo $descripciones['conectores'][$evaluacion['conectores']]; ?> - <em><?php echo $recomendaciones['conectores'][$evaluacion['conectores']]; ?></em></li>
            <li><strong>Longitud:</strong> <?php echo $descripciones['longitud'][$evaluacion['longitud']]; ?> - <em><?php echo $recomendaciones['longitud'][$evaluacion['longitud']]; ?></em></li>
            <li><strong>Puntuación:</strong> <?php echo $descripciones['puntuacion'][$evaluacion['puntuacion']]; ?> - <em><?php echo $recomendaciones['puntuacion'][$evaluacion['puntuacion']]; ?></em></li>
            <li><strong>Uso de la Mayúscula:</strong> <?php echo $descripciones['uso_mayuscula'][$evaluacion['uso_mayuscula']]; ?> - <em><?php echo $recomendaciones['uso_mayuscula'][$evaluacion['uso_mayuscula']]; ?></em></li>
            <li><strong>Correspondencia Fonológica:</strong> <?php echo $descripciones['correspondencia_fonologica'][$evaluacion['correspondencia_fonologica']]; ?> - <em><?php echo $recomendaciones['correspondencia_fonologica'][$evaluacion['correspondencia_fonologica']]; ?></em></li>
            <li><strong>Correspondencia Ortográfica:</strong> <?php echo $descripciones['correspondencia_ortografica'][$evaluacion['correspondencia_ortografica']]; ?> - <em><?php echo $recomendaciones['correspondencia_ortografica'][$evaluacion['correspondencia_ortografica']]; ?></em></li>
        </ul>
        <p><strong>Total de Puntos:</strong> <?php echo htmlspecialchars($evaluacion['total_puntos']); ?></p>
        <p><strong>Observaciones:</strong> <?php echo htmlspecialchars($evaluacion['observaciones']); ?></p>
        <p><strong>Fecha:</strong> <?php echo htmlspecialchars($evaluacion['fecha']); ?></p>
    </div>
    <button onclick="window.location.href='listado.php'">Volver al Listado</button>
</body>
</html>