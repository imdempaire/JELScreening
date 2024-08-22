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
                echo "<a href='/screening/NivelEscritura/index.php' class='program-rect'>Iniciar Screening de Escritura</a>";
                echo "<a href='/screening/NivelEscritura/listado.php' class='program-rect'>Infomes individuales</a>";
                echo "<a href='/screening/NivelEscritura/listadogrupal.php' class='program-rect'>Infome Grupal</a>";
            } else {
                echo "<a href='/screening/NivelLector/ScreeningNivelLector.php' class='program-rect'>Iniciar Screening de Escritura</a>";
                echo "<a href='/screening/NivelEscritura/listado.php' class='program-rect'>Infomes individuales</a>";
                echo "<a href='/screening/NivelEscritura/listadogrupal.php' class='program-rect'>Infome Grupal</a>";
            }
            ?> 
        </div>
    </main>
</body>
</html>