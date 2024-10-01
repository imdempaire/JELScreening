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
    <form action="verificar.php" method="POST" class="col-3 login" autocomplete="off">
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

        <?php if(!empty($_GET['error'])):?>
            <div id="alertError" style="margin: auto;" class="alert alert-danger mb-2" role="alert">
                <?= !empty($_GET['error']) ? $_GET['error'] : ""?>
            </div>
        <?php endif;?>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>

    </form>
        <div class="login col-3 mt-3">
            ¿Nuevo en Jel Aprendizaje? <a href="signup.php" style="text-decoration: none;">Create una cuenta</a><br>
            ¿Olviadaste tu contraseña? <a href="login.php" style="text-decoration: none;">Recuperar contraseña</a>
        </div>
    </div>

    <script src="main.js"></script>

</body>
</html>