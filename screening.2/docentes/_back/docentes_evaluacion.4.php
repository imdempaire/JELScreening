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

        <!-- Código PHP para mostrar mensajes de éxito/error -->
        <?php if(isset($success_message)) { echo "<div class='success'>{$success_message}</div>"; } ?>
        <?php if(isset($error_message)) { echo "<div class='error'>{$error_message}</div>"; } ?>

    <form method="post" action="docentes_evaluacion.php">
        <!-- Selección del docente -->
        <label for="docente">Docente:</label>
        <select name="id_docente" required>
            <?php
            // Consultar los docentes disponibles
            $sql_docentes = "SELECT id, nombre, apellido FROM docentes";
            $result = $conn->query($sql_docentes);

            // Mostrar los docentes en el select
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . " " . $row['apellido'] . "</option>";
            }
            ?>
        </select>

        <!-- Nombre del evaluador -->
        <label for="evaluador">Nombre del Evaluador:</label>
        <input type="text" name="evaluador" required>

        <!-- Listado de Criterios -->
        <h3>Criterios de Evaluación:</h3>
        <?php
        // Consultar los criterios desde la base de datos
        $sql_criterios = "SELECT id, categoria, descripcion FROM docentes_criterios ORDER BY categoria";
        $result_criterios = $conn->query($sql_criterios);

        $ultima_categoria = ''; // Variable para almacenar la última categoría mostrada

        // Mostrar cada criterio agrupado por categoría
        while ($row = $result_criterios->fetch_assoc()) {
            // Verificar si la categoría ha cambiado
            if ($ultima_categoria != $row['categoria']) {
                // Si ha cambiado, mostrar la nueva categoría
                if ($ultima_categoria != '') {
                    // Cerrar el div de la categoría anterior, si ya hubo una previa
                    echo "</div>";
                }
                
                // Mostrar la nueva categoría
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
            // echo "<label><input type='radio' name='criterios[" . $row['id'] . "]' value='1' required> Sí</label>";
            // echo "<label><input type='radio' name='criterios[" . $row['id'] . "]' value='0' required> No</label>";
            echo "<label><input type='radio' name='criterios[" . $row['id'] . "]' value='1'> Sí</label>";
            echo "<label><input type='radio' name='criterios[" . $row['id'] . "]' value='0'> No</label>";
            
            echo "</div>";

            // Columna para las observaciones
            echo "<div class='columna-observaciones'>";
            echo "<textarea name='observaciones[" . $row['id'] . "]' placeholder='Observaciones'></textarea>";
            echo "</div>";
            
            echo "</div>"; // Cerrar la fila del criterio
        }

        // Cerrar el último div de categoría
        if ($ultima_categoria != '') {
            echo "</div>";
        }
        ?>

        
        <!-- Botón para enviar el formulario -->
        <input type="submit" value="Registrar Evaluación">
    </form>

</div>
</body>
</html>