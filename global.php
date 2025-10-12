<?php
// ========== CONFIGURACIÓN GLOBAL ==========

// Detectar si es entorno local o de producción
$isLocal = ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_NAME'] === '127.0.0.1');

$GLOBALS['servidor'] = "localhost";
$GLOBALS['usuario'] = "root";
$GLOBALS['contrasena'] = "";
$GLOBALS['basedatos'] = "orion";
$GLOBALS['email'] = "soporte@tid.com.pe";

// Usar rutas locales para desarrollo y producción
$GLOBALS['images'] = $isLocal 
    ? "http://localhost/tid_colegio/imag/web/" 
    : "https://campus-colegiosorion.net.pe/apiimagenes-colegioorion/noticias/";
$GLOBALS['images_user'] = $isLocal 
    ? "http://localhost/tid_colegio/imag/usuarios/" 
    : "https://campus-colegiosorion.net.pe/apiimagenes-colegioorion/usuarios/";
$GLOBALS['api_images'] = $isLocal 
    ? "http://localhost/tid_colegio/imag/" 
    : "https://campus-colegiosorion.net.pe/apiimagenes-colegioorion/";

// Directorio físico para almacenar imágenes
$GLOBALS['images_path'] = $isLocal 
    ? "C:/xampp/htdocs/tid_colegio/imag/web/" 
    : "/path/to/production/apiimagenes/noticias/";
?>