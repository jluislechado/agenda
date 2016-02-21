<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$usuario=$sesion->get('_usuario');
$logueado = $sesion->isLogged();
$ok = json_encode(array('login' => true));
$no = json_encode(array('login' => false));
$admin=json_encode(array('login'=>'admin'));

if($usuario!=null){
    if($usuario->getAdministrador()==1){
        echo $admin;
    }
    else{
        echo $ok;
    }
}else{
    echo $no;
}