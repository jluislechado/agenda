<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();


$dni = Request::post('dni');
$clave = Request::post('clave');
$claveCodificada=sha1($clave.Constant::SEMILLA);
$bd=new DataBase();
$gestor=new ManageUsuario($bd);
$usuario=$gestor->get($dni);
$dniUsuario=$usuario->getDni();
$ok = json_encode(array('insert' => true));
$no = json_encode(array('insert' => false));
if($dniUsuario!=""){
    echo $no;
}else{
    $usuario=new Usuario($dni,$claveCodificada,0);
    $gestor->insert($usuario);
    echo $ok;
}