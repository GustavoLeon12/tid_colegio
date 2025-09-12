<?php
require_once '../models/main_model.php';
require_once '../../sistema/helper/save_image.php';

class NoticiasController extends mainModel
{

  public function crearNoticia()
  {
    $title = $_POST["title"];
    $content = $_POST["contentNotice"];
    $currentDate = date('Y-m-d H:i:s');
    $autor = $_POST['user'];
    $category = $_POST["category"];
    $importante = isset($_POST["importante"]) ? 1 : 0;
    $routeImage = saveImage();

    $query = "INSERT INTO `noticias` (`titulo`, `portada`, `descripcion`, `fechaCreacion`, `fkCategoria`, `fkUsuario`, `importante`) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->conectar()->prepare($query);
    $stmt->bindParam(1, $title);
    $stmt->bindParam(2, $routeImage);
    $stmt->bindParam(3, $content);
    $stmt->bindParam(4, $currentDate);
    $stmt->bindParam(5, $category);
    $stmt->bindParam(6, $autor);
    $stmt->bindParam(7, $importante);
    $stmt->execute();

    $json = json_encode(array("message" => "¡Una noticia se creo correctamente!", "status" => 200, "dir" => $routeImage));
    header("Content-Type: application/json");
    echo $json;
  }
  public function obtenerNoticias()
  {
    $query = "
    SELECT b.fkCategoria ,b.id, b.fechaCreacion ,b.titulo, b.portada, b.descripcion, u.usu_apellidos as usuario, c.nombre as categoria, b.importante FROM noticias b 
    LEFT JOIN categorias c ON c.id=b.fkCategoria
    LEFT JOIN usuarios u ON u.usu_id=b.fkUsuario
    WHERE c.privado=0";
    $result = $this->ejecutarConsulta($query)->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($result);
    header("Content-Type: application/json");
    echo $json;
  }
  public function obtenerNoticia()
  {
    $id = $_GET["id"];
    $query = "SELECT * FROM noticias WHERE id='$id'";
    $result = $this->ejecutarConsulta($query)->fetch(PDO::FETCH_ASSOC);
    $json = json_encode($result);
    header("Content-Type: application/json");
    echo $json;
  }
  public function deleteNoticia()
  {
    $id = $_POST["id"];
    $query = "DELETE FROM noticias WHERE id=$id";
    $this->ejecutarConsulta($query);
    header("Content-Type: application/json");
    echo json_encode(array("message" => "La noticia se elimino con exito"));
  }
  public function updateNoticia()
  {
    $title = $_POST["title"];
    $content = $_POST["contentNotice"];
    $image = "";
    $id = $_POST["id"];
    $category = $_POST["category"];
    $currentDate = date('Y-m-d H:i:s');
    $autor = $_POST['autor'];
    $importante = 0;
    if (isset($_POST["importante"])) {
      $importante = 1;
    }

    if (!empty($_FILES["image"]["name"])) {
      $image = saveImage();
      if ($image === "ERROR") {
        http_response_code(500);
        $json = json_encode(array("message" => "¡La noticia no se llega a subir correctamente!", "status" => 500, "dir" => $image));
        header("Content-Type: application/json");
        echo $json;
        exit();
      }
    } else {
      $image = $_POST["image"];
    }



    try {
      $query = "UPDATE noticias
      SET titulo = '$title', portada = '$image', descripcion = '$content', fechaCreacion = '$currentDate', fkCategoria='$category', fkUsuario = '$autor', importante = '$importante'
      WHERE id = '$id';";
      $this->ejecutarConsulta($query);
    } catch (\Throwable $th) {
      $query = "UPDATE noticias
      SET titulo = '$title', portada = '$image', descripcion = '$content', fechaCreacion = '$currentDate', fkUsuario = '$autor', importante = '$importante'
      WHERE id = '$id';";
      $this->ejecutarConsulta($query);
    }
    $json = json_encode(array("message" => "El blog se actualizo correctamente", "dir" => $image));
    header("Content-Type: application/json");
    echo $json;
  }
  public function obtenerNoticiasPrivado()
  {
    $query = "   
    SELECT b.id, b.fechaCreacion ,b.titulo, b.portada, b.descripcion, u.usu_apellidos as usuario, c.nombre as categoria,  u.imagen FROM noticias b 
    LEFT JOIN categorias c ON c.id=b.fkCategoria
    LEFT JOIN usuarios u ON u.usu_id=b.fkUsuario";
    $result = $this->ejecutarConsulta($query)->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($result);
    header("Content-Type: application/json");
    echo $json;
  }
}