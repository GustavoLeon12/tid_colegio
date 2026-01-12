<?php
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_path', '/');
    session_set_cookie_params(3600);
    session_start();
}

function limpiar_cadena($cadena) {
    $cadena = trim($cadena);
    $cadena = stripslashes($cadena);
    $cadena = str_ireplace("<script>", "", $cadena);
    $cadena = str_ireplace("</script>", "", $cadena);
    $cadena = str_ireplace("<script src", "", $cadena);
    $cadena = str_ireplace("<script type=", "", $cadena);
    $cadena = str_ireplace("SELECT * FROM", "", $cadena);
    $cadena = str_ireplace("DELETE FROM", "", $cadena);
    $cadena = str_ireplace("INSERT INTO", "", $cadena);
    $cadena = str_ireplace("DROP TABLE", "", $cadena);
    $cadena = str_ireplace("DROP DATABASE", "", $cadena);
    $cadena = str_ireplace("TRUNCATE TABLE", "", $cadena);
    $cadena = str_ireplace("SHOW TABLES;", "", $cadena);
    $cadena = str_ireplace("SHOW DATABASES;", "", $cadena);
    $cadena = str_ireplace("<?php", "", $cadena);
    $cadena = str_ireplace("?>", "", $cadena);
    $cadena = str_ireplace("--", "", $cadena);
    $cadena = str_ireplace("^", "", $cadena);
    $cadena = str_ireplace("<", "", $cadena);
    $cadena = str_ireplace("[", "", $cadena);
    $cadena = str_ireplace("]", "", $cadena);
    $cadena = str_ireplace("==", "", $cadena);
    $cadena = str_ireplace(";", "", $cadena);
    $cadena = str_ireplace("::", "", $cadena);
    $cadena = trim($cadena);
    $cadena = stripslashes($cadena);
    return $cadena;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require dirname(__DIR__, 2) . '/modelo/modelo_usuario.php';
    
    $MU = new Modelo_Usuario();
    $usuario = htmlspecialchars($_POST['usuario'], ENT_QUOTES, 'UTF-8');
    $contra = $_POST['contracena']; // NO sanitizar contraseña
    $tokenGui = htmlspecialchars($_POST['token'], ENT_QUOTES, 'UTF-8');
    
    $min = 5;
    $max = 30;
    
    if (strlen($usuario) >= $min && strlen($usuario) <= $max) {
        if ($usuario === limpiar_cadena($usuario)) {
            $consulta = $MU->VerificarUsuario($usuario, $contra);
            
            if (count($consulta) > 0) {
                if (password_verify($contra, $consulta[0]["usu_contrasena"])) {
                    if ($consulta[0]['usu_estatus'] == 'ACTIVO') {
                        require 'controlador_crear_session.php';
                        $util = new Util();
                        $util->Generara_Seccion_Usuario($consulta);
                        session_write_close(); // Flush sesión
                        
                        $response = array(
                            'status' => true,
                            'mensaje' => 'Exito',
                            'data' => '',
                            'session' => true,
                        );
                        echo json_encode($response, JSON_UNESCAPED_UNICODE);
                    } else {
                        $response = array(
                            'status' => true,
                            'mensaje' => 'Su Cuenta esta inactiva. Comunicarse con el administrador de TI !!',
                            'data' => '',
                            'session' => false,
                        );
                        echo json_encode($response, JSON_UNESCAPED_UNICODE);
                    }
                } else {
                    $response = array(
                        'status' => true,
                        'mensaje' => 'La contraseña ingresada es incorrecta !!',
                        'data' => '',
                        'session' => false,
                    );
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
                }
            } else {
                $response = array(
                    'status' => true,
                    'mensaje' => 'Usuario no se encuentra registrado !!',
                    'data' => '',
                    'session' => false,
                );
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
            }
        } else {
            $response = array(
                'status' => true,
                'mensaje' => 'Acceso denegado !!',
                'data' => '',
                'session' => false,
            );
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        }
    } else {
        $response = array(
            'status' => true,
            'mensaje' => 'Usuario debe ser mayor a ' . $min . ' y menor a ' . $max . ' caracteres !!',
            'data' => '',
            'session' => false,
        );
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
} else {
    echo http_response_code(405);
}
?>