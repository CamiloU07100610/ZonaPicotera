<?php
// Asegúrese de que $publicacion está definido y es un array
if (!isset($publicacion) || !is_array($publicacion)) {
    throw new Exception('La variable $publicacion no está definida o no es un array');
}

// Asegúrese de que la publicación es de tipo 'imagen'
if ($publicacion['tipo'] !== 'imagen') {
    throw new Exception('La publicación no es de tipo imagen');
}

// Asegúrese de que la publicación tiene contenido
if (!isset($publicacion['contenido'])) {
    throw new Exception('La publicación no tiene contenido');
}

// Muestra la imagen
echo '<img src="data:image/jpeg;base64,' . base64_encode($publicacion['contenido']) . '" alt="Imagen">';

// Muestra los comentarios de la imagen
foreach ($comentarios as $comentario) {
    echo '<p>' . htmlspecialchars($comentario['comentario']) . '</p>';
}