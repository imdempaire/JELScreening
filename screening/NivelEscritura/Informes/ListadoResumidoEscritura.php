<?php
    session_start();
    include '../../_conexionMySQL.php';

// Obtener el nombre del colegio de la sesión
// Deberia ser Colegio, no nombre! Corregir en algun momento.
// $nombre_colegio = $_SESSION["Nombre"];

if ($_SESSION['Nombre'] == "Admin") {
    $nombre_colegio = $_SESSION['colegio'];
} else {
    $nombre_colegio = $_SESSION["Nombre"];
}

// Determinar el grado, división, nombre y apellido seleccionados para el filtro
$filtro_grado = isset($_GET['grado']) ? $_GET['grado'] : '';
$filtro_division = isset($_GET['division']) ? $_GET['division'] : '';
$filtro_nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
$filtro_apellido = isset($_GET['apellido']) ? $_GET['apellido'] : '';
$filtro_trimestre = isset($_GET['trimestre']) ? $_GET['trimestre'] : '';
$filtro_anio = isset($_GET['anio']) ? $_GET['anio'] : '';

// Configuración de paginación
$items_per_page_options = [10, 25, 50, 100, 'todos'];
$results_per_page = isset($_GET['items_per_page']) && in_array($_GET['items_per_page'], $items_per_page_options) ? $_GET['items_per_page'] : 10;

if ($results_per_page === 'todos') {
    $results_per_page = PHP_INT_MAX; // Muestra todos los registros si se selecciona 'todos'
}

$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $results_per_page;

// Obtener el total de registros
$sql_total = "SELECT COUNT(*) AS total FROM screening_escritura WHERE colegio = '$nombre_colegio'";
if ($filtro_grado) {
    $sql_total .= " AND grado = '$filtro_grado'";
}
if ($filtro_division) {
    $sql_total .= " AND division = '$filtro_division'";
}
if ($filtro_nombre) {
    $sql_total .= " AND nombre LIKE '%$filtro_nombre%'";
}
if ($filtro_apellido) {
    $sql_total .= " AND apellido LIKE '%$filtro_apellido%'";
}
if ($filtro_trimestre) {
    $sql_total .= " AND trimestre LIKE '%$filtro_apellido%'";
}
if ($filtro_anio) {
    $sql_total .= " AND anio LIKE '%$filtro_apellido%'";
}

$result_total = $conn->query($sql_total);
$total_rows = $result_total->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $results_per_page);

// Obtener grados únicos de la base de datos para el filtro
$sql_grados = "SELECT DISTINCT grado FROM screening_escritura WHERE colegio = '$nombre_colegio'";
$result_grados = $conn->query($sql_grados);
$grados = [];
if ($result_grados->num_rows > 0) {
    while ($row = $result_grados->fetch_assoc()) {
        $grados[] = $row['grado'];
    }
}

// Obtener divisiones únicas de la base de datos para el filtro
$sql_divisiones = "SELECT DISTINCT division FROM screening_escritura WHERE colegio = '$nombre_colegio'";
$result_divisiones = $conn->query($sql_divisiones);
$divisiones = [];
if ($result_divisiones->num_rows > 0) {
    while ($row = $result_divisiones->fetch_assoc()) {
        $divisiones[] = $row['division'];
    }
}

// Obtener trimestres únicos de la base de datos para el filtro
$sql_trimestres = "SELECT DISTINCT trimestre FROM screening_escritura WHERE colegio = '$nombre_colegio'";
$result_trimestres = $conn->query($sql_trimestres);
$trimestres = [];
if ($result_trimestres->num_rows > 0) {
    while ($row = $result_trimestres->fetch_assoc()) {
        $trimestres[] = $row['trimestre'];
    }
}

// Obtener años únicos de la base de datos para el filtro
$sql_anios = "SELECT DISTINCT anio FROM screening_escritura WHERE colegio = '$nombre_colegio'";
$result_anios = $conn->query($sql_anios);
$anios = [];
if ($result_anios->num_rows > 0) {
    while ($row = $result_anios->fetch_assoc()) {
        $anios[] = $row['anio'];
    }
}

// Determinar el campo y el orden de clasificación
$sort_field = isset($_GET['sort']) ? $_GET['sort'] : 'grado';
$order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

// Cambiar el orden de clasificación al hacer clic
$order_toggle = $order === 'ASC' ? 'DESC' : 'ASC';

// Consultar la base de datos para obtener las evaluaciones filtradas y ordenadas con paginación
$sql = "SELECT * FROM screening_escritura WHERE colegio = '$nombre_colegio'";
if ($filtro_grado) {
    $sql .= " AND grado = '$filtro_grado'";
}
if ($filtro_division) {
    $sql .= " AND division = '$filtro_division'";
}
if ($filtro_nombre) {
    $sql .= " AND nombre LIKE '%$filtro_nombre%'";
}
if ($filtro_apellido) {
    $sql .= " AND apellido LIKE '%$filtro_apellido%'";
}
if ($filtro_trimestre) {
    $sql .= " AND trimestre LIKE '%$filtro_trimestre%'";
}
if ($filtro_anio) {
    $sql .= " AND anio LIKE '%$filtro_anio%'";
}

$sql .= " ORDER BY $sort_field $order LIMIT $offset, $results_per_page";
$result = $conn->query($sql); // QUERY PRINCIPAL!
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Screening de Escritura</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="/screening/css/listado.css"> -->
     
    <link rel="stylesheet" type="text/css" href="/screening/css/styles.css?1">
    <link rel="stylesheet" type="text/css" href="/screening/css/stylesListado.css?1">
    

    
    <!-- Enlace a Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <?php   $GLOBALS['titulo'] = "Screening de Escritura";
            include '../../_header.php';
    ?>

    <div class="container">
        <h1 style="display: inline-block;">Informe Individual (vista resumida)</h1>
    </div>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info">
            <?= $_SESSION['message'] ?>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <!-- FILTROS -->
    <?php include 'ListadoEscritura-filtros.php';?>

    <table class="table">
        <thead>
            <tr>
                <th><center>
                    Nombre
                    <a href="?sort=nombre&order=<?php echo $sort_field === 'nombre' ? $order_toggle : 'ASC'; ?>&grado=<?php echo $filtro_grado; ?>&division=<?php echo $filtro_division; ?>&nombre=<?php echo $filtro_nombre; ?>&apellido=<?php echo $filtro_apellido; ?>&items_per_page=<?php echo $results_per_page; ?>&page=<?php echo $current_page; ?>" style="text-decoration: none; margin-left: 5px;">
                        <?php if ($sort_field === 'nombre' && $order === 'ASC'): ?>
                            &#9650;
                        <?php elseif ($sort_field === 'nombre' && $order === 'DESC'): ?>
                            &#9660;
                        <?php else: ?>
                            &#9651;
                        <?php endif; ?>
                    </a>
                </center></th>
                <th><center>
                    Apellido
                    <a href="?sort=apellido&order=<?php echo $sort_field === 'apellido' ? $order_toggle : 'ASC'; ?>&grado=<?php echo $filtro_grado; ?>&division=<?php echo $filtro_division; ?>&nombre=<?php echo $filtro_nombre; ?>&apellido=<?php echo $filtro_apellido; ?>&items_per_page=<?php echo $results_per_page; ?>&page=<?php echo $current_page; ?>" style="text-decoration: none; margin-left: 5px;">
                        <?php if ($sort_field === 'apellido' && $order === 'ASC'): ?>
                            &#9650;
                        <?php elseif ($sort_field === 'apellido' && $order === 'DESC'): ?>
                            &#9660;
                        <?php else: ?>
                            &#9651;
                        <?php endif; ?>
                    </a>
                </center></th>
                <th><center>
                    ID del Estudiante
                    <a href="?sort=id_estudiante&order=<?php echo $sort_field === 'id_estudiante' ? $order_toggle : 'ASC'; ?>&grado=<?php echo $filtro_grado; ?>&division=<?php echo $filtro_division; ?>&nombre=<?php echo $filtro_nombre; ?>&apellido=<?php echo $filtro_apellido; ?>&items_per_page=<?php echo $results_per_page; ?>&page=<?php echo $current_page; ?>" style="text-decoration: none; margin-left: 5px;">
                        <?php if ($sort_field === 'id_estudiante' && $order === 'ASC'): ?>
                            &#9650;
                        <?php elseif ($sort_field === 'id_estudiante' && $order === 'DESC'): ?>
                            &#9660;
                        <?php else: ?>
                            &#9651;
                        <?php endif; ?>
                    </a>
                </center></th>
                <th><center>
                    Grado
                    <a href="?sort=grado&order=<?php echo $sort_field === 'grado' ? $order_toggle : 'ASC'; ?>&grado=<?php echo $filtro_grado; ?>&division=<?php echo $filtro_division; ?>&nombre=<?php echo $filtro_nombre; ?>&apellido=<?php echo $filtro_apellido; ?>&items_per_page=<?php echo $results_per_page; ?>&page=<?php echo $current_page; ?>" style="text-decoration: none; margin-left: 5px;">
                        <?php if ($sort_field === 'grado' && $order === 'ASC'): ?>
                            &#9650;
                        <?php elseif ($sort_field === 'grado' && $order === 'DESC'): ?>
                            &#9660;
                        <?php else: ?>
                            &#9651;
                        <?php endif; ?>
                    </a>
                </center></th>
                <th><center>
                    División
                    <a href="?sort=division&order=<?php echo $sort_field === 'division' ? $order_toggle : 'ASC'; ?>&grado=<?php echo $filtro_grado; ?>&division=<?php echo $filtro_division; ?>&nombre=<?php echo $filtro_nombre; ?>&apellido=<?php echo $filtro_apellido; ?>&items_per_page=<?php echo $results_per_page; ?>&page=<?php echo $current_page; ?>" style="text-decoration: none; margin-left: 5px;">
                        <?php if ($sort_field === 'division' && $order === 'ASC'): ?>
                            &#9650;
                        <?php elseif ($sort_field === 'division' && $order === 'DESC'): ?>
                            &#9660;
                        <?php else: ?>
                            &#9651;
                        <?php endif; ?>
                    </a>
                </center></th>
                <th><center>
                    Trimestre
                    <a href="?sort=trimestre&order=<?php echo $sort_field === 'trimestre' ? $order_toggle : 'ASC'; ?>&grado=<?php echo $filtro_grado; ?>&division=<?php echo $filtro_division; ?>&nombre=<?php echo $filtro_nombre; ?>&apellido=<?php echo $filtro_apellido; ?>&items_per_page=<?php echo $results_per_page; ?>&page=<?php echo $current_page; ?>" style="text-decoration: none; margin-left: 5px;">
                        <?php if ($sort_field === 'trimestre' && $order === 'ASC'): ?>
                            &#9650;
                        <?php elseif ($sort_field === 'trimestre' && $order === 'DESC'): ?>
                            &#9660;
                        <?php else: ?>
                            &#9651;
                        <?php endif; ?>
                    </a>
                </center></th>
                <th><center>
                    Año
                    <a href="?sort=anio&order=<?php echo $sort_field === 'anio' ? $order_toggle : 'ASC'; ?>&grado=<?php echo $filtro_grado; ?>&division=<?php echo $filtro_division; ?>&nombre=<?php echo $filtro_nombre; ?>&apellido=<?php echo $filtro_apellido; ?>&items_per_page=<?php echo $results_per_page; ?>&page=<?php echo $current_page; ?>" style="text-decoration: none; margin-left: 5px;">
                        <?php if ($sort_field === 'anio' && $order === 'ASC'): ?>
                            &#9650;
                        <?php elseif ($sort_field === 'anio' && $order === 'DESC'): ?>
                            &#9660;
                        <?php else: ?>
                            &#9651;
                        <?php endif; ?>
                    </a>
                </center></th>
                <th><center>
                    Total Puntos
                    <a href="?sort=total_puntos&order=<?php echo $sort_field === 'total_puntos' ? $order_toggle : 'ASC'; ?>&grado=<?php echo $filtro_grado; ?>&division=<?php echo $filtro_division; ?>&nombre=<?php echo $filtro_nombre; ?>&apellido=<?php echo $filtro_apellido; ?>&items_per_page=<?php echo $results_per_page; ?>&page=<?php echo $current_page; ?>" style="text-decoration: none; margin-left: 5px;">
                        <?php if ($sort_field === 'total_puntos' && $order === 'ASC'): ?>
                            &#9650;
                        <?php elseif ($sort_field === 'total_puntos' && $order === 'DESC'): ?>
                            &#9660;
                        <?php else: ?>
                            &#9651;
                        <?php endif; ?>
                    </a>
                </center></th>
                <th><center>Archivo</center></th>
                <th><center>Acciones</center></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($row['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($row['id_estudiante']); ?></td>
                        <td><?php echo htmlspecialchars($row['grado']); ?></td>
                        <td><?php echo htmlspecialchars($row['division']); ?></td>
                        <td><?php echo htmlspecialchars($row['trimestre']); ?></td>
                        <td><?php echo htmlspecialchars($row['anio']); ?></td>
                        <td><?php echo htmlspecialchars($row['total_puntos']); ?></td>
                        <td style="text-align: center;">
                            <?php if (!empty($row['archivo'])): ?>
                                <i class="fas fa-check-circle icon-yes"></i>
                            <?php else: ?>
                                <i class="fas fa-times-circle icon-no"></i>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: center;">
                            <!-- Aquí puedes agregar acciones como ver, editar, borrar -->
                            <a href="../ver_evaluacion.php?id=<?php echo $row['id']; ?>" class="btn btn-info" title="Ver"><i class="fa fa-eye"></i></a>
                            <a href="../editar.php?id=<?php echo $row['id']; ?>" class="btn btn-warning" title="Editar"><i class="fa fa-edit"></i></a>
                            <a href="../delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?');"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">No hay evaluaciones registradas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Navegación de Paginación y Total de Alumnos -->
    <div class="pagination">
        <div class="total-alumnos">Total de alumnos: <?php echo $total_rows; ?></div>
        <div>
            <?php if ($current_page > 1): ?>
                <a href="?page=<?php echo $current_page - 1; ?>&sort=<?php echo $sort_field; ?>&order=<?php echo $order; ?>&grado=<?php echo $filtro_grado; ?>&division=<?php echo $filtro_division; ?>&nombre=<?php echo $filtro_nombre; ?>&apellido=<?php echo $filtro_apellido; ?>&items_per_page=<?php echo $results_per_page; ?>">&laquo; Anterior</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>&sort=<?php echo $sort_field; ?>&order=<?php echo $order; ?>&grado=<?php echo $filtro_grado; ?>&division=<?php echo $filtro_division; ?>&nombre=<?php echo $filtro_nombre; ?>&apellido=<?php echo $filtro_apellido; ?>&items_per_page=<?php echo $results_per_page; ?>" <?php if ($i == $current_page) echo 'class="active"'; ?>><?php echo $i; ?></a>
            <?php endfor; ?>

            <?php if ($current_page < $total_pages): ?>
                <a href="?page=<?php echo $current_page + 1; ?>&sort=<?php echo $sort_field; ?>&order=<?php echo $order; ?>&grado=<?php echo $filtro_grado; ?>&division=<?php echo $filtro_division; ?>&nombre=<?php echo $filtro_nombre; ?>&apellido=<?php echo $filtro_apellido; ?>&items_per_page=<?php echo $results_per_page; ?>">Siguiente &raquo;</a>
            <?php endif; ?>
        </div>
    </div>


<script type="text/javascript">
    document.getElementById('printBtn').addEventListener('click', () => { window.print() }); // Prints area to which class was assigned only
</script>

<BR><?php include '../../_footer.php';?>

</body>
</html>