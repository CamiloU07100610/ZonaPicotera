<?php
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $fecha_suscripcion = date('Y-m-d H:i:s'); // Obtiene la fecha y hora actual del servidor

    // Aquí puedes agregar el código para guardar los datos en la base de datos
    require 'backend/functions.php';

    $conn = connect();
    $sql = "INSERT INTO usuarios (nombre, email, fecha_suscripcion) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $nombre, $email, $fecha_suscripcion);
    $stmt->execute();

    // Inicia una sesión y establece las variables de sesión
    session_start();
    $_SESSION['usuario_id'] = $stmt->insert_id;
    $_SESSION['nombre'] = $nombre;

    $conn->close();

    // Redirige al usuario a la página de agradecimiento
    header('Location: gracias.php');
    exit;
}
?>

<form action="suscripcion.php" method="post">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <button type="submit" class="btn btn-primary">Suscribirse</button>
</form>