<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$bd=new DataBase();
$bd->erase('reserva');
$bd->erase('listaEspera');
$ok = json_encode(array('resp' => true));
echo $ok;
