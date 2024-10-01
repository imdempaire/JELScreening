<?php
    require_once("homeController.php");
    session_start();
    $obj = new homeController();
    $correo = $obj->limpiarcorreo($_POST['correo']);
    $contraseña = $obj->limpiarcadena($_POST['contraseña']);
    $bandera = $obj->verificarusuario($correo,$contraseña);
    if($bandera){
        $_SESSION['usuario'] = $correo;
        
        include '../_conexionMySQL.php';

                $usuario=$_POST["correo"];
                $password=$_POST["contraseña"];
                $sql=$conn->query(" select * from usuarios where Usuario='$usuario' and password='$password' ");
                if ($datos=$sql->fetch_object()) {

                    // Esta deberia ser la variable que identifque al colegio en la sesion
                    // Ojo que en algunos lados, no usa esta variable, sino que usa la variable $_SESSION['Nombre'] o incluso $_SESSION['Colegio']
                    $_SESSION["id_colegio"]=$datos->Usuario;
                    
                    $_SESSION["Usuario_id"]=$datos->Usuario_id;
                    $_SESSION["Nombre"]=$datos->Nombre;
                    $_SESSION["Localidad"]=$datos->Localidad;
                    $_SESSION["Provincia"]=$datos->Provincia;
                    $_SESSION["Pais"]=$datos->Pais;
                    $_SESSION["Tipo"]=$datos->Tipo;
                    $_SESSION["Logo"]=$datos->Logo;
                    header("location: index.php");
                } else {
                    echo "<div class='alert alert-danger'>Acceso denegado</div>";
                }
                header("Location:/screening/index.php");
    } else {
        $error = "<li>Las claves son incorrectas</li>";
        header("Location:login.php?error=".$error);
    }
?>