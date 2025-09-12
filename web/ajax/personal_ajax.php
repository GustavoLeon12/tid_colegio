<?php
require_once '../controller/personal_controller.php';

$docente = new PersonalController();
$docente->obtenerDocentes();
?>