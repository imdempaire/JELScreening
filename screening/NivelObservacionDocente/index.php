<?php   
        session_start();
?>

<!DOCTYPE html>
<html lang="es">

<?php   $GLOBALS['titulo'] = "Observación Docente";
        include '../_head.php';
?>

<body>
    <?php   $GLOBALS['titulo'] = "Observación Docente";
            include '../_header.php';
    ?>
    <main>
        <div class="program-container">
            <?php
            // Depende si el usuario esta loguedo no, muestro la version final o la version de prueba. 
            if (isset($_SESSION['Nombre'])) {
                echo "<a href='/screening/NivelObservacionDocente/docentes_evaluacion.php' class='program-rect'>Observación Docente</a>";
                echo "<a href='/screening/NivelLector/Informes/InformeGrupal.php' class='program-rect'>Informes Individuales</a>";
            } else {



            }
            ?> 
        </div>
    </main>
</body>
</html>