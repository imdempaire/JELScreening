<?php
    session_start();
    include '../_conexionMySQL.php';
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener datos del formulario
    if ($_SESSION["Nombre"] == "Admin")
        {
            $colegio = $_SESSION['colegio'];
        }
    else {
            $colegio = $_SESSION["Nombre"];
        } 
        
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $id_estudiante = $_POST['student_id'];
    $grado = $_POST['grado'];
    $division = $_POST['division'];
    $observaciones = $_POST['observaciones'];

    // Incluir los archivos de descripciones, recomendaciones y ejercicios
    include '1-mapearvalores.php';
    include '2-recomendaciones.php';
    include '3-ejercicios.php';

    // Manejo de archivo subido
    $upload_dir = 'uploads/';
    $file_uploaded = false;
    $file_name = '';
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif']; // Tipos permitidos

    if (isset($_FILES['evaluation_file']) && $_FILES['evaluation_file']['error'] == UPLOAD_ERR_OK) {
        $file_type = mime_content_type($_FILES['evaluation_file']['tmp_name']);
        
        if (in_array($file_type, $allowed_types)) {
            $file_name = basename($_FILES['evaluation_file']['name']);
            $file_path = $upload_dir . $file_name;
            if (move_uploaded_file($_FILES['evaluation_file']['tmp_name'], $file_path)) {
                $file_uploaded = true;
            } else {
                $message = "Error al subir el archivo.";
            }
        } else {
            $message = "El archivo no es un tipo de imagen permitido.";
        }
    }

    // Obtener puntuaciones de cada criterio
    $tipografia = isset($_POST['typography']) ? (int)$_POST['typography'] : 0;
    $claridad = isset($_POST['clarity']) ? (int)$_POST['clarity'] : 0;
    $tamaño = isset($_POST['size']) ? (int)$_POST['size'] : 0;
    $presion = isset($_POST['pressure']) ? (int)$_POST['pressure'] : 0;
    $emplazamiento_renglon = isset($_POST['line_placement']) ? (int)$_POST['line_placement'] : 0;
    $repeticiones = isset($_POST['repetitions']) ? (int)$_POST['repetitions'] : 0;
    $vocabulario = isset($_POST['vocabulary']) ? (int)$_POST['vocabulary'] : 0;
    $conectores = isset($_POST['connectors']) ? (int)$_POST['connectors'] : 0;
    $longitud = isset($_POST['length']) ? (int)$_POST['length'] : 0;
    $puntuacion = isset($_POST['punctuation']) ? (int)$_POST['punctuation'] : 0;
    $uso_mayuscula = isset($_POST['capitalization']) ? (int)$_POST['capitalization'] : 0;
    $correspondencia_fonologica = isset($_POST['phonological_correspondence']) ? (int)$_POST['phonological_correspondence'] : 0;
    $correspondencia_ortografica = isset($_POST['orthographic_correspondence']) ? (int)$_POST['orthographic_correspondence'] : 0;

    // Sumar todas las puntuaciones
    $total_puntos = $tipografia + $claridad + $tamaño + $presion + $emplazamiento_renglon +
                    $repeticiones + $vocabulario + $conectores + $longitud + $puntuacion +
                    $uso_mayuscula + $correspondencia_fonologica + $correspondencia_ortografica;

    // Insertar en la base de datos
    $sql = "INSERT INTO evaluaciones (
                colegio, nombre, apellido, id_estudiante, grado, tipografia, claridad, tamano, presion,
                emplazamiento_renglon, repeticiones, vocabulario, conectores, longitud,
                puntuacion, uso_mayuscula, correspondencia_fonologica,
                correspondencia_ortografica, total_puntos, archivo, division, observaciones
            ) VALUES (
                '$colegio', '$nombre', '$apellido', '$id_estudiante', '$grado', $tipografia, $claridad, $tamaño, $presion,
                $emplazamiento_renglon, $repeticiones, $vocabulario, $conectores, $longitud,
                $puntuacion, $uso_mayuscula, $correspondencia_fonologica,
                $correspondencia_ortografica, $total_puntos, '$file_name', '$division', '$observaciones'
            )";

//    if ($conn->query($sql) === TRUE) {
//        $message = "Evaluación guardada exitosamente.";
//        if ($file_uploaded) {
//            $message .= " Archivo subido correctamente.";
//        }
//    } else {
//        $message = "Error: " . $sql . "<br>" . $conn->error;
//    }

    $servername = "localhost"; $username = "root"; $password = ""; $dbname = "jeldata_24";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Establecer el modo de error a excepciones
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $stmt = $conn->query($sql);
        echo "Consulta exitosa";
    
        // No necesitas cerrar la conexión manualmente
        // $conn->close(); // Esto no es necesario en PDO
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

}

    // $conn->close();
    $conn = null; // Esto cerrará la conexión manualmente
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Evaluación</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css?v1">
</head>

<body>

    <?php   $GLOBALS['titulo'] = "Resultado de Evaluacion";
            include '../_header.php';
    ?>

    <h1>Resultado de Evaluación</h1>
    <div class="result-container">
        <!-- <p><?php echo $message; ?></p> -->
        <p><strong>Alumno:</strong> <?php echo htmlspecialchars($nombre . ' ' . $apellido); ?></p>
        <p><strong>ID del Estdiante:</strong> <?php echo htmlspecialchars($id_estudiante); ?></p>
        <p><strong>Grado:</strong> <?php echo htmlspecialchars($grado); ?></p>
        <h2><center>Puntuaciones Detalladas y Recomendaciones</center></h2>
        <ul>
            <li><strong>Tipografía:</strong> <?php echo $descripciones['tipografia'][$tipografia]; ?><br>
                &nbsp;&nbsp;<u>Recomendación</u>:&nbsp;<em><?php echo $recomendaciones['tipografia'][$tipografia]; ?></em>
            </li><br>
            <li><strong>Claridad:</strong> <?php echo $descripciones['claridad'][$claridad]; ?><br>
                &nbsp;&nbsp;<u>Recomendación</u>:&nbsp;<em><?php echo $recomendaciones['claridad'][$claridad]; ?></em>
            </li><br>
            <li><strong>Tamaño:</strong> <?php echo $descripciones['tamaño'][$tamaño]; ?><br>
                &nbsp;&nbsp;<u>Recomendación</u>&nbsp;<em><?php echo $recomendaciones['tamaño'][$tamaño]; ?></em>
            </li><br>
            <li><strong>Presión:</strong> <?php echo $descripciones['presion'][$presion]; ?><br>
                &nbsp;&nbsp;<u>Recomendación</u>&nbsp;<em><?php echo $recomendaciones['presion'][$presion]; ?></em>
            </li><br>
            <li><strong>Emplazamiento en el Renglón:</strong> <?php echo $descripciones['emplazamiento_renglon'][$emplazamiento_renglon]; ?> - <em><?php echo $recomendaciones['emplazamiento_renglon'][$emplazamiento_renglon]; ?></em></li>
            <li><strong>Repeticiones:</strong> <?php echo $descripciones['repeticiones'][$repeticiones]; ?> - <em><?php echo $recomendaciones['repeticiones'][$repeticiones]; ?></em></li>
            <li><strong>Vocabulario:</strong> <?php echo $descripciones['vocabulario'][$vocabulario]; ?> - <em><?php echo $recomendaciones['vocabulario'][$vocabulario]; ?></em></li>
            <li><strong>Conectores:</strong> <?php echo $descripciones['conectores'][$conectores]; ?> - <em><?php echo $recomendaciones['conectores'][$conectores]; ?></em></li>
            <li><strong>Longitud:</strong> <?php echo $descripciones['longitud'][$longitud]; ?> - <em><?php echo $recomendaciones['longitud'][$longitud]; ?></em></li>
            <li><strong>Puntuación:</strong> <?php echo $descripciones['puntuacion'][$puntuacion]; ?> - <em><?php echo $recomendaciones['puntuacion'][$puntuacion]; ?></em></li>
            <li><strong>Uso de la Mayúscula:</strong> <?php echo $descripciones['uso_mayuscula'][$uso_mayuscula]; ?> - <em><?php echo $recomendaciones['uso_mayuscula'][$uso_mayuscula]; ?></em></li>
            <li><strong>Correspondencia Fonológica:</strong> <?php echo $descripciones['correspondencia_fonologica'][$correspondencia_fonologica]; ?> - <em><?php echo $recomendaciones['correspondencia_fonologica'][$correspondencia_fonologica]; ?></em></li>
            <li><strong>Correspondencia Ortográfica:</strong> <?php echo $descripciones['correspondencia_ortografica'][$correspondencia_ortografica]; ?> - <em><?php echo $recomendaciones['correspondencia_ortografica'][$correspondencia_ortografica]; ?></em></li>
        </ul><br>
        <h2><center>Ejercicios recomendados</center></h2>
        <ul>
            <li><strong>Tipografía:</strong>&nbsp;&nbsp;<em><?php echo $ejercicios['tipografia'][$tipografia]; ?>   </em></li><br>
            <li><strong>Claridad:</strong>  &nbsp;&nbsp;<em><?php echo $ejercicios['claridad'][$claridad]; ?>       </em></li><br>
            <li><strong>Tamaño:</strong> <?php echo $descripciones['tamaño'][$tamaño]; ?><br>
                &nbsp;&nbsp;Ejercicios:&nbsp;<em><?php echo $ejercicios['tamaño'][$tamaño]; ?></em>
            </li><br>
            <li><strong>Presión:</strong> <?php echo $descripciones['presion'][$presion]; ?><br>
                &nbsp;&nbsp;Ejercicios:&nbsp;<em><?php echo $ejercicios['presion'][$presion]; ?></em>
            </li><br>
            <li><strong>Emplazamiento en el Renglón:</strong> <?php echo $descripciones['emplazamiento_renglon'][$emplazamiento_renglon]; ?> - <em><?php echo $recomendaciones['emplazamiento_renglon'][$emplazamiento_renglon]; ?></em></li>
            <li><strong>Repeticiones:</strong> <?php echo $descripciones['repeticiones'][$repeticiones]; ?> - <em><?php echo $recomendaciones['repeticiones'][$repeticiones]; ?></em></li>
            <li><strong>Vocabulario:</strong> <?php echo $descripciones['vocabulario'][$vocabulario]; ?> - <em><?php echo $recomendaciones['vocabulario'][$vocabulario]; ?></em></li>
            <li><strong>Conectores:</strong> <?php echo $descripciones['conectores'][$conectores]; ?> - <em><?php echo $recomendaciones['conectores'][$conectores]; ?></em></li>
            <li><strong>Longitud:</strong> <?php echo $descripciones['longitud'][$longitud]; ?> - <em><?php echo $recomendaciones['longitud'][$longitud]; ?></em></li>
            <li><strong>Puntuación:</strong> <?php echo $descripciones['puntuacion'][$puntuacion]; ?> - <em><?php echo $recomendaciones['puntuacion'][$puntuacion]; ?></em></li>
            <li><strong>Uso de la Mayúscula:</strong> <?php echo $descripciones['uso_mayuscula'][$uso_mayuscula]; ?> - <em><?php echo $recomendaciones['uso_mayuscula'][$uso_mayuscula]; ?></em></li>
            <li><strong>Correspondencia Fonológica:</strong> <?php echo $descripciones['correspondencia_fonologica'][$correspondencia_fonologica]; ?> - <em><?php echo $recomendaciones['correspondencia_fonologica'][$correspondencia_fonologica]; ?></em></li>
            <li><strong>Correspondencia Ortográfica:</strong> <?php echo $descripciones['correspondencia_ortografica'][$correspondencia_ortografica]; ?> - <em><?php echo $recomendaciones['correspondencia_ortografica'][$correspondencia_ortografica]; ?></em></li>
        </ul>


        <p><strong>Total de Puntos:</strong> <?php echo $total_puntos; ?></p>
        <p><strong>Observaciones:</strong> <?php echo htmlspecialchars($observaciones); ?></p>
        
        <!-- Mostrar imagen subida -->
        <?php if ($file_uploaded): ?>
            <h2>Archivo Subido:</h2>
            <img src="<?php echo htmlspecialchars($file_path); ?>" alt="Archivo Subido" style="max-width: 800px; max-height: 800px;">
        <?php endif; ?>
    </div>
    <button onclick="window.location.href='index.php'">Realizar Nueva Evaluación</button>
</body>
</html>