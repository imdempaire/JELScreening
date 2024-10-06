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
            // Depende si el usuario esta loguedo no, muestro la version final o no muestro nada.
            if (isset($_SESSION['Nombre'])) {
                echo "<a href='/screening/NivelEscritura/index.php' class='program-rect'>Screening de Escritura</a>";
                echo "<a href='/screening/NivelLector/index.php' class='program-rect'>Screening del Nivel Lector</a>";
                echo "<a href='/screening/NivelMatematica/ScreeningNivelMatematica.php' class='program-rect'>Screening de Matematica</a>";

                if (!isset ($_SESSION['docente'])) {
                    echo "<a href='/screening/NivelObservacionDocente/index.php' class='program-rect'>Observación de docentes</a>";
                }

            } else {

                

            }
            ?> 
        </div>
    </main>
    <br><br>
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