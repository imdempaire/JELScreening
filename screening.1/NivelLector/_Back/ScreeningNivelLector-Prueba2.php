<?php session_start();?>

<!DOCTYPE html>
<html>
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete los datos para el Screening</title>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
    <link rel="stylesheet" type="text/css" href="/css/loginJel.css">

    <script>
        function validateForm() {
            var checkbox = document.getElementById('accept');
            if (!checkbox.checked) {
                alert("Debes aceptar el disclaimer para continuar.");
                return false;
            }
            return true;
        }

        function updateGradeOptions() {
            var schooling = document.getElementById('schooling').value;
            var grade = document.getElementById('grade');
            grade.innerHTML = '';

            if (schooling === 'Primaria') {
                var options = ['1er grado', '2do grado', '3er grado', '4to grado', '5to grado', '6to grado', '7mo grado'];
            } else if (schooling === 'Secundaria') {
                var options = ['1er año', '2do año', '3er año', '4to año', '5to año', '6to año', '7mo año'];
            }

            options.forEach(function(option) {
                var opt = document.createElement('option');
                opt.value = option;
                opt.innerHTML = option;
                grade.appendChild(opt);
            });
        }
    </script>
</head>

<body>
    <?php   $GLOBALS['titulo'] = "Screening de Lectura de JEL Aprendizaje";
            include "../../_header.php";
    ?>
    <div class="content">
        <?php
        // Recuperar los datos del primer formulario y almacenarlos en variables de sesión
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_SESSION['school'] = $_POST['school'];
            $_SESSION['locality'] = $_POST['locality'];
            $_SESSION['province'] = $_POST['province'];
            $_SESSION['country'] = $_POST['country'];
            $_SESSION['type'] = $_POST['type'];
        }
        ?>
        <div class="subtitle">Complete los datos para el Screening</div><br><br>
        <form action="ScreeningNivelLectorProcess.php" method="post" onsubmit="return validateForm()">
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="lastname">Apellido:</label>
            <input type="text" id="lastname" name="lastname" required><br><br>

            <label for="schooling">Escolaridad:</label>
            <select id="schooling" name="schooling" required onchange="updateGradeOptions()">
                <option value="">Seleccione</option>
                <option value="Primaria">Primaria</option>
                <option value="Secundaria">Secundaria</option>
            </select><br><br>

            <label for="age">Edad:</label>
            <input type="number" id="age" name="age" required><br><br>

            <label for="grade">Grado:</label>
            <select id="grade" name="grade" required>
                <option value="">Seleccione escolaridad primero</option>
            </select><br><br>

            <label for="division">División:</label>
            <input type="text" id="division" name="division" required><br><br>
            
            <p>
                <input type="checkbox" id="accept" name="accept" value="yes">
                <label for="accept">Acepto que estos datos sean utilizados para brindar un informe</label>
            </p>
            
            <input type="submit" value="Enviar">
        </form>
    </div>
</body>
</html>