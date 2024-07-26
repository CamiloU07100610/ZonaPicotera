<?php
// login_process.php
session_start(); // Asegúrate de que esto está al principio del archivo

require 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = connect();

    $sql = "SELECT * FROM administradores WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        if ($password === $admin['contraseña']) {
            $_SESSION['admin_id'] = $admin['id'];
            header('Location: admin_panel.php');
            exit;
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "No existe un administrador con ese email.";
    }

    $conn->close();
}