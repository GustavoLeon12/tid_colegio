<?php
	require(__DIR__ . '../../../global.php');

	class conexion{
		public $conexion;
		function conectar(){
			$this->conexion = new mysqli($GLOBALS['servidor'],$GLOBALS['usuario'], $GLOBALS['contrasena'], $GLOBALS['basedatos']);
			$this->conexion->set_charset("utf8");
		}
		function cerrar(){
			$this->conexion->close();	
		}
	}
?>
