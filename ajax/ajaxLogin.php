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
$ok = json_encode(array('login' => true));
$no = json_encode(array('login' => false));
$admin = json_encode(array('login' => 'admin'));
if($dniUsuario!=""){
    if($claveCodificada==$usuario->getClave()){
        if($usuario->getAdministrador()==1){
            echo $admin;
            $sesion->set('_usuario',$usuario);
        }else{
            echo $ok;
            $sesion->set('_usuario',$usuario);
        }
    }else{
       echo $no;
        $sesion->destroy(); 
   }
}else{
    echo $no;
    $sesion->destroy();
}