<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">

<?php   $GLOBALS['titulo'] = "Plataforma IA de Screening";
        include '_head.php';
?>

<body>
    <?php   $GLOBALS['titulo'] = "Plataforma IA de Screening";
            include '_header.php';
    ?>
    <main>
        <div class="program-container">
            <?php
            // Depende si el usuario esta loguedo no, muestro la version final o la version de prueba. 
            if (isset($_SESSION['Nombre'])) {
                echo "<a href='/screening/NivelLector/ScreeningNivelLector.php' class='program-rect'>Screening del Nivel Lector</a>";
                echo "<a href='/screening/NivelMatematica/ScreeningNivelMatematica.php' class='program-rect'>Screening de Matematica</a>";
                echo "<a href='/screening/NivelEscritura/index-menu.php' class='program-rect'>Screening de Escritura</a>";
            } else {
                echo "<a href='/screening/NivelLector/ScreeningNivelLector-Prueba.php' class='program-rect'>Screening de Nivel Lector (PRUEBA!)</a>";
                echo "<a href='/screening/NivelMatematica/ScreeningNivelMatematica-Prueba.php' class='program-rect'>Screening de Matematica (PRUEBA!)</a>";
                echo "<a href='/screening/NivelLector/ScreeningNivelLector-Prueba.php' class='program-rect'>Screening de Escritura (PRUEBA!)</a>";
            }
            ?> 
            <a href="programa4.html" class="program-rect">Observacion de docentes</a>
        </div>
    </main>
    <br><br><br>
    <div class="container">
        <div class="box">
            <img src="images/clipboard-icon.png" alt="Informes generados">
            <p>+80.000 informes generados</p>
        </div>
        <div class="box">
            <img src="images/globe-icon.jpg" alt="Presencia en países">
            <p>Presencia en +10 países</p>
        </div>
        <div class="box">
            <img src="images/certificate-icon.png" alt="Universidades">
            <p>+200 instituciones nos avalan</p>
        </div>
    </div>  
    <BR><?php include '_footer.php';?>
</body>
</html>