<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    echo 'Debes iniciar sesión para comentar.';
    exit;
}

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo 'No se ha enviado ningún formulario.';
    exit;
}

require 'functions.php';

$publicacion_id = $_POST['publicacion_id'];
$usuario_id = $_SESSION['usuario_id'];
$comentario = $_POST['comentario'];

$conn = connect();

// Verifica la conexión a la base de datos
if ($conn === null) {
    echo 'Error de conexión a la base de datos';
    exit;
}

$sql = "INSERT INTO comentarios (publicacion_id, usuario_id, comentario) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('iis', $publicacion_id, $usuario_id, $comentario);

// Verifica la ejecución de la consulta SQL
if (!$stmt->execute()) {
    echo 'Error al ejecutar la consulta SQL: ' . $stmt->error;
    exit;
}

$conn->close();

header('Location: ../index.php');