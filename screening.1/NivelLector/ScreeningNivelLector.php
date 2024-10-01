<?php session_start();?>

<!DOCTYPE html>
<html>

<?php   $GLOBALS['titulo'] = "Datos del Colegio";
        include "../_head.php";
?>

<body>
    <?php   $GLOBALS['titulo'] = "Screening de Lectura de JEL Aprendizaje";
            include "../_header.php";
    ?>
    <div class="content">
        <div class="subtitle">Datos del colegio</div><br><br>
        <form action="ScreeningNivelLector2.php" method="post">
            
            <label for="school">Colegio:</label>
            <?php echo " ".$_SESSION["Nombre"];?><br><br>

            <label for="locality">Localidad:</label>
            <?php echo " ".$_SESSION["Localidad"];?><br><br>

            <label for="province">Provincia:</label>
            <?php echo " ".$_SESSION["Provincia"];?><br><br>

            <label for="country">País:</label>
            <?php echo " ".$_SESSION["Pais"];?><br><br>

            <label for="type">Tipo:</label>
            <?php echo " ".$_SESSION["Tipo"];?><br><br>

            
            
            
            <input type="submit" value="Siguiente">
        </form>
    </div>
</body>
</html>