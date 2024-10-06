<?php session_start(); ?>

<!doctype html>
<html lang="es">

<?php   $GLOBALS['titulo'] = "JEL APRENDIZAJE - Inicio de Sesión"; ?>
<?php   include '_head.php'; ?>

<body>
    <?php   include '_header.php'; ?> <br>
    
    <?php
        if(!empty($_SESSION['usuario'])){
            header("Location: panel_control.php");
            exit();
        }
    ?>
    
    <div>
        <div>
            <form id="selectionForm" class="col-3 login" autocomplete="off">
                <div class="mb-3">
                    <label for="userType" class="form-label">Iniciar sesión como</label>
                    <select id="userType" class="form-select" onchange="redirectToLogin()">
                        <option value="">Seleccione...</option>
                        <option value="colegio">Colegio</option>
                        <option value="docente">Docente</option>
                    </select>
                </div>
            </form>
        </div><br>

    <!-- <form action="verificar_colegio.php" method="POST" class="col-3 login" autocomplete="off">  -->
    <form id="loginForm" action="verificar_colegio.php" method="POST" class="col-3 login" autocomplete="off" style="display: none;">
    
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Usuario</label>
            <! -- <input type="email" name="correo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <input name="correo" class="form-control">
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <div class="box-eye">
                <button type="button" onclick="mostrarContraseña('password','eyepassword')">
                    <i id="eyepassword" class="fa-solid fa-eye changePassword"></i>
                </button>
            </div>
            <input type="password" name="contraseña" class="form-control" id="password">
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>

    </form>
    
        <?php if(!empty($_GET['error'])):?>
            <div class="login col-3 mt-3">
                <div id="alertError" style="margin: auto;" class="alert alert-danger mb-2" role="alert">
                    <?= !empty($_GET['error']) ? $_GET['error'] : ""?>
                </div>
            </div>
        <?php endif;?>
    
        <div class="login col-3 mt-3">
            ¿Nuevo en Jel Aprendizaje? <a href="signup.php" style="text-decoration: none;">Create una cuenta</a><br>
            ¿Olviadaste tu contraseña? <a href="login.php" style="text-decoration: none;">Recuperar contraseña</a>
        </div>
    </div>

    <script>
        function redirectToLogin() {
            const userType = document.getElementById('userType').value;
            if (userType === 'colegio') {
                document.getElementById('loginForm').action = 'verificar_colegio.php';
                document.getElementById('loginForm').style.display = 'block';
            } else if (userType === 'docente') {
                document.getElementById('loginForm').action = 'verificar_docente.php';
                document.getElementById('loginForm').style.display = 'block';
            } else {
                document.getElementById('loginForm').style.display = 'none';
            }
        }

        // Llamar a redirectToLogin al cargar la página para mostrar el formulario de login por defecto (colegio en este caso)
        // document.addEventListener('DOMContentLoaded', redirectToLogin);

    </script>

    <script src="main.js"></script>

</body>
</html>