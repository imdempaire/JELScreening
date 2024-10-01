<?php   session_start();
        include "../../_conexionMySQL.php";

// Inicializar variables de sesión si no están ya establecidas
if (!isset($_SESSION['start_time'])) {
    $_SESSION['correct_answers'] = 0;           // Contador de respuestas correctas
    $_SESSION['correct_question_ids'] = [];     // IDs de preguntas correctas
    $_SESSION['incorrect_question_ids'] = [];   // IDs de preguntas incorrectas
    $_SESSION['start_time'] = time();           // Tiempo de inicio del juego
    $_SESSION['question_index'] = 0;            // Índice de la pregunta actual
    $_SESSION['current_level'] = 1;             // Nivel actual de las preguntas
    $_SESSION['consecutive_correct'] = 0;       // Contador de respuestas correctas consecutivas
}

// Procesar la respuesta anterior si la hay
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $answer = isset($_POST['answer']) ? (int)$_POST['answer'] : -1;
    $current_question_id = $_POST['question_id'];

    // Verificar la respuesta
    $sql = "SELECT correct_answer FROM questions WHERE id = $current_question_id";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($row['correct_answer'] == $answer) {                                                    
            // Respuesta correcta
            $_SESSION['correct_answers']++;                                                                 // Incremento el contador de preguntas correctas
            $_SESSION['consecutive_correct']++;                                                             // Incremento el contador de preguntas correctas consecutivas
            $_SESSION['correct_question_ids'][] = $current_question_id;                                     // Sumo la rta correcta al array de preguntas correctas

            // Verificar si debe cambiar de nivel
            if ($_SESSION['current_level'] == 1 && $_SESSION['consecutive_correct'] >= 3) {                // Salto el nivel 1 a 2 con 10 rtas consecutivas correctas
                $_SESSION['current_level']++;
                $_SESSION['consecutive_correct'] = 0;
                echo "<script>alert('Has pasado al nivel " . $_SESSION['current_level'] . "');</script>";   // Mostrar mensaje de debug cuando pasa de nivel 1 a 2
            } elseif ($_SESSION['current_level'] == 2 && $_SESSION['consecutive_correct'] >= 5) {           // Salto el nivel 2 a 3 con 15 rtas consecutivas correctas
                $_SESSION['current_level']++;
                $_SESSION['consecutive_correct'] = 0;
                echo "<script>alert('Has pasado al nivel " . $_SESSION['current_level'] . "');</script>";   // Mostrar mensaje de debug cuando pasa de nivel 2 a 3
            }
        } else {
            // Respuesta incorrecta
            $_SESSION['consecutive_correct'] = 0;
            $_SESSION['incorrect_question_ids'][] = $current_question_id;
        }
    }

    // Incrementar el índice de la pregunta
    $_SESSION['question_index']++;

    // Verificar si el tiempo se ha agotado
    if ((time() - $_SESSION['start_time']) >= 60) {
        // Redirigir a la página de resultados si se ha acabado el tiempo
        header("Location: ScreeningNivelLectorTResults.php");
        exit();
    }
}

// Obtener la siguiente pregunta en el orden del nivel actual
$sql = "SELECT id, question, Nivel, Clase FROM questions WHERE Nivel = " . $_SESSION['current_level'] . " ORDER BY id LIMIT 1 OFFSET " . $_SESSION['question_index'];
$result = $conn->query($sql);
$current_question = $result->fetch_assoc();

// Verificar si no hay más preguntas en el nivel actual
if (!$current_question) {
    // Cambiar al siguiente nivel si no hay más preguntas en el nivel actual
    $_SESSION['current_level']++;
    $_SESSION['question_index'] = 0;
    $sql = "SELECT id, question, Nivel, Clase FROM questions WHERE Nivel = " . $_SESSION['current_level'] . " ORDER BY id LIMIT 1 OFFSET " . $_SESSION['question_index'];
    $result = $conn->query($sql);
    $current_question = $result->fetch_assoc();

    // Si no hay más preguntas en el siguiente nivel, redirigir a la página de resultados
    if (!$current_question) {
        header("Location: ScreeningNivelLectorTResults.php");
        exit();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Screening</title>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
    <script>
        // Inicializar el temporizador de 60 segundos
        let timeLeft = <?php echo 60 - (time() - $_SESSION['start_time']); ?>;
        function startTimer() {
            const timer = setInterval(function() {
                timeLeft--;
                document.getElementById('timer').innerHTML = 'Tiempo restante: ' + timeLeft + 's';
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    document.getElementById('screeningForm').submit();
                }
            }, 1000);
        }
        window.onload = startTimer;
    </script>
    <style>
        .answer-btn {
            border: none;
            background: none;
            cursor: pointer;
        }
        .answer-btn img {
            width: 50px; /* Ajusta el tamaño de las imágenes según sea necesario */
        }
    </style>
</head>
<body>
    <?php   $GLOBALS['titulo'] = "Screening de Lectura de JEL Aprendizaje";
        include "../../_header.php";
    ?>
    <div class="content">
        
        <div class="subtitle">Screening en curso...</div><br><br>

        <div id="timer">Tiempo restante: <?php echo 60 - (time() - $_SESSION['start_time']); ?>s</div>
        <p><strong>Nivel:</strong> <?php echo $current_question['Nivel']; ?></p>
        <p><strong>Clase:</strong> <?php echo $current_question['Clase']; ?></p>
        <form id="screeningForm" action="ScreeningNivelLectorScreening.php" method="post">
            <input type="hidden" name="question_id" value="<?php echo $current_question['id']; ?>">
            <p>
                <label><?php echo $current_question['question']; ?></label><br>
                <button type="submit" name="answer" value="1" class="answer-btn">
                    <img src="/images/check.png" alt="Verdadero">
                </button>
                <button type="submit" name="answer" value="0" class="answer-btn">
                    <img src="/images/cross.png" alt="Falso">
                </button>
            </p>
        </form>
    </div>
</body>
</html>
