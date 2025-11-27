<?php
function saveImage()
{
    try {
        if (isset($_FILES['image'])) {
            $imagenTempPath = $_FILES['image']['tmp_name'];
            $nombreOriginal = $_FILES['image']['name'];
            
            // DETECTAR SI ES ENTORNO LOCAL
            $isLocal = ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_NAME'] === '127.0.0.1');
            
            if ($isLocal) {
                // ========== ENTORNO LOCAL ==========
                $uploadDir = "C:/xampp/htdocs/tid_colegio/imag/sistema/";
                
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
                    throw new Exception("Error al mover archivo en local");
                }
                
            } else {
                // ========== ENTORNO PRODUCCIÓN ==========
                $apiUrl = 'https://campus-colegiosorion.net.pe/apiimagenes-colegioorion/usuarios.php';
                $curl = curl_init($apiUrl);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POST, true);

                $postData = array(
                    'image' => new CURLFile($imagenTempPath, 'image/jpeg', $nombreOriginal)
                );
                curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
                $response = curl_exec($curl);

                if (!$response) {
                    throw new Exception(curl_error($curl));
                }
                
                if ($curl) {
                    curl_close($curl);
                }
                
                return $response;
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