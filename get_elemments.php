<?php
require 'backend/functions.php';

if (isset($_GET['publicacion_id'])) {
    $publicacion_id = $_GET['publicacion_id'];

    $conn = connect();

    // Obtén el video
    $sql = "SELECT * FROM publicaciones WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $publicacion_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $publicacion = $result->fetch_assoc();

    // Obtén los comentarios
    $sql = "SELECT * FROM comentarios WHERE publicacion_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $publicacion_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $comentarios = $result->fetch_all(MYSQLI_ASSOC);

    // Start output buffering
    ob_start();

    // Include the appropriate template based on the type of the publication
    if ($publicacion['tipo'] === 'video') {
        include 'video_and_comments_template.php';
    } elseif ($publicacion['tipo'] === 'imagen') {
        include 'image_and_comments_template.php';
    }

    // Get the contents of the buffer
    $html = ob_get_clean();

    // Return the HTML content
    echo $html;
}
?>