<?php session_start(); include '../_conexionMySQL.php';?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Screening de Escritura</title>
    
    <link rel="stylesheet" type="text/css" href="../css/styles.css?v1">
    <link rel="stylesheet" href="styles.css?v1">
    <! -- Incluye la hoja de estilos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    
    <! -- Incluye la biblioteca de iconos de Font Awesome -->
    <script src="https://kit.fontawesome.com/e1d55cc160.js" crossorigin="anonymous"></script>
    
    <style>
        #screeningSection, #evaluationForm, #fileUpload, #uploadSection {
            display: none;
        }
    </style>
</head>

<body>

<?php   
        $GLOBALS['titulo'] = "Screening de Escritura";include '../_header.php';
    
    // Inicio 

    // Inicializar variables
    $nombre = $apellido = "";
    $editable = false;              // Indica si los campos de nombre y apellido deben ser editables
    $id_existente = false;          // Indica si el ID existe en la base de datos

    // Si el formulario ha sido enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Si se ha enviado un ID para buscar
        if (isset($_POST['student_id']) && !isset($_POST['nombre'])) { // Cambio aquí para asegurarse de que se está buscando
            $id = $_POST['student_id'];

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
                $_SESSION['nuevo_alumno'] = "false";
            } else {
                // Si el ID no se encuentra, permitir ingresar nombre y apellido
                echo "<p>ID no encontrado. Por favor, introduce el nombre y apellido para registrar un nuevo alumno.</p>";
                $editable = true;  // Hacer los campos de nombre y apellido editables
                $_SESSION['nuevo_alumno'] = "true";
            }

            $stmt->close();
        
        // Si se han enviado los datos de nombre y apellido para un nuevo registro
        } elseif (isset($_POST['nombre']) && isset($_POST['apellido'])) {
            $id = $_POST['student_id'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];

            // Preparar y ejecutar la inserción del nuevo registro en la base de datos
            $sql = "INSERT INTO alumnos (id_estudiante, nombre, apellido) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $id, $nombre, $apellido);

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

    // Fin 

?>

    <h1>Evaluación de Escritura</h1>
    <!-- Sección de datos básicos -->
    
    <div id="initialForm">

        <!-- Primer paso: Ingreso del ID -->
        <?php if ($_SERVER["REQUEST_METHOD"] != "POST" || !$id_existente && !$editable): ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label for="id">ID:</label>
                <input type="text" id="id" name="student_id" required>
                <button type="submit">Buscar</button><br><br>
            </form>        
        <?php endif; ?>

        <input type="hidden" id="id" name="student_id">

        <!-- Segundo paso: Mostrar datos si el ID existe o permitir ingreso de nombre y apellido si no existe -->
        <?php if ($id_existente): ?>
            <!-- Mostrar los datos encontrados (campos no editables) -->
            <p>ID encontrado:</p>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" readonly><br><br>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($apellido); ?>" readonly><br><br>

            <label for="grado">Grado:</label>
                <select id="grado" name="grado" required>
                    <option value="1er grado">1er grado</option>
                    <option value="2do grado">2do grado</option>
                    <option value="3er grado">3er grado</option>
                    <option value="4to grado">4to grado</option>
                    <option value="5to grado">5to grado</option>
                    <option value="6to grado">6to grado</option>
                </select>
        
            <label for="division">División:</label>
                <select id="division" name="division" required>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>

                <br><br>
                <label for="Trimestre">Trimestre:</label>
                <select id="trimestre" name="trimestre" required>
                    <option value="1er trimestre">1er trimestre</option>
                    <option value="2do trimestre">2do trimestre</option>
                    <option value="3er trimestre">3er trimestre</option>
                </select>
                <label for="Año">Año:</label>
                <select id="anio" name="anio" required>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                </select>

        
            <?php
            // Si esta logoneado como Admin, que le permita elegir el colegio.
            if ($_SESSION["Nombre"] == "Admin" ) {
                // echo "<button type=\"button\" onclick=\"startScreening2()\">Empezar Screening (Admin)</button>";
                echo "<button type=\"button\" onclick=\"startScreening()\">Empezar Screening (Admin)</button>";
            } else {
                echo "<button type=\"button\" onclick=\"startScreening()\">Empezar Screening</button>\"";
            }
            ?>
    
            


            <?php elseif ($editable): ?>
            <!-- Permitir ingreso de nombre y apellido para nuevo registro -->
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br><br>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required><br><br>
        
            <label for="grado">Grado:</label>
                <select id="grado" name="grado" required>
                    <option value="1er grado">1er grado</option>
                    <option value="2do grado">2do grado</option>
                    <option value="3er grado">3er grado</option>
                    <option value="4to grado">4to grado</option>
                    <option value="5to grado">5to grado</option>
                    <option value="6to grado">6to grado</option>
                </select>
        
            <label for="division">División:</label>
                <select id="division" name="division" required>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>

                <br><br>
                <label for="trimestre">Trimestre:</label>
                <select id="trimestre" name="trimestre" required>
                    <option value="1er trimestre">1er trimestre</option>
                    <option value="2do trimestre">2do trimestre</option>
                    <option value="3er trimestre">3er trimestre</option>
                </select>
                <label for="anio">Año:</label>
                <select id="anio" name="anio" required>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                </select>
                <br><br>

            <?php
            // Si esta logoneado como Admin, que le permita elegir el colegio.
            if ($_SESSION["Nombre"] == "Admin" ) {
                // echo "<button type=\"button\" onclick=\"startScreening2()\">Empezar Screening (Admin)</button>";
                echo "<button type=\"button\" onclick=\"startScreening()\">Empezar Screening (Admin)</button>";
            } else {
                echo "<button type=\"button\" onclick=\"startScreening()\">Empezar Screening</button>\"";
            }
            ?>

    <?php endif; ?>


    </div>
    
    <!-- Sección de evaluación -->
    <form id="evaluationForm" action="process_evaluation.php" method="post" enctype="multipart/form-data">
        <div id="screeningSection">
            <!-- Campos ocultos para guardar los datos iniciales -->
            <!-- <input type="hidden" id="colegio_hidden" name="colegio"> --> 
            <input type="hidden" id="nombre_hidden" name="nombre">
            <input type="hidden" id="apellido_hidden" name="apellido">
            <input type="hidden" id="id_hidden" name="student_id">
            <input type="hidden" id="grado_hidden" name="grado">
            <input type="hidden" id="division_hidden" name="division">
            <input type="hidden" id="trimestre_hidden" name="trimestre">
            <input type="hidden" id="anio_hidden" name="anio">

            <?php include 'indexContenido.php';?>

            <button type="button" onclick="askForFileUpload()">Finalizar Evaluación</button>
        </div>

        <div id="uploadSection">

            <!-- Campo para Observaciones -->
            <label for="observaciones">Observaciones:</label>
            <textarea id="observaciones" name="observaciones" rows="4" cols="50" placeholder="Escribe las observaciones aquí..."></textarea>

            <h2>Subir Archivo</h2>
            <p>¿Deseas subir una foto asociada con la evaluación?</p>
            <button type="button" onclick="showFileUpload()">Sí</button>
            <button type="button" onclick="submitForm()">No</button>
            
            <div id="fileUpload">
                <input type="file" name="evaluation_file" id="evaluation_file" accept="image/*">
                <button type="button" onclick="submitForm()">Subir y Continuar</button>
            </div>
        </div>
    </form>

    <script>
        function startScreening() {
            // Transferir valores a los campos ocultos
            document.getElementById('nombre_hidden').value = document.getElementById('nombre').value;
            document.getElementById('apellido_hidden').value = document.getElementById('apellido').value;
            document.getElementById('id_hidden').value = document.getElementById('id').value;
            document.getElementById('grado_hidden').value = document.getElementById('grado').value;
            document.getElementById('division_hidden').value = document.getElementById('division').value;
            document.getElementById('trimestre_hidden').value = document.getElementById('trimestre').value;
            document.getElementById('anio_hidden').value = document.getElementById('anio').value;


            // Limpiar y mostrar la sección de evaluación
            document.getElementById('initialForm').style.display = 'none';
            document.getElementById('screeningSection').style.display = 'block';
            document.getElementById('evaluationForm').style.display = 'block';
        }

        function askForFileUpload() {
            document.getElementById('screeningSection').style.display = 'none';
            document.getElementById('uploadSection').style.display = 'block';
        }

        function startScreening2() {
            // Transferir valores a los campos ocultos
            document.getElementById('colegio_hidden').value = document.getElementById('colegio').value;
            document.getElementById('nombre_hidden').value = document.getElementById('nombre').value;
            document.getElementById('apellido_hidden').value = document.getElementById('apellido').value;
            document.getElementById('id_hidden').value = document.getElementById('id').value;
            document.getElementById('grado_hidden').value = document.getElementById('grado').value;
            document.getElementById('division_hidden').value = document.getElementById('division').value;
            document.getElementById('trimestre_hidden').value = document.getElementById('trtimestre').value;
            document.getElementById('anio_hidden').value = document.getElementById('anio').value;

            // Limpiar y mostrar la sección de evaluación
            document.getElementById('initialForm').style.display = 'none';
            document.getElementById('screeningSection').style.display = 'block';
            document.getElementById('evaluationForm').style.display = 'block';
        }

        function askForFileUpload() {
            document.getElementById('screeningSection').style.display = 'none';
            document.getElementById('uploadSection').style.display = 'block';
        }


        function showFileUpload() {
            document.getElementById('fileUpload').style.display = 'block';
        }

        function submitForm() {
            document.getElementById('evaluationForm').submit();
        }
    </script>
</body>
</html>
