<?php
session_start();

// Verifica si el usuario es un administrador
$es_admin = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : false;

if ($es_admin) {
    // Si el usuario es un administrador, redirige a la página de inicio
    header('Location: index.php');
} else {
    // Si el usuario no es un administrador, redirige a la página de usuario
    header('Location: index.php');
}

exit;