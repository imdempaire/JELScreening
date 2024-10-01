<?php   
        session_start();
?>

<!DOCTYPE html>
<html lang="es">

<?php   $GLOBALS['titulo'] = "Evaluación de Escritura";
        include '../_head.php';
?>

<body>
    <?php   $GLOBALS['titulo'] = "Evaluación de Escritura";
            include '../_header.php';
    ?>
    <main>
        <div class="program-container">
            <?php
            // Depende si el usuario esta loguedo no, muestro la version final o la version de prueba. 
            if (isset($_SESSION['Nombre'])) {
                echo "<a href='/screening/admin/listadocolegios.php' class='program-rect'>Listado de Colegios</a>";
            } else {
                echo "<a href='/screening/admin/listadocolegios.php' class='program-rect'>Listado de Colegios</a>";
            }
            ?> 
        </div>
    </main>
</body>
</html>