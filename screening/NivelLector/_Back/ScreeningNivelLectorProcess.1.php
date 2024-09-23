<?php
session_start();

// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar datos del formulario
    $name = htmlspecialchars(trim($_POST['name']));
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $schooling = htmlspecialchars(trim($_POST['schooling']));
    $age = (int) htmlspecialchars(trim($_POST['age'])); // Convertir a entero
    $grade = htmlspecialchars(trim($_POST['grade']));
    $division = htmlspecialchars(trim($_POST['division']));
    $school = htmlspecialchars(trim($_SESSION['school']));
    $locality = htmlspecialchars(trim($_SESSION['locality']));
    $province = htmlspecialchars(trim($_SESSION['province']));
    $country = htmlspecialchars(trim($_SESSION['country']));
    $type = htmlspecialchars(trim($_SESSION['type']));

    // Validar que los campos no estén vacíos
    if (!empty($name) && !empty($lastname) && !empty($schooling) && !empty($age) && !empty($grade) && !empty($division) && !empty($school) && !empty($locality) && !empty($province) && !empty($country) && !empty($type)) {
        // Preparar y vincular
        $stmt = $conn->prepare("INSERT INTO screening (name, lastname, schooling, age, grade, division, school, locality, province, country, type, Fecha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        if ($stmt) {
            $stmt->bind_param("sssssssssss", $name, $lastname, $schooling, $age, $grade, $division, $school, $locality, $province, $country, $type);

            // Ejecutar la consulta
            if ($stmt->execute() === TRUE) {
                // Redirigir al juego de screening
                header("Location: ScreeningNivelLectorScreening.php");
                exit();
            } else {
                echo "Error al ejecutar la consulta: " . $stmt->error;
            }

            // Cerrar declaración
            $stmt->close();
        } else {
            echo "Error al preparar la consulta: " . $conn->error;
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
} else {
    echo "No se envió ningún formulario.";
}

// Cerrar conexión
$conn->close();
?>

