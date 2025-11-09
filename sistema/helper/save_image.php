<?php
require_once __DIR__ . '/../../global.php';

function saveImage()
{
    try {
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['image'];
            $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            
            // Validar tipo de archivo
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($extension, $allowedTypes)) {
                throw new Exception("Formato de imagen no permitido. Use jpg, jpeg, png o gif.");
            }

            // Generar un nombre único para la imagen
            $nombreArchivo = 'noticia_' . time() . '_' . uniqid() . '.' . $extension;
            $rutaDestino = $GLOBALS['images_path'] . $nombreArchivo;

            // Mover la imagen al directorio local
            if (!move_uploaded_file($file['tmp_name'], $rutaDestino)) {
                throw new Exception("Error al mover la imagen al servidor.");
            }

            return $nombreArchivo;
        } else {
            return 'default.jpg'; // Fallback si no se subió ninguna imagen
        }
    } catch (Exception $e) {
        error_log("saveImage error: " . $e->getMessage());
        return 'default.jpg'; // Fallback en caso de error
    }
}
?>