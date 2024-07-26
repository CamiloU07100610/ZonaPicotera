<?php

session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Inicio de sesión de administrador</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="text-center my-4">Inicio de sesión de administrador</h2>
        <form action="backend/login_process.php" method="post" class="mx-auto" style="max-width: 300px;">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <input type="submit" value="Iniciar sesión" class="btn btn-primary">
        </form>
    </div>
</body>
</html>
