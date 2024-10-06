<?php
    require_once("homeController.php");
    session_start();
    $obj = new homeController();
    $correo = $obj->limpiarcorreo($_POST['correo']);
    $contraseña = $obj->limpiarcadena($_POST['contraseña']);
    $bandera = $obj->verificarusuariodocente($correo,$contraseña);
    if($bandera){
        $_SESSION['usuario'] = $correo;
        
        include '../_conexionMySQL.php';

                $usuario=$_POST["correo"];
                $password=$_POST["contraseña"];

                $sql=$conn->query(" select * from docentes where Usuario='$usuario' and password='$password' ");
                if ($datos=$sql->fetch_object()) {

                    // Esta deberia ser la variable que identifque al colegio en la sesion
                    // Ojo que en algunos lados, no usa esta variable, sino que usa la variable $_SESSION['Nombre'] o incluso $_SESSION['Colegio']
                    $id_colegio = $datos->id_colegio;
                    $_SESSION["id_colegio"]=$datos->id_colegio;
                    $_SESSION["docente"]=$datos->nombre." ".$datos->apellido;
                    $id_colegio = $datos->id_colegio;

                    $sql=$conn->query(" select * from colegios where Usuario='$id_colegio' ");
                    if ($datoscolegio=$sql->fetch_object()) {
                        $_SESSION["Usuario_id"]=$datoscolegio->Usuario_id;
                        $_SESSION['Nombre'] = $datoscolegio->Nombre;
                        $_SESSION["Localidad"]=$datoscolegio->Localidad;
                        $_SESSION["Provincia"]=$datoscolegio->Provincia;
                        $_SESSION["Pais"]=$datoscolegio->Pais;
                        $_SESSION["Tipo"]=$datoscolegio->Tipo;
                        $_SESSION["Logo"]=$datoscolegio->Logo;
                        header("location: index.php");
                    }
                } else {
                    echo "<div class='alert alert-danger'>Acceso denegado</div>";
                }
                header("Location:/screening/index.php");
    } else {
        $error = "<li>Las claves son incorrectas</li>";
        header("Location:login.php?error=".$error);
    }
?>