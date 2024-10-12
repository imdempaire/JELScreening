<?php                                       
    session_start();                        
    include '../_conexionMySQL.php';        

// Obtener el nombre del colegio de la sesión
// Deberia ser Colegio, no nombre! Corregir en algun momento.
// $nombre_colegio = $_SESSION["Nombre"];
$id_colegio = $_SESSION["id_colegio"];
if ($_SESSION['Nombre'] == "Admin") {
    $nombre_colegio = $_SESSION['colegio'];
} else {
    $nombre_colegio = $_SESSION["Nombre"];
}

// Consultar la base de datos para obtener los alumnos filtrados y ordenadas con paginación
$sql = "SELECT * FROM docentes_evaluaciones WHERE id_colegio = '$id_colegio'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Screening de Escritura</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="/screening/css/listado.css"> -->
    <link rel="stylesheet" type="text/css" href="/screening/css/styles.css?2">
    <link rel="stylesheet" type="text/css" href="/screening/css/stylesListado.css?2">
    <!-- Enlace a Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <?php   $GLOBALS['titulo'] = "Observación Docentes";
            include '../_header.php';
    ?>

    <div class="container">
        <h1 style="display: inline-block;">Listado de Observaciones Docentes</h1>
    </div>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info">
            <?= $_SESSION['message'] ?>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <div class="container">            
        <table class="table">
            <thead>
                <tr>
                    <th><center>id_docente</center></th>
                    <th><center>id_colegio</center></th>
                    <th><center>evaluador</center></th>
                    <th><center>Fecha</center></th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id_docente']); ?></td>
                            <td><?php echo htmlspecialchars($row['id_colegio']); ?></td>
                            <td><?php echo htmlspecialchars($row['evaluador']); ?></td>
                            <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                            <td>
                                <a href="verEvaluacionDocente.php?id_docente=<?php echo $row['id_docente']; ?>" class="btn btn-info">Ver Evaluaciones</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No hay alumnos registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<BR><?php include '../_footer.php';?>

</body>
</html>