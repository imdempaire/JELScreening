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
                echo "<a href='/screening/docentes/docentes_alta.php' class='program-rect'>Alta de docente</a>";
                echo "<a href='/screening/docentes/ListadoDocentes.php' class='program-rect'>Listado de docentes</a>";
            ?> 
        </div>
    </main>

    <br><?php include '../_footer.php';?>

</body>
</html>