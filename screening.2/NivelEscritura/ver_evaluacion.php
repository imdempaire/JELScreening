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

        <h2><center>Puntuaciones Detalladas y Recomendaciones</center></h2>
        <ul>
            <li><strong>Tipografía:</strong> <?php echo $descripciones['tipografia'][$evaluacion['tipografia']]; ?><br>
                &nbsp;&nbsp;<u>Recomendación</u>:&nbsp;<em><?php echo $recomendaciones['tipografia'][$evaluacion['tipografia']]; ?></em>
            </li><br>
            <li><strong>Claridad:</strong> <?php echo $descripciones['claridad'][$evaluacion['claridad']]; ?><br>
                &nbsp;&nbsp;<u>Recomendación</u>:&nbsp;<em><?php echo $recomendaciones['claridad'][$evaluacion['claridad']]; ?></em>
            </li><br>
            <li><strong>Tamaño:</strong> <?php echo $descripciones['tamaño'][$evaluacion['tamano']]; ?><br>
                &nbsp;&nbsp;<u>Recomendación</u>:&nbsp;<em><?php echo $recomendaciones['tamaño'][$evaluacion['tamano']]; ?></em>
            </li><br>
            <li><strong>Presión:</strong> <?php echo $descripciones['presion'][$evaluacion['presion']]; ?><br>
                &nbsp;&nbsp;<u>Recomendación</u>:&nbsp;<em><?php echo $recomendaciones['presion'][$evaluacion['presion']]; ?></em>
            </li><br>
            <li><strong>Emplazamiento en el Renglón:</strong> <?php echo $descripciones['emplazamiento_renglon'][$evaluacion['emplazamiento_renglon']]; ?><br>
                &nbsp;&nbsp;<u>Recomendación</u>:&nbsp;<em><?php echo $recomendaciones['emplazamiento_renglon'][$evaluacion['emplazamiento_renglon']]; ?></em>
            </li><br>
            <li><strong>Repeticiones:</strong> <?php echo $descripciones['repeticiones'][$evaluacion['repeticiones']]; ?><br>
                &nbsp;&nbsp;<u>Recomendación</u>:&nbsp;<em><?php echo $recomendaciones['repeticiones'][$evaluacion['repeticiones']]; ?></em>
            </li><br>
            <li><strong>Vocabulario:</strong> <?php echo $descripciones['vocabulario'][$evaluacion['vocabulario']]; ?><br>
                &nbsp;&nbsp;<u>Recomendación</u>:&nbsp;<em><?php echo $recomendaciones['vocabulario'][$evaluacion['vocabulario']]; ?></em>
            </li><br>
            <li><strong>Conectores:</strong> <?php echo $descripciones['conectores'][$evaluacion['conectores']]; ?><br>
                &nbsp;&nbsp;<u>Recomendación</u>:&nbsp;<em><?php echo $recomendaciones['conectores'][$evaluacion['conectores']]; ?></em>
            </li><br>
            <li><strong>Longitud:</strong> <?php echo $descripciones['longitud'][$evaluacion['longitud']]; ?><br>
                &nbsp;&nbsp;<u>Recomendación</u>:&nbsp;<em><?php echo $recomendaciones['longitud'][$evaluacion['longitud']]; ?></em>
            </li><br>
            <li><strong>Puntuación:</strong> <?php echo $descripciones['puntuacion'][$evaluacion['puntuacion']]; ?><br>
                &nbsp;&nbsp;<u>Recomendación</u>:&nbsp;<em><?php echo $recomendaciones['puntuacion'][$evaluacion['puntuacion']]; ?></em>
            </li><br>
            <li><strong>Uso de la Mayúscula:</strong> <?php echo $descripciones['uso_mayuscula'][$evaluacion['uso_mayuscula']]; ?><br>
                &nbsp;&nbsp;<u>Recomendación</u>:&nbsp;<em><?php echo $recomendaciones['uso_mayuscula'][$evaluacion['uso_mayuscula']]; ?></em>
            </li><br>
            <li><strong>Correspondencia Fonológica:</strong> <?php echo $descripciones['correspondencia_fonologica'][$evaluacion['correspondencia_fonologica']]; ?><br>
                &nbsp;&nbsp;<u>Recomendación</u>:&nbsp;<em><?php echo $recomendaciones['correspondencia_fonologica'][$evaluacion['correspondencia_fonologica']]; ?></em>
            </li><br>
            <li><strong>Correspondencia Ortográfica:</strong> <?php echo $descripciones['correspondencia_ortografica'][$evaluacion['correspondencia_ortografica']]; ?><br>
                &nbsp;&nbsp;<u>Recomendación</u>:&nbsp;<em><?php echo $recomendaciones['correspondencia_ortografica'][$evaluacion['correspondencia_ortografica']]; ?></em>
            </li><br>
        </ul><br>
        <h2><center>Ejercicios recomendados</center></h2>
        <ul>
            <li><strong>Tipografía:</strong>                    &nbsp;<em><?php echo $ejercicios['tipografia'][$evaluacion['tipografia']]; ?>                       </em></li><br>
            <li><strong>Claridad:</strong>                      &nbsp;<em><?php echo $ejercicios['claridad'][$evaluacion['claridad']]; ?>                           </em></li><br>
            <li><strong>Tamaño:</strong>                        &nbsp;<em><?php echo $ejercicios['tamaño'][$evaluacion['tamano']]; ?>                               </em></li><br>
            <li><strong>Presión:</strong>                       &nbsp;<em><?php echo $ejercicios['presion'][$evaluacion['presion']]; ?>                             </em></li><br>
            <li><strong>Emplazamiento en el Renglón:</strong>   &nbsp;<em><?php echo $ejercicios['emplazamiento_renglon'][$evaluacion['emplazamiento_renglon']]; ?> </em></li><br>
            <li><strong>Repeticiones:</strong>                  &nbsp;<em><?php echo $ejercicios['repeticiones'][$evaluacion['repeticiones']]; ?>                                 </em></li><br>
            <li><strong>Vocabulario:</strong>                   &nbsp;<em><?php echo $ejercicios['vocabulario'][$evaluacion['vocabulario']]; ?>                                   </em></li><br>
            <li><strong>Conectores:</strong>                    &nbsp;<em><?php echo $ejercicios['conectores'][$evaluacion['conectores']]; ?>                                     </em></li><br>
            <li><strong>Longitud:</strong>                      &nbsp;<em><?php echo $ejercicios['longitud'][$evaluacion['longitud']]; ?>                                         </em></li><br>
            <li><strong>Puntuación:</strong>                    &nbsp;<em><?php echo $ejercicios['puntuacion'][$evaluacion['puntuacion']]; ?>                                     </em></li><br>
            <li><strong>Uso de la Mayúscula:</strong>           &nbsp;<em><?php echo $ejercicios['uso_mayuscula'][$evaluacion['uso_mayuscula']]; ?>                               </em></li><br>
            <li><strong>Correspondencia Fonológica:</strong>    &nbsp;<em><?php echo $ejercicios['correspondencia_fonologica'][$evaluacion['correspondencia_fonologica']]; ?>     </em></li><br>
            <li><strong>Correspondencia Ortográfica:</strong>   &nbsp;<em><?php echo $ejercicios['correspondencia_ortografica'][$evaluacion['correspondencia_ortografica']]; ?>   </em></li><br>
        </ul>

        <p><strong>Total de Puntos:</strong> <?php echo htmlspecialchars($evaluacion['total_puntos']); ?></p>
        <p><strong>Observaciones:</strong> <?php echo htmlspecialchars($evaluacion['observaciones']); ?></p>
        <p><strong>Fecha:</strong> <?php echo htmlspecialchars($evaluacion['fecha']); ?></p>

        <?php
            $upload_dir = 'uploads/';   // Directorio donde se guardan los archivos subidos
            $file_path = $upload_dir . $evaluacion['archivo'];  // Ruta del archivo subido
            if (file_exists($file_path)) {
                echo '<p><strong>Archivo Subido:</strong> <a href="' . $file_path . '" target="_blank">' . $evaluacion['archivo'] . '</a></p>';
        
                // Mostrar la imagen subida
        ?>        
                <img src="<?php echo htmlspecialchars($file_path); ?>" alt="Archivo Subido" style="max-width: 800px; max-height: 800px;">
        <?php
            }
        ?>

    </div>
    <button onclick="window.location.href='/screening/NivelEscritura/Informes/ListadoResumido.php'">Volver al Listado</button>
</body>
</html>