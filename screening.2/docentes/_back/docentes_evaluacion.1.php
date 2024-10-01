<?php
include '../_conexionMySQL.php'; // Incluir la conexión a la base de datos

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
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!-- HTML para el formulario de evaluación -->
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
    </select><br>

    <!-- Nombre del evaluador -->
    <label for="evaluador">Nombre del Evaluador:</label>
    <input type="text" name="evaluador" required><br>

    <!-- Listado de Criterios -->
    <h3>Criterios de Evaluación:</h3>
    <?php
    // Consultar los criterios desde la base de datos
    $sql_criterios = "SELECT id, categoria, descripcion FROM docentes_criterios";
    $result_criterios = $conn->query($sql_criterios);

    // Mostrar cada criterio con opciones "Sí" o "No"
    while ($row = $result_criterios->fetch_assoc()) {
        echo "<label>" . $row['categoria'] . " - " . $row['descripcion'] . "</label><br>";
        echo "<input type='radio' name='criterios[" . $row['id'] . "]' value='1' required> Sí";
        echo "<input type='radio' name='criterios[" . $row['id'] . "]' value='0' required> No<br>";
        echo "<textarea name='observaciones[" . $row['id'] . "]' placeholder='Observaciones'></textarea><br><br>";
    }
    ?>
    
    <!-- Botón para enviar el formulario -->
    <input type="submit" value="Registrar Evaluación">
</form>