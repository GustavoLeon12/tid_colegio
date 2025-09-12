<?php
    class ModeloDashboard{
        private $conexion;
        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }
        
        function totalCurso(){
            $sql = "SELECT  * FROM curso ";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
        
        function totaldocentes(){
            $sql = "SELECT * FROM docentes ";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }

        function totalalumnos(){
            $sql = "SELECT * FROM alumno";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo [] = $consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }


        }

        function cursograficos(){
            $sql = "SELECT nonbrecurso FROM curso";
            $arreglo = array();
        
            try {
                if ($consulta = $this->conexion->conexion->query($sql)) {
                    while ($curso = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $curso['nonbrecurso'];
                    }
                    $this->conexion->cerrar();
                }
            } catch (Exception $e) {
                // Manejar el error, por ejemplo, loggearlo o imprimir un mensaje
                echo 'Error en la consulta: ' . $e->getMessage();
            }
        
            return $arreglo;
        }

        function cursocategoria(){
            $sql = "SELECT nombrecat FROM categoria_curso";
            $arreglo = array();
            try {
                if ($consulta = $this->conexion->conexion->query($sql)) {
                    while ($categoria = mysqli_fetch_array($consulta)) {
                            $arreglo [] = $categoria['nombrecat'];
                    }
                    $this->conexion->cerrar();
                }
            } catch (Exception $e) {
                echo 'Error en la consulta de categorias: ' .$e->getMessage();
            }
            return $arreglo;
            

        }

        function totaltabla (){
            $sql = "SELECT nombres, apellidos, tipo_docente FROM docentes";
            $arreglo = array();
            try {
                if ($consulta= $this->conexion->conexion->query($sql)) {
                    while ($tabla = mysqli_fetch_array($consulta)){
                        $arreglo [] = array(
                            'nombres'=>$tabla['nombres'],
                            'apellidos'=>$tabla['apellidos'],
                            'tipo_docente'=> $tabla['tipo_docente'] 
                        ); 
                            
                        
                    }
                    $this->conexion->cerrar();
                }
            } catch (Exception $e) {
                echo 'Error en la tabla' . $e->getMessage();
            } 
            return $arreglo;
        } 
   }
   
    
?>

 