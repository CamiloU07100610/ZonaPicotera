<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: ../admin.php');
    exit;
}

require 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $file = $_FILES['contenido'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowedImage = array('jpg', 'jpeg', 'png', 'gif');
    $allowedVideo = array('mp4', 'avi', 'mov', 'flv');

    if (in_array($fileExt, $allowedImage)) {
        $type = 'imagen';
    } elseif (in_array($fileExt, $allowedVideo)) {
        $type = 'video';
    } else {
        echo "No puedes subir archivos de este tipo.";
        exit;
    }

    if ($fileError === 0) {
        if ($fileSize < 500000000000) { // 5MB
            $fileContent = file_get_contents($fileTmpName);

            $conn = connect();
            $admin_id = $_SESSION['admin_id'];

            $sql = "INSERT INTO publicaciones (titulo, descripcion, administrador_id, tipo, contenido) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $null = NULL;
            $stmt->bind_param('ssisb', $titulo, $descripcion, $admin_id, $type, $null);
            $stmt->send_long_data(4, $fileContent);
            $stmt->execute();

            $conn->close();

            header('Location: admin_panel.php');
        } else {
            echo "El archivo es demasiado grande.";
        }
    } else {
        echo "Hubo un error al subir el archivo.";
    }
}
