<?php
session_start();
include '../_conexionMySQL.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM evaluaciones WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // $colegio = $_POST['colegio'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $id_estudiante = $_POST['id_estudiante'];
    $grado = $_POST['grado'];
    $division = $_POST['division'];
    $tipografia = $_POST['tipografia'];
    $claridad = $_POST['claridad'];
    $tamano = $_POST['tamano'];
    $presion = $_POST['presion'];
    $emplazamiento_renglon = $_POST['emplazamiento_renglon'];
    $repeticiones = $_POST['repeticiones'];
    $vocabulario = $_POST['vocabulario'];
    $conectores = $_POST['conectores'];
    $longitud = $_POST['longitud'];
    $puntuacion = $_POST['puntuacion'];
    $uso_mayuscula = $_POST['uso_mayuscula'];
    $correspondencia_fonologica = $_POST['correspondencia_fonologica'];
    $correspondencia_ortografica = $_POST['correspondencia_ortografica'];
    // $total_puntos = $_POST['total_puntos'];
    $observaciones = $_POST['observaciones'];

    $sql = "UPDATE evaluaciones SET nombre = ?, apellido = ?, id_estudiante = ?, grado = ?, division = ?, tipografia = ?, claridad = ?, tamano = ?, presion = ?, emplazamiento_renglon = ?, repeticiones = ?, vocabulario = ?, conectores = ?, longitud = ?, puntuacion = ?, uso_mayuscula = ?, correspondencia_fonologica = ?, correspondencia_ortografica = ?, observaciones = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssiiiiiiiiiiiiisi", $nombre, $apellido, $id_estudiante, $grado, $division, $tipografia, $claridad, $tamano, $presion, $emplazamiento_renglon, $repeticiones, $vocabulario, $conectores, $longitud, $puntuacion, $uso_mayuscula, $correspondencia_fonologica, $correspondencia_ortografica, $observaciones, $id);

    // $sql = "UPDATE evaluaciones SET nombre = ?, apellido = ?, id_estudiante = ?, grado = ?, division = ?, tipografia = ?, claridad = ?, tamano = ?, presion = ?, emplazamiento_renglon = ?, repeticiones = ?, vocabulario = ?, conectores = ?, longitud = ?, puntuacion = ?, correspondencia_fonologica = ?, correspondencia_ortografica = ?, total_puntos = ?, observaciones = ? WHERE id = ?";
    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param("ssssssiiiiiiiiiiiiiisi", $colegio, $nombre, $apellido, $id_estudiante, $grado, $division, $tipografia, $claridad, $tamano, $presion, $emplazamiento_renglon, $repeticiones, $vocabulario, $conectores, $longitud, $puntuacion, $correspondencia_fonologica, $correspondencia_ortografica, $total_puntos, $observaciones, $id);
    
    // Depuración: Verificar los valores antes de ejecutar la consulta
    // error_log("Valores a actualizar: colegio=$colegio, nombre=$nombre, apellido=$apellido, id_estudiante=$id_estudiante, grado=$grado, division=$division, tipografia=$tipografia, claridad=$claridad, tamano=$tamano, presion=$presion, emplazamiento_renglon=$emplazamiento_renglon, repeticiones=$repeticiones, vocabulario=$vocabulario, conectores=$conectores, longitud=$longitud, total_puntos=$total_puntos, observaciones=$observaciones, id=$id");

    if ($stmt->execute()) {
        $_SESSION['message'] = "Registro actualizado exitosamente.";
        header("Location: listado.php");
        exit();
    } else {
        $_SESSION['message'] = "Error al actualizar el registro.";
        // Depuración: Verificar el error de la consulta
        error_log("Error en la consulta: " . $stmt->error);
    }
    $stmt->close();
    $conn->close();
}
?>

<!doctype html>
<html lang="en">

    <?php   $GLOBALS['titulo'] = "Evaluación de Escritura";
        include '../_head.php';
    ?>

<body>
    <?php   
        $GLOBALS['titulo'] = "Evaluación de Escritura";include '../_header.php';
    ?>

    <div>
        <h1>Editar Evaluación</h1>

        // No se que es esto, pero no se usa en el código
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-info">
                <?= $_SESSION['message'] ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        
        <form action="editar.php?id=<?php echo $id; ?>" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($row['nombre']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo htmlspecialchars($row['apellido']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="id_estudiante" class="form-label">ID Estudiante</label>
                <input type="text" class="form-control" id="id_estudiante" name="id_estudiante" value="<?php echo htmlspecialchars($row['id_estudiante']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="grado" class="form-label">Grado</label>
                <input type="text" class="form-control" id="grado" name="grado" value="<?php echo htmlspecialchars($row['grado']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="division" class="form-label">División</label>
                <input type="text" class="form-control" id="division" name="division" value="<?php echo htmlspecialchars($row['division']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="tipografia" class="form-label">Tipografía</label>
                <input type="number" class="form-control" id="tipografia" name="tipografia" value="<?php echo htmlspecialchars($row['tipografia']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="claridad" class="form-label">Claridad</label>
                <input type="number" class="form-control" id="claridad" name="claridad" value="<?php echo htmlspecialchars($row['claridad']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="tamano" class="form-label">Tamaño</label>
                <input type="number" class="form-control" id="tamano" name="tamano" value="<?php echo htmlspecialchars($row['tamano']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="presion" class="form-label">Presión</label>
                <input type="number" class="form-control" id="presion" name="presion" value="<?php echo htmlspecialchars($row['presion']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="emplazamiento_renglon" class="form-label">Emplazamiento en el Renglón</label>
                <input type="number" class="form-control" id="emplazamiento_renglon" name="emplazamiento_renglon" value="<?php echo htmlspecialchars($row['emplazamiento_renglon']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="repeticiones" class="form-label">Repeticiones</label>
                <input type="number" class="form-control" id="repeticiones" name="repeticiones" value="<?php echo htmlspecialchars($row['repeticiones']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="vocabulario" class="form-label">Vocabulario</label>
                <input type="number" class="form-control" id="vocabulario" name="vocabulario" value="<?php echo htmlspecialchars($row['vocabulario']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="conectores" class="form-label">Conectores</label>
                <input type="number" class="form-control" id="conectores" name="conectores" value="<?php echo htmlspecialchars($row['conectores']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="longitud" class="form-label">Longitud</label>
                <input type="number" class="form-control" id="longitud" name="longitud" value="<?php echo htmlspecialchars($row['longitud']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="puntuacion" class="form-label">Puntuacion</label>
                <input type="number" class="form-control" id="puntuacion" name="puntuacion" value="<?php echo htmlspecialchars($row['puntuacion']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="uso_mayuscula" class="form-label">Uso mayuscula</label>
                <input type="number" class="form-control" id="uso_mayuscula" name="uso_mayuscula" value="<?php echo htmlspecialchars($row['uso_mayuscula']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="correspondencia_fonologica" class="form-label">Correspondencia fonologica</label>
                <input type="number" class="form-control" id="correspondencia_fonologica" name="correspondencia_fonologica" value="<?php echo htmlspecialchars($row['correspondencia_fonologica']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="correspondencia_ortografica" class="form-label">Correspondencia ortografica</label>
                <input type="number" class="form-control" id="correspondencia_ortografica" name="correspondencia_ortografica" value="<?php echo htmlspecialchars($row['correspondencia_ortografica']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="observaciones" class="form-label">Observaciones</label>
                <textarea class="form-control" id="observaciones" name="observaciones" rows="3"><?php echo htmlspecialchars($row['observaciones']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>