<?php session_start(); include '../_conexionMySQL.php';
    $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
    $apellido = isset($_GET['apellido']) ? $_GET['apellido'] : '';
?>

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
        #fileUpload, #uploadSection {    
            display: none;
        }
    </style>
</head>

<body>

<?php   
        $GLOBALS['titulo'] = "Screening de Escritura";include '../_header.php';
?>    
    <h1>Evaluación de Escritura</h1>
    <!-- Sección de evaluación -->
    <form id="evaluationForm" action="process_evaluation.php?nombre=<?php echo $nombre; ?>&apellido=<?php echo $apellido; ?>" method="post">
        <div id="screeningSection">
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

        function askForFileUpload() {
            document.getElementById('screeningSection').style.display = 'none';
            document.getElementById('uploadSection').style.display = 'block';
        }

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

        function showFileUpload() {
            document.getElementById('fileUpload').style.display = 'block';
        }

        function submitForm() {
            document.getElementById('evaluationForm').submit();
        }
    </script>
</body>
</html>
