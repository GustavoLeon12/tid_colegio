<?php
function saveImage()
{
    try {
        if (isset($_FILES['image'])) {
            $imagenTempPath = $_FILES['image']['tmp_name'];
            $nombreOriginal = $_FILES['image']['name'];
            
            // ========== SOLO ENTORNO LOCAL ==========
            
            // Usar $_SERVER['DOCUMENT_ROOT'] para obtener la ruta base del servidor web
            $basePath = $_SERVER['DOCUMENT_ROOT'];
            $uploadDir = $basePath . "/tid_colegio/imag/sistema/";
            
            // Crear directorio si no existe
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            // Generar nombre único
            $fileExt = pathinfo($nombreOriginal, PATHINFO_EXTENSION);
            $nuevoNombre = uniqid() . '_' . time() . '.' . $fileExt;
            $rutaCompleta = $uploadDir . $nuevoNombre;
            
            // Mover archivo
            if (move_uploaded_file($imagenTempPath, $rutaCompleta)) {
                return $nuevoNombre; // Solo el nombre del archivo
            } else {
                throw new Exception("Error al mover el archivo: " . $_FILES['image']['error']);
            }
            
        } else {
            throw new Exception("Image file not found in \$_FILES");
        }
    } catch (Exception $e) {
        error_log("Error en saveImage: " . $e->getMessage());
        return "ERROR";
    }
}
?>