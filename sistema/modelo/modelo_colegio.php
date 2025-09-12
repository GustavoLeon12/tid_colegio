
<?php
    class Colegio{
        private $conexion;
        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }

function RegistrarDatosColegio($NamelogoImg,$NamepaisImg,$NamebannImg,$colegioNombre,$colegioUbic,$colegioEmail,$ColegioTelefono,$ugel){
	 $sql = "insert into colegio (nameColegio, telefColegio, emailColegio, ubicacion, logoColegio, escudoPais, bannerColegio, ugel,dateCreate)  values ('$colegioNombre','$ColegioTelefono','$colegioEmail','$colegioUbic','$NamelogoImg','$NamepaisImg','$NamebannImg','$ugel',NOW())";
            if ($consulta = $this->conexion->conexion->query($sql)) {
           return 1;    
            }else{
                return 0;
            }
         }  


function ActualizarDatosColegio($NamelogoImg,$NamepaisImg,$NamebannImg,$colegioNombre,$colegioUbic,$colegioEmail,$ColegioTelefono,$idcolegio,$ugel){
 $sql = "update colegio set nameColegio='$colegioNombre', telefColegio='$ColegioTelefono', emailColegio='$colegioEmail', ubicacion='$colegioUbic', logoColegio='$NamelogoImg', escudoPais='$NamepaisImg', bannerColegio='$NamebannImg',ugel='$ugel', dateUpdate=NOW()
     where idColegio='$idcolegio'";
           if ($consulta = $this->conexion->conexion->query($sql)) {      
              return 1;
              
            }else{
              return 0;
            }
	

}

function EliminarDatosColegio($idcolegio){
 $sql=   "DELETE FROM colegio WHERE idColegio = '$idcolegio'";
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
        
      }else{
        return 0;
      }

}


function ExtraerDatosActualesColegio(){
 
 $sql = "SELECT idColegio,nameColegio, telefColegio, emailColegio, ubicacion, logoColegio, escudoPais, bannerColegio ,ugel FROM colegio ";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }

}

function ConsultarImagenesExistentes($idcolegio){
 $sql = "SELECT  logoColegio, escudoPais, bannerColegio FROM colegio where idColegio='$idcolegio' ";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }


}



     }
?>