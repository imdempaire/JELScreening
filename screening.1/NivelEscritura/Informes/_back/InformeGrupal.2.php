<?php
// Objetivo: Mostrar un gráfico de barras con el promedio de puntos por grado de un colegio
// Nota: Este archivo debe estar en la carpeta /screening/NivelEscritura/Informes
session_start();
include '../../_conexionMySQL.php';

// Obtener el nombre del colegio de la sesión
$nombre_colegio = $_SESSION["Nombre"];

// Obtener los datos para el gráfico
$sql = "SELECT grado, AVG(total_puntos) as promedio_puntos FROM evaluaciones WHERE colegio = '$nombre_colegio' GROUP BY grado";
$result = $conn->query($sql);

$grados = [];
$promedio_puntos = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $grados[] = $row['grado'];
        $promedio_puntos[] = $row['promedio_puntos'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico de Barras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1>Gráfico de Barras</h1>
        <canvas id="myChart" height="20" width="100"></canvas>
    </div>
    <script>
        // Obtener los datos de PHP
        const grados = <?php echo json_encode($grados); ?>;
        const promedioPuntos = <?php echo json_encode($promedio_puntos); ?>;

        // Crear el gráfico de barras horizontal
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar', // Cambiar a 'horizontalBar' para gráfico horizontal
            data: {
                labels: grados,
                datasets: [{
                    label: 'Promedio de Puntos por Grado',
                    data: promedioPuntos,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y', // Cambiar el eje de índice a 'y' para gráfico horizontal
                scales: {
                    x: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>