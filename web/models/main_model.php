<?php
require '../../global.php';

class mainModel{
  public function __construct(){
    $this->server=$GLOBALS['servidor'];
    $this->db=$GLOBALS['basedatos'];
    $this->user=$GLOBALS['usuario'];
    $this->pass=$GLOBALS['contrasena'];
  } 
  protected function conectar(){
    try {
      $conexion = new PDO("mysql:host=".$this->server.";dbname=".$this->db,$this->user,$this->pass);
      $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $conexion;
    } catch (PDOException $e) {
      throw new Exception("La conexión ha fallado: " . $e->getMessage());
    }
  }
  
  protected function ejecutarConsulta($consulta){
    $sql=$this->conectar()->prepare($consulta);
    $sql->execute();
    return $sql;
  }
}
?>