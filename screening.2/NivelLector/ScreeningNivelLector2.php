<?php session_start();?>

<!DOCTYPE html>
<html>
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete los datos para el Screening</title>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
    <link rel="stylesheet" type="text/css" href="/css/loginJel.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="/login/asset/css/estilos.css">
    <script src="https://kit.fontawesome.com/e1d55cc160.js" crossorigin="anonymous"></script>


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
            include "../_header.php";
    ?>

        <?php
        // Recuperar los datos del primer formulario y almacenarlos en variables de sesión
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_SESSION['school'] = $_SESSION["Nombre"];
            $_SESSION['locality'] = $_SESSION["Localidad"];
            $_SESSION['province'] = $_SESSION["Provincia"];
            $_SESSION['country'] = $_SESSION["Pais"];
            $_SESSION['type'] = $_SESSION["Pais"];
        }
        ?>
        <div class="subtitle">Complete los datos para el Screening</div><br><br>
        <form action="ScreeningNivelLectorProcess.php" method="post" class="col-3 login" onsubmit="return validateForm()">

            <div class="mb-3">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" required><br><br>
            </div>
            
            <div class="mb-3">
                <label for="lastname">Apellido:</label>
                <input type="text" id="lastname" name="lastname" required><br><br>
            </div>

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

</body>
</html>