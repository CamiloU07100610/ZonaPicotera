<?php

function connect() {
    $nombreBaseDeDatos = 'zonapicoterdb';
    $nombreUsuario = 'root';
    $contraseña = '';
    $servidor = 'localhost';

    // Crear conexión
    $conn = new mysqli($servidor, $nombreUsuario, $contraseña, $nombreBaseDeDatos);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    return $conn;
}

