<?php
session_start();
include '../_conexionMySQL.php';
$GLOBALS['titulo'] = "Plataforma IA de Screening";
include '../_header.php';

// Obtener el id_colegio de la sesión
$id_colegio = $_SESSION['id_colegio'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_estudiante = $_POST['id_estudiante'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $sexo = $_POST['sexo'];
    $dificultad_escritura = $_POST['dificultad_escritura'];
    $dificultad_lectura = $_POST['dificultad_lectura'];
    $dificultad_matematica = $_POST['dificultad_matematica'];
    $observaciones = $_POST['observaciones'];

    // Insertar el alumno en la base de datos

    $sql = "INSERT INTO alumnos (id_estudiante, nombre, apellido, id_colegio, fecha_nacimiento, sexo, dificultad_escritura, dificultad_lectura, dificultad_matematica, observaciones) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $id_estudiante, $nombre, $apellido, $id_colegio, $fecha_nacimiento, $sexo, $dificultad_escritura, $dificultad_lectura, $dificultad_matematica, $observaciones);

    if ($stmt->execute()) {
        echo "<p>Alumno agregado exitosamente.</p>";
    } else {
        echo "<p>Error al agregar el alumno: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Alumnos</title>

    <link rel="stylesheet" href="styles.css?v1">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/screening/css/listado.css">
    <script src="https://kit.fontawesome.com/e1d55cc160.js" crossorigin="anonymous"></script>
    <style>
        .icon-option {
            cursor: pointer;
            font-size: 24px;
            margin-right: 10px;
        }
        .icon-option.selected {
            color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Alta de Alumnos</h1>
        <form method="post" action="alta_alumno.php">
            <div class="mb-3">
                <label for="id_estudiante" class="form-label">ID del Estudiante</label>
                <input type="text" class="form-control" id="id_estudiante" name="id_estudiante" required>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
            </div>
            <div class="mb-3">
                <label for="sexo" class="form-label">Sexo</label>
                <select class="form-control" id="sexo" name="sexo" required>
                    <option value="">Seleccione</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Dificultad en Escritura</label>
                <div>
                    <i class="fas fa-check-circle icon-option" data-value="Si" data-field="dificultad_escritura"></i>
                    <i class="fas fa-times-circle icon-option" data-value="No" data-field="dificultad_escritura"></i>
                    <input type="hidden" id="dificultad_escritura" name="dificultad_escritura" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Dificultad en Lectura</label>
                <div>
                    <i class="fas fa-check-circle icon-option" data-value="Si" data-field="dificultad_lectura"></i>
                    <i class="fas fa-times-circle icon-option" data-value="No" data-field="dificultad_lectura"></i>
                    <input type="hidden" id="dificultad_lectura" name="dificultad_lectura" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Dificultad en Matemática</label>
                <div>
                    <i class="fas fa-check-circle icon-option" data-value="Si" data-field="dificultad_matematica"></i>
                    <i class="fas fa-times-circle icon-option" data-value="No" data-field="dificultad_matematica"></i>
                    <input type="hidden" id="dificultad_matematica" name="dificultad_matematica" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="observaciones" class="form-label">Observaciones</label>
                <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
    </div>
    <script>
        document.querySelectorAll('.icon-option').forEach(icon => {
            icon.addEventListener('click', function() {
                const field = this.getAttribute('data-field');
                const value = this.getAttribute('data-value');
                document.getElementById(field).value = value;

                // Remove selected class from all icons in the same group
                document.querySelectorAll(`.icon-option[data-field="${field}"]`).forEach(i => i.classList.remove('selected'));

                // Add selected class to the clicked icon
                this.classList.add('selected');
            });
        });
    </script>
</body>
</html>