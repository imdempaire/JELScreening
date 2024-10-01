<?php   
        session_start();
?>

<!DOCTYPE html>
<html lang="es">

<?php   $GLOBALS['titulo'] = "Plataforma IA de Screening";
        include '../_head.php';
?>

<body>
    <?php   $GLOBALS['titulo'] = "Plataforma IA de Screening";
            include '../_header.php';
    ?>
    <main>
        <div class="program-container">
            <?php
                echo "<a href='/screening/alumnos/alta_alumno.php' class='program-rect'>Alta de alumno</a>";
                echo "<a href='/screening/alumnos/listado_alumnos.php' class='program-rect'>Listado de alumnos</a>";
            ?> 
        </div>
    </main>
</body>
</html>