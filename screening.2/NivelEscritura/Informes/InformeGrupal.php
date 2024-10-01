<?php
session_start();
include '../../_conexionMySQL.php';

// Obtener el nombre del colegio de la sesión
$nombre_colegio = $_SESSION["Nombre"];

// Obtener todos los grados disponibles
$sql_grados = "SELECT DISTINCT grado FROM evaluaciones WHERE colegio = '$nombre_colegio'";
$result_grados = $conn->query($sql_grados);

$grados_disponibles = [];

if ($result_grados->num_rows > 0) {
    while ($row = $result_grados->fetch_assoc()) {
        $grados_disponibles[] = $row['grado'];
    }
}

// Obtener el grado seleccionado
$grado_seleccionado = isset($_POST['grado']) ? $_POST['grado'] : $grados_disponibles[0];

// Obtener las divisiones disponibles según el grado seleccionado
$sql_divisiones = "SELECT DISTINCT division FROM evaluaciones WHERE colegio = '$nombre_colegio' AND grado = '$grado_seleccionado'";
$result_divisiones = $conn->query($sql_divisiones);

$divisiones_disponibles = [];

if ($result_divisiones->num_rows > 0) {
    while ($row = $result_divisiones->fetch_assoc()) {
        $divisiones_disponibles[] = $row['division'];
    }
}

// Obtener la división seleccionada
$division_seleccionada = isset($_POST['division']) ? $_POST['division'] : $divisiones_disponibles[0];

// OBTENER LOS DATOS PARA LOS GRÁFICOS DE BARRAS

        // Obtener los datos para el gráfico de promedio de total_puntos
        $sql = "SELECT grado, AVG(total_puntos) as promedio_puntos FROM evaluaciones WHERE colegio = '$nombre_colegio' AND grado = '$grado_seleccionado' AND division = '$division_seleccionada' GROUP BY grado";
        $result = $conn->query($sql);
        $grados = [];
        $promedio_puntos = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $grados[] = $row['grado'];
                $promedio_puntos[] = $row['promedio_puntos'];
            }
        }

        // Obtener los datos para el gráfico de total_puntos_grafismo
        $sql_total_puntos_grafismo = "SELECT grado, AVG(total_puntos_grafismo) as promedio_total_puntos_grafismo FROM evaluaciones WHERE colegio = '$nombre_colegio' AND grado = '$grado_seleccionado' AND division = '$division_seleccionada' GROUP BY grado";
        $result_total_puntos_grafismo = $conn->query($sql_total_puntos_grafismo);
        $promedio_total_puntos_grafismo = [];
        if ($result_total_puntos_grafismo->num_rows > 0) {
            while ($row = $result_total_puntos_grafismo->fetch_assoc()) {
                $promedio_total_puntos_grafismo[] = $row['promedio_total_puntos_grafismo'];
            }
        }

                // Obtener los datos para el gráfico de promedio de tipografia
                $sql_tipografia = "SELECT grado, AVG(tipografia) as promedio_tipografia FROM evaluaciones WHERE colegio = '$nombre_colegio' AND grado = '$grado_seleccionado' AND division = '$division_seleccionada' GROUP BY grado";
                $result_tipografia = $conn->query($sql_tipografia);
                $promedio_tipografia = [];
                if ($result_tipografia->num_rows > 0) {
                    while ($row = $result_tipografia->fetch_assoc()) {
                        $promedio_tipografia[] = $row['promedio_tipografia'];
                    }
                }

                // Obtener los datos para el gráfico de promedio de claridad
                $sql_claridad = "SELECT grado, AVG(claridad) as promedio_claridad FROM evaluaciones WHERE colegio = '$nombre_colegio' AND grado = '$grado_seleccionado' AND division = '$division_seleccionada' GROUP BY grado";
                $result_claridad = $conn->query($sql_claridad);
                $promedio_claridad = [];
                if ($result_claridad->num_rows > 0) {
                    while ($row = $result_claridad->fetch_assoc()) {
                        $promedio_claridad[] = $row['promedio_claridad'];
                    }
                }

                // Obtener los datos para el gráfico de promedio de tamano
                $sql_tamano = "SELECT grado, AVG(tamano) as promedio_tamano FROM evaluaciones WHERE colegio = '$nombre_colegio' AND grado = '$grado_seleccionado' AND division = '$division_seleccionada' GROUP BY grado";
                $result_tamano = $conn->query($sql_tamano);
                $promedio_tamano = [];
                if ($result_tamano->num_rows > 0) {
                    while ($row = $result_tamano->fetch_assoc()) {
                        $promedio_tamano[] = $row['promedio_tamano'];
                    }
                }

                // Obtener los datos para el gráfico de promedio de presion
                $sql_presion = "SELECT grado, AVG(presion) as promedio_presion FROM evaluaciones WHERE colegio = '$nombre_colegio' AND grado = '$grado_seleccionado' AND division = '$division_seleccionada' GROUP BY grado";
                $result_presion = $conn->query($sql_presion);
                $promedio_presion = [];
                if ($result_presion->num_rows > 0) {
                    while ($row = $result_presion->fetch_assoc()) {
                        $promedio_presion[] = $row['promedio_presion'];
                    }
                }

                // Obtener los datos para el gráfico de emplazamiento_renlon
                $sql_emplazamiento_renglon = "SELECT grado, AVG(emplazamiento_renglon) as promedio_emplazamiento_renglon FROM evaluaciones WHERE colegio = '$nombre_colegio' AND grado = '$grado_seleccionado' AND division = '$division_seleccionada' GROUP BY grado";
                $result_emplazamiento_renglon = $conn->query($sql_emplazamiento_renglon);
                $promedio_emplazamiento_renglon = [];
                if ($result_emplazamiento_renglon->num_rows > 0) {
                    while ($row = $result_emplazamiento_renglon->fetch_assoc()) {
                        $promedio_emplazamiento_renglon[] = $row['promedio_emplazamiento_renglon'];
                    }
                }

        // Obtener los datos para el gráfico de total_puntos_composicion_escrita
        $sql_total_puntos_composicion_escrita = "SELECT grado, AVG(total_puntos_composicion_escrita) as promedio_total_puntos_composicion_escrita FROM evaluaciones WHERE colegio = '$nombre_colegio' AND grado = '$grado_seleccionado' AND division = '$division_seleccionada' GROUP BY grado";
        $result_total_puntos_composicion_escrita = $conn->query($sql_total_puntos_composicion_escrita);
        $promedio_total_puntos_composicion_escrita = [];
        if ($result_total_puntos_composicion_escrita->num_rows > 0) {
            while ($row = $result_total_puntos_composicion_escrita->fetch_assoc()) {
                $promedio_total_puntos_composicion_escrita[] = $row['promedio_total_puntos_composicion_escrita'];
            }
        }

                // Obtener los datos para el gráfico de repeticiones
                $sql_repeticiones = "SELECT grado, AVG(repeticiones) as promedio_repeticiones FROM evaluaciones WHERE colegio = '$nombre_colegio' AND grado = '$grado_seleccionado' AND division = '$division_seleccionada' GROUP BY grado";
                $result_repeticiones = $conn->query($sql_repeticiones);
                $promedio_repeticiones = [];
                if ($result_repeticiones->num_rows > 0) {
                    while ($row = $result_repeticiones->fetch_assoc()) {
                        $promedio_repeticiones[] = $row['promedio_repeticiones'];
                    }
                }
                
                // Obtener los datos para el gráfico de vocabulario
                $sql_vocabulario = "SELECT grado, AVG(vocabulario) as promedio_vocabulario FROM evaluaciones WHERE colegio = '$nombre_colegio' AND grado = '$grado_seleccionado' AND division = '$division_seleccionada' GROUP BY grado";
                $result_vocabulario = $conn->query($sql_vocabulario);
                $promedio_vocabulario = [];
                if ($result_vocabulario->num_rows > 0) {
                    while ($row = $result_vocabulario->fetch_assoc()) {
                        $promedio_vocabulario[] = $row['promedio_vocabulario'];
                    }
                }

                // Obtener los datos para el gráfico de conectores
                $sql_conectores = "SELECT grado, AVG(conectores) as promedio_conectores FROM evaluaciones WHERE colegio = '$nombre_colegio' AND grado = '$grado_seleccionado' AND division = '$division_seleccionada' GROUP BY grado";
                $result_conectores = $conn->query($sql_conectores);
                $promedio_conectores = [];
                if ($result_conectores->num_rows > 0) {
                    while ($row = $result_conectores->fetch_assoc()) {
                        $promedio_conectores[] = $row['promedio_conectores'];
                    }
                }

                // Obtener los datos para el gráfico de longitud
                $sql_longitud = "SELECT grado, AVG(longitud) as promedio_longitud FROM evaluaciones WHERE colegio = '$nombre_colegio' AND grado = '$grado_seleccionado' AND division = '$division_seleccionada' GROUP BY grado";
                $result_longitud = $conn->query($sql_longitud);
                $promedio_longitud = [];
                if ($result_longitud->num_rows > 0) {
                    while ($row = $result_longitud->fetch_assoc()) {
                        $promedio_longitud[] = $row['promedio_longitud'];
                    }
                }

        // Obtener los datos para el gráfico de total_puntos_convenciones
        $sql_total_puntos_convenciones = "SELECT grado, AVG(total_puntos_convenciones) as promedio_total_puntos_convenciones FROM evaluaciones WHERE colegio = '$nombre_colegio' AND grado = '$grado_seleccionado' AND division = '$division_seleccionada' GROUP BY grado";
        $result_total_puntos_convenciones = $conn->query($sql_total_puntos_convenciones);
        $promedio_total_puntos_convenciones = [];
        if ($result_total_puntos_convenciones->num_rows > 0) {
            while ($row = $result_total_puntos_convenciones->fetch_assoc()) {
                $promedio_total_puntos_convenciones[] = $row['promedio_total_puntos_convenciones'];
            }
        }

                // Obtener los datos para el gráfico de puntuacion
                $sql_puntuacion = "SELECT grado, AVG(puntuacion) as promedio_puntuacion FROM evaluaciones WHERE colegio = '$nombre_colegio' AND grado = '$grado_seleccionado' AND division = '$division_seleccionada' GROUP BY grado";
                $result_puntuacion = $conn->query($sql_puntuacion);
                $promedio_puntuacion = [];
                if ($result_puntuacion->num_rows > 0) {
                    while ($row = $result_puntuacion->fetch_assoc()) {
                        $promedio_puntuacion[] = $row['promedio_puntuacion'];
                    }
                }

                // Obtener los datos para el gráfico de uso_mayuscula
                $sql_uso_mayuscula = "SELECT grado, AVG(uso_mayuscula) as promedio_uso_mayuscula FROM evaluaciones WHERE colegio = '$nombre_colegio' AND grado = '$grado_seleccionado' AND division = '$division_seleccionada' GROUP BY grado";
                $result_uso_mayuscula = $conn->query($sql_uso_mayuscula);
                $promedio_uso_mayuscula = [];
                if ($result_uso_mayuscula->num_rows > 0) {
                    while ($row = $result_uso_mayuscula->fetch_assoc()) {
                        $promedio_uso_mayuscula[] = $row['promedio_uso_mayuscula'];
                    }
                }
                
                // Obtener los datos para el gráfico de correspondencia_fonologica
                $sql_correspondencia_fonologica = "SELECT grado, AVG(correspondencia_fonologica) as promedio_correspondencia_fonologica FROM evaluaciones WHERE colegio = '$nombre_colegio' AND grado = '$grado_seleccionado' AND division = '$division_seleccionada' GROUP BY grado";
                $result_correspondencia_fonologica = $conn->query($sql_correspondencia_fonologica);
                $promedio_correspondencia_fonologica = [];
                if ($result_correspondencia_fonologica->num_rows > 0) {
                    while ($row = $result_correspondencia_fonologica->fetch_assoc()) {
                        $promedio_correspondencia_fonologica[] = $row['promedio_correspondencia_fonologica'];
                    }
                }

                // Obtener los datos para el gráfico de correspondencia_ortografica
                $sql_correspondencia_ortografica = "SELECT grado, AVG(correspondencia_ortografica) as promedio_correspondencia_ortografica FROM evaluaciones WHERE colegio = '$nombre_colegio' AND grado = '$grado_seleccionado' AND division = '$division_seleccionada' GROUP BY grado";
                $result_correspondencia_ortografica = $conn->query($sql_correspondencia_ortografica);
                $promedio_correspondencia_ortografica = [];
                if ($result_correspondencia_ortografica->num_rows > 0) {
                    while ($row = $result_correspondencia_ortografica->fetch_assoc()) {
                        $promedio_correspondencia_ortografica[] = $row['promedio_correspondencia_ortografica'];
                    }
                }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Screening de Escritura</title>

    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" type="text/css" href="../../css/styles.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <?php   $GLOBALS['titulo'] = "Screening de Escritura";
            include '../../_header.php';
    ?>

    <div class="container">
        <h1>Informe Grupal</h1>
        <button class="btn btn-primary" onclick="window.print()">Imprimir Página</button><br><br>
        <form method="post" action="">
            <div class="mb-3">
                <label for="grado" class="form-label">Seleccione el Grado</label>
                <select class="form-select" id="grado" name="grado" onchange="this.form.submit()">
                    <?php foreach ($grados_disponibles as $grado): ?>
                        <option value="<?= $grado ?>" <?= $grado == $grado_seleccionado ? 'selected' : '' ?>><?= $grado ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="division" class="form-label">Seleccione la División</label>
                <select class="form-select" id="division" name="division" onchange="this.form.submit()">
                    <?php foreach ($divisiones_disponibles as $division): ?>
                        <option value="<?= $division ?>" <?= $division == $division_seleccionada ? 'selected' : '' ?>><?= $division ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>

        <h2><center>Puntos totales (%)</center></h2>
        <canvas id="myChartPuntosTotales" height="8" width="100"></canvas>
        
        <br><br><br>
        <h2><center>Grafismo (%)</center></h2>
        <canvas id="myChartPuntosTotalesGrafismo" height="8" width="100"></canvas>
        <br><br>
            <!-- <h2><center>Detalle Grafismo (%)</center></h2> -->
            <canvas id="myChartDetalleGrafismo" height="24" width="100"></canvas>
            <!-- <h2><center>Tipografía (%)</center></h2> -->
            <!-- <canvas id="myChartTipografia" height="24" width="100"></canvas> -->
            <!-- <h2><center>Claridad (%)</center></h2> -->
            <!-- <canvas id="myChartClaridad" height="8" width="100"></canvas> -->
            <!-- <h2><center>Tamaño (%)</center></h2> -->
            <!-- <canvas id="myChartTamano" height="8" width="100"></canvas>  -->
            <!-- <h2><center>Presión (%)</center></h2> -->
            <!-- <canvas id="myChartPresion" height="8" width="100"></canvas> -->
            <!-- <h2><center>Emplazamiento en el renglón (%)</center></h2> -->
            <!-- <canvas id="myChartEmplazamientoRenglon" height="8" width="100"></canvas> -->
        
        <br><br><br>
        <h2><center>Composición escrita (%)</center></h2>
        <canvas id="myChartPuntosTotalesComposicionEscrita" height="8" width="100"></canvas>
        <br><br>
            <!-- <h2><center>Detalle ComposicionEscrita (%)</center></h2> -->
            <canvas id="myChartComposicionEscrita" height="20" width="100"></canvas>
            <!-- <h2><center>Repeticiones (%)</center></h2> -->
            <!-- <canvas id="myChartRepeticiones" height="8" width="100"></canvas> -->
            <!-- <h2><center>Vocabulario (%)</center></h2> -->
            <!-- <canvas id="myChartVocabulario" height="8" width="100"></canvas> -->
            <!-- <h2><center>Conectores (%)</center></h2> -->
            <!-- <canvas id="myChartConectores" height="8" width="100"></canvas> -->
            <!-- <h2><center>Longitud (%)</center></h2> -->
            <!-- <canvas id="myChartLongitud" height="8" width="100"></canvas> -->

        <br><br><br>
        <h2><center>Convenciones (%)</center></h2>
        <canvas id="myChartPuntosTotalesConvenciones" height="8" width="100"></canvas>
        <br><br>
            <!-- <h2><center>Detalle Convenciones (%)</center></h2> -->
            <canvas id="myChartConvenciones" height="20" width="100"></canvas>

    </div>
    <script>

        function printPage() {
            window.print();
        }

        // Obtener los datos de PHP
        const grados = <?php echo json_encode($grados); ?>;
        const promedioPuntos = <?php echo json_encode($promedio_puntos); ?>;
        const promedioPuntosGrafismo = <?php echo json_encode($promedio_total_puntos_grafismo); ?>;
            const promedioTipografia = <?php echo json_encode($promedio_tipografia); ?>;
            const promedioClaridad = <?php echo json_encode($promedio_claridad); ?>;
            const promedioTamano = <?php echo json_encode($promedio_tamano); ?>;
            const promedioPresion = <?php echo json_encode($promedio_presion); ?>;
            const promedioEmplazamientoRenglon = <?php echo json_encode($promedio_emplazamiento_renglon); ?>;
        const promedioPuntosComposicionEscrita = <?php echo json_encode($promedio_total_puntos_composicion_escrita); ?>;
            const promedioRepeticiones = <?php echo json_encode($promedio_repeticiones); ?>;
            const promedioVocabulario = <?php echo json_encode($promedio_vocabulario); ?>;
            const promedioConectores = <?php echo json_encode($promedio_conectores); ?>;
            const promedioLongitud = <?php echo json_encode($promedio_longitud); ?>;
        const promedioPuntosConvenciones = <?php echo json_encode($promedio_total_puntos_convenciones); ?>;
            const promedioPuntuacion = <?php echo json_encode($promedio_puntuacion); ?>;
            const promedioUsoMayuscula = <?php echo json_encode($promedio_uso_mayuscula); ?>;
            const promedioCorrespondenciaFonologica = <?php echo json_encode($promedio_correspondencia_fonologica); ?>;
            const promedioCorrespondenciaOrtografica = <?php echo json_encode($promedio_correspondencia_ortografica); ?>;

    // CONVERRTIR LOS DATOS A PORCENTAJES

        // Convertir los puntos a porcentajes
        const maxPuntos = 52;
        const promedioPuntosPorcentaje = promedioPuntos.map(punto => (punto / maxPuntos) * 100);

        // Convertir los puntos_grafismo a porcentajes
        const maxPuntosGrafismo = 20;
        const promedioPuntosGrafismoPorcentaje = promedioPuntosGrafismo.map(total_puntos_grafismo => (total_puntos_grafismo / maxPuntosGrafismo) * 100);

            // Convertir la tipografia a porcentajes
            const maxTipografia = 4; // Ajusta este valor según el máximo posible de tipografia
            const promedioTipografiaPorcentaje = promedioTipografia.map(tipografia => (tipografia / maxTipografia) * 100);

            // Convertir la claridad a porcentajes
            const maxClaridad = 4; // Ajusta este valor según el máximo posible de claridad
            const promedioClaridadPorcentaje = promedioClaridad.map(claridad => (claridad / maxClaridad) * 100);

            // Convertir el tamaño a porcentajes
            const maxTamano = 4; // Ajusta este valor según el máximo posible de tamaño
            const promedioTamanoPorcentaje = promedioTamano.map(tamano => (tamano / maxTamano) * 100);

            // Convertir la presión a porcentajes
            const maxPresion = 4; // Ajusta este valor según el máximo posible de tamaño
            const promedioPresionPorcentaje = promedioPresion.map(presion => (presion / maxPresion) * 100);

            // Convertir el emplazamiento en el renglon a porcentajes
            const maxEmplazamientoRenglon = 4; // Ajusta este valor según el máximo posible de tamaño
            const promedioEmplazamientoRenglonPorcentaje = promedioEmplazamientoRenglon.map(emplazamiento_renglon => (emplazamiento_renglon / maxEmplazamientoRenglon) * 100);

        // Convertir los puntos_composicion_escrita a porcentajes
        const maxPuntosComposicionEscrita = 16;
        const promedioPuntosComposicionEscritaPorcentaje = promedioPuntosComposicionEscrita.map(total_puntos_composicion_escrita => (total_puntos_composicion_escrita / maxPuntosComposicionEscrita) * 100);

            // Convertir las repeticiones a porcentajes
            const maxRepeticiones = 4; // Ajusta este valor según el máximo posible de repeticiones
            const promedioRepeticionesPorcentaje = promedioRepeticiones.map(repeticiones => (repeticiones / maxRepeticiones) * 100);

            // Convertir el vocabulario a porcentajes
            const maxVocabulario = 4; // Ajusta este valor según el máximo posible de vocabulario
            const promedioVocabularioPorcentaje = promedioVocabulario.map(vocabulario => (vocabulario / maxVocabulario) * 100);

            // Convertir los conectores a porcentajes
            const maxConectores = 4; // Ajusta este valor según el máximo posible de conectores
            const promedioConectoresPorcentaje = promedioConectores.map(conectores => (conectores / maxConectores) * 100);

            // Convertir los conectores a longitud
            const maxLongitud = 4; // Ajusta este valor según el máximo posible de longitud
            const promedioLongitudPorcentaje = promedioLongitud.map(longitud => (longitud / maxLongitud) * 100);

        // Convertir los puntos_convenciones a porcentajes
        const maxPuntosConvenciones = 16;
        const promedioPuntosConvencionesPorcentaje = promedioPuntosConvenciones.map(total_puntos_convenciones => (total_puntos_convenciones / maxPuntosConvenciones) * 100);

            // Convertir la puntuacion a porcentajes
            const maxPuntuacion = 4; // Ajusta este valor según el máximo posible de puntuacion
            const promedioPuntuacionPorcentaje = promedioPuntuacion.map(puntuacion => (puntuacion / maxPuntuacion) * 100);
            
            // Convertir el uso_mayuscula a porcentajes
            const maxUsoMayuscula = 4; // Ajusta este valor según el máximo posible de uso_mayuscula
            const promedioUsoMayusculaPorcentaje = promedioUsoMayuscula.map(uso_mayuscula => (uso_mayuscula / maxUsoMayuscula) * 100);

            // Convertir la correspondencia_fonologica a porcentajes
            const maxCorrespondenciaFonologica = 4; // Ajusta este valor según el máximo posible de correspondencia_fonologica
            const promedioCorrespondenciaFonologicaPorcentaje = promedioCorrespondenciaFonologica.map(correspondencia_fonologica => (correspondencia_fonologica / maxCorrespondenciaFonologica) * 100);

            // Convertir la correspondencia_ortografica a porcentajes
            const maxCorrespondenciaOrtografica = 4; // Ajusta este valor según el máximo posible de correspondencia_ortografica
            const promedioCorrespondenciaOrtograficaPorcentaje = promedioCorrespondenciaOrtografica.map(correspondencia_ortografica => (correspondencia_ortografica / maxCorrespondenciaOrtografica) * 100);
            
    // CEACIÓN DE LOS GRÁFICOS
    <?php include 'InformeGrupal-Graficos.php'; ?>

    </script>
</body>
</html>