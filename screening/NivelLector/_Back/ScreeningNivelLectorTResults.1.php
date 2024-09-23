<?php   session_start();
        include "../../_conexionMySQL.php";

// Obtener el ID del último usuario insertado
$sql = "SELECT id FROM screening ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
$user_id = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row['id'];
}

// Inicializar contadores
$total_correct = count($_SESSION['correct_question_ids']);
$total_incorrect = count($_SESSION['incorrect_question_ids']);
$correct_conectores = 0;
$correct_contenido = 0;
$correct_decodificacion = 0;
$incorrect_conectores = 0;
$incorrect_contenido = 0;
$incorrect_decodificacion = 0;

// Contar respuestas correctas por clase
if (!empty($_SESSION['correct_question_ids'])) {
    $ids = implode(',', $_SESSION['correct_question_ids']);
    $sql = "SELECT id, clase FROM questions WHERE id IN ($ids)";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['clase'] == 'conectores') {
                $correct_conectores++;
            } elseif ($row['clase'] == 'contenido') {
                $correct_contenido++;
            } elseif ($row['clase'] == 'decodificacion') {
                $correct_decodificacion++;
            }
        }
    }
}

// Contar respuestas incorrectas por clase
if (!empty($_SESSION['incorrect_question_ids'])) {
    $ids = implode(',', $_SESSION['incorrect_question_ids']);
    $sql = "SELECT id, clase FROM questions WHERE id IN ($ids)";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['clase'] == 'conectores') {
                $incorrect_conectores++;
            } elseif ($row['clase'] == 'contenido') {
                $incorrect_contenido++;
            } elseif ($row['clase'] == 'decodificacion') {
                $incorrect_decodificacion++;
            }
        }
    }
}

// Guardar los resultados en la base de datos
$correct_question_ids = implode("_", $_SESSION['correct_question_ids']);
$incorrect_question_ids = implode("_", $_SESSION['incorrect_question_ids']);
$sql = "UPDATE screening SET RespCorrectas='$correct_question_ids', RespIncorrectas='$incorrect_question_ids', Bien=$total_correct, Mal=$total_incorrect, BienConect=$correct_conectores, BienCont=$correct_contenido, BienDeco=$correct_decodificacion, MalConect=$incorrect_conectores, MalCont=$incorrect_contenido, MalDeco=$incorrect_decodificacion WHERE id=$user_id";

if ($conn->query($sql) === TRUE) {
    echo "Actualización exitosa.<br>";
} else {
    echo "Error al actualizar los resultados: " . $conn->error . "<br>";
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Resultados del Screening</title>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
    <?php   $GLOBALS['titulo'] = "Screening de Lectura de JEL Aprendizaje";
            include "../../_header.php";
    ?> 
    <div class="content">
        <div class="subtitle">Resultados del Screening</div><br><br>
        <p>Has respondido correctamente <?php echo $total_correct; ?> preguntas.</p>
        <p>Has respondido incorrectamente <?php echo $total_incorrect; ?> preguntas.</p>
        <p>Has respondido correctamente <?php echo $correct_conectores; ?> preguntas de Conectores.</p>
        <p>Has respondido correctamente <?php echo $correct_contenido; ?> preguntas de Contenido.</p>
        <p>Has respondido correctamente <?php echo $correct_decodificacion; ?> preguntas de Decodificación.</p>
        <p>Has respondido incorrectamente <?php echo $incorrect_conectores; ?> preguntas de Conectores.</p>
        <p>Has respondido incorrectamente <?php echo $incorrect_contenido; ?> preguntas de Contenido.</p>
        <p>Has respondido incorrectamente <?php echo $incorrect_decodificacion; ?> preguntas de Decodificación.</p>

        <div class="record-audio">
            <p>¿Quieres grabar un audio?</p>
            <form action="ScreeningNivelLectorTResults.php" method="post">
                <button type="submit" name="record_audio" value="yes">Sí</button>
                <button type="submit" name="record_audio" value="no">No</button>
            </form>
        </div>

        // <?php
        // // Limpiar las variables de sesión
        // session_unset();
        // session_destroy();
        ?>

    </div>
</body>
</html>

<?php
// Redirigir a audio.php si el usuario selecciona "Sí"
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['record_audio'])) {
    if ($_POST['record_audio'] == "yes") {
        header("Location: /GrabacionAudio/index.php");
        exit();
    }
}
?>