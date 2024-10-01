<?php
    session_start();
    include '../_conexionMySQL.php';
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
        <form action="/screening/admin/AdminElegirColegioProcesar.php" method="post">
            <?php 
            // Si esta logoneado como Admin, que le permita elegir el colegio.
            // if ($_SESSION["Nombre"] == "Admin" ) {
                // Obtener colegios únicos de la base de datos, tabla colegio para la seleccion del colegio.
                $sql_colegios = "SELECT DISTINCT Usuario, Colegio FROM colegios";
                $result_colegios = $conn->query($sql_colegios);
                $usuario = [];
                $colegios = [];
                if ($result_colegios->num_rows > 0) {
                    while ($row = $result_colegios->fetch_assoc()) {
                        $usuario[] = $row['Usuario'];
                        $colegios[] = $row['Colegio'];
                    }
                }
                echo "<label for=\"colegio\">Colegio:</label>";
                echo "<select id=\"colegio\" name=\"colegio\" required>";
                        foreach ($colegios as $colegio):
                            echo "<option value=\"$colegio\">".$colegio."</option>";
                        endforeach;
                echo "</select>";
            // }
            ?>
            <br><br>
            <button type="submit">Elegir</button>
        </form>
           
    </main>

    <br><br><br>
 
    <BR><?php include '../_footer.php';?>
</body>
</html>