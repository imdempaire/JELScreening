<?php session_start(); ?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Screening JEL Aprendizaje</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <link rel="stylesheet" href="/screening/login/css/estilos.css"?v2>
        <link rel="stylesheet" href="/screening/css/stylesJel.css">
        <script src="https://kit.fontawesome.com/e1d55cc160.js" crossorigin="anonymous"></script>
    </head>

<body>
    <header>
        <div class="header-content">
            <a href="/screening/index.php"><img src="/screening/images/LogoJel.png" alt="Logo JEL" class="logo"></a>
            <h1>JEL APREDIZAJE - Inicio de Sesión</h1>
        </div>
    </header>

    <?php
        if(!empty($_SESSION['usuario'])){
            header("Location:panel_control.php");
        }
    ?>
    <br>
    <! -- <div class="fondo-login">
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
        ¿Nuevo en Jel Aprendizaje? <a href="signup.php" style="text-decoration: none;">Create una cuenta</a>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="main.js"></script>

</body>
</html>