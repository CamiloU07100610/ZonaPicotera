<?php
// admin_panel.php
session_start(); // Asegúrate de que esto está al principio del archivo

if (!isset($_SESSION['admin_id'])) {
    header('Location: ../admin.php');
    exit;
}

require 'functions.php';
$conn = connect();

$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);
$usuarios = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel de administración</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="text-center my-4">Panel de control del administrador</h2>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="contenido" class="form-label">Contenido</label>
            <input type="file" class="form-control" id="contenido" name="contenido" required>
        </div>
        <button type="submit" class="btn btn-primary">Publicar</button>
    </form>

    <h3>Usuarios suscritos</h3>
    <table class="table">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Fecha de suscripción</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?php echo $usuario['nombre']; ?></td>
                <td><?php echo $usuario['email']; ?></td>
                <td><?php echo $usuario['fecha_suscripcion']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Eliminar publicaciones</h3>
    <form action="delete.php" method="post" class="mb-4">
        <label for="post_id" class="form-label">ID de la publicación:</label>
        <input type="number" id="post_id" name="post_id" class="form-control mb-3">
        <input type="submit" value="Eliminar" class="btn btn-danger">
    </form>

    <h3>Cerrar sesión</h3>

    <form action="logout.php" method="post">
        <button type="submit" class="btn btn-danger">Cerrar sesión</button>
    </form>

</div>
</body>
</html>
