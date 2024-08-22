<?php
    session_start();
    include '_conexionMySQL.php';
?>

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
        <form action="/screening/_AdminColegioProcesar.php" method="post">
            <?php 
            // Si esta logoneado como Admin, que le permita elegir el colegio.
            // if ($_SESSION["Nombre"] == "Admin" ) {
                // Obtener colegios únicos de la base de datos, tabla usuarios (=colegio) para la seleccion del colegio.
                $sql_colegios = "SELECT DISTINCT Colegio FROM usuarios";
                $result_colegios = $conn->query($sql_colegios);
                $colegios = [];
                if ($result_colegios->num_rows > 0) {
                    while ($row = $result_colegios->fetch_assoc()) {
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