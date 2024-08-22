<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Búsqueda</title>
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "jeldata_24";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $nombre = $apellido = "";
    $editable = false;
    $id_existente = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];

        $sql = "SELECT nombre, apellido FROM alumnos WHERE id_estudiante = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows > 0) {
            $stmt->bind_result($nombre, $apellido);
            $stmt->fetch();
            $id_existente = true;
        } else {
            echo "<p>No se encontro el alumno.</p>";
            $editable = true; // Permitir edición de campos si no se encuentra el ID
        }

        $stmt->close();

        if (!$id_existente && !empty($_POST['nombre']) && !empty($_POST['apellido'])) {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];

            $sql = "INSERT INTO alumnos (id_estudiante, nombre, apellido) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iss", $id, $nombre, $apellido);

            if ($stmt->execute()) {
                echo "<p>Nuevo registro creado exitosamente.</p>";
            } else {
                echo "<p>Error al crear el registro: " . $stmt->error . "</p>";
            }

            $stmt->close();
        }
    }

    $conn->close();
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" value="<?php echo isset($_POST['id']) ? htmlspecialchars($_POST['id']) : ''; ?>">
        <button type="submit">Buscar</button><br><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" <?php echo $editable ? '' : 'readonly'; ?>><br><br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($apellido); ?>" <?php echo $editable ? '' : 'readonly'; ?>><br><br>

        <input type="submit" value="Guardar">
    </form>
</body>
</html>