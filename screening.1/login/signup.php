<?php session_start(); ?>

<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>JEL Aprendizaje - Registrarse</title>
        
        <link rel="stylesheet" href="/screening/login/css/estilos.css">
        <link rel="stylesheet" href="/screening/css/stylesJel.css">

        <!-- Incluye la hoja de estilos de Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        
        <!-- Incluye la biblioteca de iconos de Font Awesome -->
        <script src="https://kit.fontawesome.com/e1d55cc160.js" crossorigin="anonymous"></script>
    
        <script>
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

    <?php   $GLOBALS['titulo'] = "JEL APRENDIZAJE - Registrarse";
            include '_header.php';
    ?>

    <?php
        if(!empty($_SESSION['usuario'])){
            header("Location:panel_control.php");
        }
    ?>
<br>
    <form action="store.php" method="POST" class="col-3 login" autocomplete="off">
    
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre y Apellido</label>
            <input name="nombre" value="<?= (!empty($_GET['nombre'])) ? $_GET['nombre'] : "" ?>" class="form-control">
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Dirección de correo (usuario)</label>
            <input type="email" name="correo" value="<?= (!empty($_GET['correo'])) ? $_GET['correo'] : "" ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Contraseña</label>
            <div class="box-eye">
                <button type="button" onclick="mostrarContraseña('password','eyepassword')">
                    <i id="eyepassword" class="fa-solid fa-eye changePassword"></i>
                </button>
            </div>
            <input type="password" name="contraseña" value="<?= (!empty($_GET['contraseña'])) ? $_GET['contraseña'] : "" ?>" class="form-control" id="password">
        </div>
        
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Repita la contraseña</label>
            <div class="box-eye">
                <button type="button" onclick="mostrarContraseña('password2','eyepassword2')">
                    <i id="eyepassword2" class="fa-solid fa-eye changePassword"></i>
                </button>
            </div>
            <input type="password" name="confirmarContraseña" value="<?= (!empty($_GET['confirmarContraseña'])) ? $_GET['confirmarContraseña'] : "" ?>" class="form-control" id="password2">
        </div>
        <br>
        <! -- Agregue esto para que me pida los datos del colegio -->
        <div class="mb-3">
            <center>
            <label for="DatosdelColegio" class="form-label">Datos del Colegio</label>
            </center>
        </div>
    
        <div class="mb-3">
            <label for="colegio" class="form-label">Colegio</label>
            <input name="colegio" value="<?= (!empty($_GET['colegio'])) ? $_GET['colegio'] : "" ?>" class="form-control">
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select id="tipo" name="tipo" required>
                <option value="Privado">Privado</option>
                <option value="Público">Público</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="pais" class="form-label">Pais</label>
            <select id="pais" name="pais" required>
                <option value="Argentina">Argentina</option>
                <option value="Bolivia">Bolivia</option>
                <option value="Bolivia">Público</option>
                <option value="Chile">Chile</option>
                <option value="Colombia">Colombia</option>
                <option value="Costa Rica">Costa Rica</option>
                <option value="CUBA">CUBA</option>
                <option value="Ecuador">Ecuador</option>
                <option value="El Salvador">El Salvador</option>
                <option value="Guatemala">Guatemala</option>
                <option value="Honduras">Honduras</option>
                <option value="México">México</option>
                <option value="Nicaragua">Nicaragua</option>
                <option value="Panamá">Panamá</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Perú">Perú</option>
                <option value="República Dominicana">República Dominicana</option>
                <option value="Uruguay">Uruguay</option>
                <option value="Venezuela">Venezuela</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="provincia" class="form-label">Provincia / Departamento / Estado</label>
            <input name="provincia" value="<?= (!empty($_GET['provincia'])) ? $_GET['provincia'] : "" ?>" class="form-control">
        </div>

        <div class="mb-3">
            <label for="Localidad" class="form-label">Localidad</label>
            <input name="localidad" class="form-control">
        </div>
               
        <?php if(!empty($_GET['error'])):?>
            <div id="alertError" style="margin: auto;" class="alert alert-danger mb-2" role="alert">
                <?= !empty($_GET['error']) ? $_GET['error'] : ""?>
            </div>
        <?php endif;?>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">CREAR CUENTA</button>
        </div>

    </form>
        <div class="login col-3 mt-3">
            ¿Tienes una cuenta? <a href="login.php" style="text-decoration: none;">Inicia Sesion</a><br>
            ¿Olviadaste tu contraseña? <a href="login.php" style="text-decoration: none;">Recuperar contraseña</a>
        </div>

    <script src="/login/asset/js/main.js"></script>
  </body>
</html>