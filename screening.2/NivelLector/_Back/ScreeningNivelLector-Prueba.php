<?php session_start();?>

<!DOCTYPE html>
<html>

<?php   $GLOBALS['titulo'] = "Datos del Colegio";
        include "../../_head.php";
?>

<body>
    <?php   $GLOBALS['titulo'] = "Screening de Lectura de JEL Aprendizaje";
            include "../../_header.php";
    ?>
    <div class="content">
        <div class="subtitle">Ingrese los datos del colegio</div><br><br>
        <form action="ScreeningNivelLector-Prueba|2.php" method="post">

            <label for="school">Colegio:</label>
            <input type="text" id="school" name="school" required><br><br>

            <label for="locality">Localidad:</label>
            <input type="text" id="locality" name="locality" required><br><br>

            <label for="province">Provincia:</label>
            <input type="text" id="province" name="province" required><br><br>

            <label for="country">País:</label>
            <input type="text" id="country" name="country" required><br><br>

            <label for="type">Tipo:</label>
            <select id="type" name="type" required>
                <option value="Privado">Privado</option>
                <option value="Público">Público</option>
            </select><br><br>
            
            <input type="submit" value="Siguiente">
        </form>
    </div>
</body>
</html>