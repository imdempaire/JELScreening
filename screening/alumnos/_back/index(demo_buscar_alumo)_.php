<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Búsqueda</title>
</head>
<body>
    <?php
    // Datos de conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "jeldata_24";

    // Crear conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar si la conexión ha fallado
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Inicializar variables
    $nombre = $apellido = "";
    $editable = false;   // Indica si los campos de nombre y apellido deben ser editables
    $id_existente = false;  // Indica si el ID existe en la base de datos

    // Si el formulario ha sido enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Si se ha enviado un ID para buscar
        if (isset($_POST['id']) && !isset($_POST['nombre'])) { // Cambio aquí para asegurarse de que se está buscando
            $id = $_POST['id'];

            // Preparar y ejecutar la consulta para buscar el ID en la base de datos
            $sql = "SELECT nombre, apellido FROM alumnos WHERE id_estudiante = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->store_result();

            // Si el ID se encuentra en la base de datos
            if($stmt->num_rows > 0) {
                $stmt->bind_result($nombre, $apellido);
                $stmt->fetch();
                $id_existente = true;  // Marcar que el ID existe
            } else {
                // Si el ID no se encuentra, permitir ingresar nombre y apellido
                echo "<p>ID no encontrado. Por favor, introduce el nombre y apellido para registrar un nuevo alumno.</p>";
                $editable = true;  // Hacer los campos de nombre y apellido editables
            }

            $stmt->close();
        
        // Si se han enviado los datos de nombre y apellido para un nuevo registro
        } elseif (isset($_POST['nombre']) && isset($_POST['apellido'])) {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];

            // Preparar y ejecutar la inserción del nuevo registro en la base de datos
            $sql = "INSERT INTO alumnos (id_estudiante, nombre, apellido) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iss", $id, $nombre, $apellido);

            if ($stmt->execute()) {
                echo "<p>Nuevo registro creado exitosamente.</p>";
            } else {
                echo "<p>Error al crear el registro: " . $stmt->error . "</p>";
            }

            $stmt->close();
        } else {
            echo "<p>Error inesperado. Por favor, intente nuevamente.</p>";
        }
    }

    $conn->close();
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <!-- Primer paso: Ingreso del ID -->
        <?php if ($_SERVER["REQUEST_METHOD"] != "POST" || !$id_existente && !$editable): ?>
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" required>
            <button type="submit">Buscar</button><br><br>
        <?php endif; ?>

        <!-- Segundo paso: Mostrar datos si el ID existe o permitir ingreso de nombre y apellido si no existe -->
        <?php if ($id_existente): ?>
            <!-- Mostrar los datos encontrados (campos no editables) -->
            <p>ID encontrado:</p>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" readonly><br><br>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($apellido); ?>" readonly><br><br>
        <?php elseif ($editable): ?>
            <!-- Permitir ingreso de nombre y apellido para nuevo registro -->
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br><br>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required><br><br>

            <input type="submit" value="Guardar">
        <?php endif; ?>
    </form>
</body>
</html>