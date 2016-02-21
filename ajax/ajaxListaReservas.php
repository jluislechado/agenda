<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$no = json_encode(array('login' => false));
$bd = new DataBase();
$gestor = new ManageReserva($bd);
$reservas = $gestor->getListJson();
echo '{"estado":' .$reservas. '}';
$bd->close();
