<?php

class Util {

    public function Generara_Seccion_Usuario($consulta){
        $lifetime=3600;
        if (session_status() === PHP_SESSION_NONE) {
            ini_set('session.cookie_path', '/');
            session_set_cookie_params($lifetime);
            session_start();
        }
        $_SESSION['S_IDUSUARIO']=$consulta[0]['usu_id'];
        $_SESSION['S_IDENTYTI']=$consulta[0]['identidad'];
        $_SESSION['S_USER']=$consulta[0]['usu_usuario'];
        $_SESSION['S_NOMBRE']=$consulta[0]['usu_nombre'];
        $_SESSION['S_ROL']=$consulta[0]['rol_nombre'];
        $_SESSION['S_FILE_IMG']=$consulta[0]['imagen'];

        setcookie("activo", 1, time() + 3600);
        setcookie("token", $this->getToken(9), time() + 3600);
        setcookie("user_Anonimus", $this->getToken(6),time() + 3600);

        session_write_close();
        return $consulta[0]['usu_usuario'];
    }

    public function getToken($length)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet) - 1;
        for ($i = 0; $i < $length; $i ++) {
            $token .= $codeAlphabet[$this->cryptoRandSecure(0, $max)];
        }
        return $token;
    }
    
    public function cryptoRandSecure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1) {
            return $min;
        }
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1;
        $bits = (int) $log + 1;
        $filter = (int) (1 << $bits) - 1;
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter;
        } while ($rnd >= $range);
        return $min + $rnd;
    }
    
    public function redirect($url) {
        header("Location:" . $url);
        exit;
    }
    
    public function clearAuthCookie() {
        if (isset($_COOKIE["login_usuario"])) {
            setcookie("login_usuario", "");
        }
        if (isset($_COOKIE["random_password"])) {
            setcookie("random_password", "");
        }
        if (isset($_COOKIE["random_selector"])) {
            setcookie("random_selector", "");
        }
    }

    public function token_generator(){
        $token = $_SESSION['token'] = md5(uniqid(mt_rand(), true));
        return $token;
    }
}
?>