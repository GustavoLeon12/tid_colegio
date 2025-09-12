<?php 
require(__DIR__ . '../../../../global.php');

$user = $GLOBALS['usuario'];
$pass = $GLOBALS['contrasena'];
$database = $GLOBALS['basedatos'];
$server = $GLOBALS['servidor'];
try{
   $conn = new PDO("mysql:host=$server; dbname=$database", $user, $pass);
} catch(PDOException $e){
   echo "Error: ". $e->getMessage();
   die();
}
?>