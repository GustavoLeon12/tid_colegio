<?php 

require_once '../models/main_model.php';

class CategoriaController extends mainModel{
  public function obtenerCategorias(){
    $query = "SELECT * FROM categorias WHERE privado=0";
    $result = $this->ejecutarConsulta($query)->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($result);
    header("Content-Type: application/json");
    echo $json;
  }
  public function obtenerCategoriasPrivado(){
    $query = "SELECT * FROM categorias";
    $result = $this->ejecutarConsulta($query)->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($result);
    header("Content-Type: application/json");
    echo $json;
  }
  public function crearCategoria(){
    $nombre = $_POST["nombre"];
    $descripcion  = $_POST["descripcion"];
    $privado = 0;
    if(isset($_POST["privado"])){
      $privado = 1;
    }
    $query = "INSERT INTO categorias (nombre, descripcion, privado) VALUES ('$nombre', '$descripcion', '$privado')";
    $this->ejecutarConsulta($query);
    $json = json_encode(array("message" => "¡Una categoria se creo correctamente!"));
    header("Content-Type: application/json");
    echo $json;
  }
  public function eliminarCategoria(){
    $id = $_POST["id"];
    $query = "DELETE FROM categorias WHERE id=$id";
    $this->ejecutarConsulta($query);
    header("Content-Type: application/json");
    echo json_encode(array("message"=>"La categoria se elimino con exito"));
  }
}