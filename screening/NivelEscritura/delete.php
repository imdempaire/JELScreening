<?php
session_start();
include '../_conexionMySQL.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM evaluaciones WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Registro eliminado exitosamente.";
    } else {
        $_SESSION['message'] = "Error al eliminar el registro.";
    }
    $stmt->close();
    $conn->close();
}

header("Location: listado.php");
exit();
?>