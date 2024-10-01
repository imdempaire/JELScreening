<?php
    require_once("homeController.php");
    $obj = new homeController();
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    $confirmarContraseña = $_POST['confirmarContraseña'];

    // Agregue estos datos
    $nombre = $_POST['nombre'];
    $colegio = $_POST['colegio'];
    $tipo = $_POST['tipo'];
    $pais = $_POST['pais'];
    $NoCompara = 0;
    $baja = 0;
    $provincia = $_POST['provincia'];
    $localidad = $_POST['localidad'];
    $logo = "Logo.jpg";

    $error = "";
    // Valido que ningun campo este vacio
    if(empty($nombre) || empty($correo) || empty($contraseña) || empty($confirmarContraseña) || empty($colegio) || empty($tipo) || empty($pais) || empty($provincia) || empty($localidad)){
        $error .= "<li>Completa todos los datos</li>";
        // header("Location:signup.php?error=".$error."&&correo=".$correo."&&contraseña=".$contraseña."&&confirmarContraseña=".$confirmarContraseña);
        header("Location:signup.php?error=".$error."&&nombre=".$nombre."&&correo=".$correo."&&contraseña=".$contraseña."&&confirmarContraseña=".$confirmarContraseña."&&colegio=".$colegio."&&tipo=".$tipo."&&pais=".$pais."&&NoCompara=".$NoCompara."&&baja=".$baja."&&provincia=".$provincia."&&localidad=".$localidad."&&logo=".$logo);
    }else if($correo && $contraseña && $confirmarContraseña){
        if($contraseña == $confirmarContraseña){
            if($obj->guardarUsuario($nombre, $correo,$contraseña,$colegio,$tipo,$pais,$NoCompara,$baja,$provincia,$localidad,$logo) == false){
                $error .= "<li>El correo ya esta registrado</li>";
                header("Location:signup.php?error=".$error."&&correo=".$correo."&&contraseña=".$contraseña."&&confirmarContraseña=".$confirmarContraseña);
            }else{
                header("Location:login.php");
            }
        }else{
            $error .= "<li>Las contraseñas son diferentes</li>";
            header("Location:signup.php?error=".$error."&&correo=".$correo."&&contraseña=".$contraseña."&&confirmarContraseña=".$confirmarContraseña);
        }
    }
?>