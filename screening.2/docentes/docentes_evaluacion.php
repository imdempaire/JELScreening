<?php  session_start(); // Iniciar la sesión
include '../_conexionMySQL.php'; // Incluir la conexión a la base de datos

$GLOBALS['titulo'] = "Observacion de Docentes";
include '../_header.php'; // Incluir el header

$id_colegio = $_SESSION['id_colegio']; // Obtener el id_colegio de la sesión

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_docente = $_POST['id_docente'];
    $evaluador = $_POST['evaluador'];
    $fecha = date('Y-m-d'); // Obtener la fecha actual

    // Insertar la nueva evaluación en la tabla evaluaciones
    $sql = "INSERT INTO docentes_evaluaciones (id_docente, evaluador, fecha) VALUES ('$id_docente', '$evaluador', '$fecha')";
    
    if ($conn->query($sql) === TRUE) {
        // Obtener el ID de la evaluación recién creada
        $id_evaluacion = $conn->insert_id;

        
        // Verificar si la clave "criterios" existe en $_POST antes de proceder
        if (isset($_POST['criterios']) && is_array($_POST['criterios'])) {
        
            // Ahora insertamos los resultados de los criterios
            foreach ($_POST['criterios'] as $id_criterio => $resultado) {
                // Insertar cada criterio evaluado en la tabla resultados_evaluacion
                $observacion = $_POST['observaciones'][$id_criterio]; // Obtener las observaciones si existen
                $sql_resultado = "INSERT INTO docentes_resultados_evaluacion (id_evaluacion, id_criterio, resultado, observaciones)
                                VALUES ('$id_evaluacion', '$id_criterio', '$resultado', '$observacion')";
                $conn->query($sql_resultado); // Ejecutar el query
            }
            echo "Evaluación registrada exitosamente.";
        } else {
            // echo "Error: " . $sql . "<br>" . $conn->error;
            
        }
    }
}
?>

<!-- HTML para el formulario de evaluación -->

<!DOCTYPE html>
<html>
<head>
    <title>Evaluación de Docentes</title>
    <link rel="stylesheet" type="text/css" href="docentes_styles.css">

    <link rel="stylesheet" href="styles.css?v1">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/screening/css/listado.css">
    <script src="https://kit.fontawesome.com/e1d55cc160.js" crossorigin="anonymous"></script>

</head>

<body>

<div class="container">
    <h1>Formulario de Evaluación</h1>
    
    <!-- Aquí comienza el código PHP -->
    <h3>Criterios de Evaluación:</h3>
    <?php

    // Consultar los criterios desde la base de datos, ordenados por bloque y luego por categoría
    $sql_criterios = "SELECT id, bloque, categoria, descripcion FROM docentes_criterios ORDER BY bloque, categoria";
    $result_criterios = $conn->query($sql_criterios);

    $ultimo_bloque = '';   // Variable para almacenar el último bloque mostrado
    $ultima_categoria = ''; // Variable para almacenar la última categoría mostrada
    $bloque_id = 0;        // Contador para asignar IDs únicos a cada bloque

    // Mostrar cada criterio agrupado por bloque y luego por categoría
    while ($row = $result_criterios->fetch_assoc()) {
        // Verificar si el bloque ha cambiado
        if ($ultimo_bloque != $row['bloque']) {
            // Si ha cambiado, mostrar el nuevo bloque
            if ($ultimo_bloque != '') {
                // Cerrar el contenedor del bloque anterior
                echo "</div>";
            }

            $bloque_id++; // Incrementar el contador de bloque
            // Mostrar el nuevo bloque
            echo "<h3 class='bloque-titulo' onclick='toggleBloque($bloque_id)'>" . $row['bloque'] . "</h3>";
            echo "<div id='bloque-$bloque_id' class='bloque-contenido'>"; // Contenedor que se ocultará/mostrará
            $ultimo_bloque = $row['bloque']; // Actualizar el bloque actual
            $ultima_categoria = ''; // Reiniciar la categoría
        }

        // Verificar si la categoría ha cambiado dentro del bloque
        if ($ultima_categoria != $row['categoria']) {
            // Si ha cambiado, mostrar la nueva categoría
            echo "<div class='categoria'>";
            echo "<h4>" . $row['categoria'] . "</h4>";
            $ultima_categoria = $row['categoria']; // Actualizar la categoría actual
        }

        // Mostrar los criterios dentro de la categoría
        echo "<div class='fila-criterio'>";
        
        // Columna para el nombre y descripción del criterio
        echo "<div class='columna-descripcion'>";
        echo "<p>" . $row['descripcion'] . "</p>";
        echo "</div>";

        // Columna para las opciones de Sí/No
        echo "<div class='columna-respuesta'>";
        echo "<label><input type='radio' name='criterios[" . $row['id'] . "]' value='1'> Sí</label>";
        echo "<label><input type='radio' name='criterios[" . $row['id'] . "]' value='0'> No</label>";
        echo "</div>";

        // Columna para las observaciones
        echo "<div class='columna-observaciones'>";
        echo "<textarea name='observaciones[" . $row['id'] . "]' placeholder='Observaciones'></textarea>";
        echo "</div>";
        
        echo "</div>"; // Cerrar la fila del criterio
    }

    // Cerrar el último contenedor del bloque
    if ($ultimo_bloque != '') {
        echo "</div>";
    }
    ?>
</div>

<!-- Incluir el script para mostrar/ocultar los bloques -->
<script src="scripts.js"></script>

</body>
</html>