<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$bd = new DataBase();
$gestor = new ManageUsuario($bd);
$usuarios = $gestor->getListJson();
echo '{"usuarios":' .$usuarios.'}';
$bd->close();
