<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$bd = new DataBase();
$gestor = new ManageUsuario($bd);
$dni = Request::get("dni");
$r = $gestor->delete($dni);
$bd->close();
$respuesta = '{"delete":' . $r .'}';
echo $respuesta;
