 <?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$bd= new DataBase();
$id = Request::post("id");
$gestor=new ManageReserva($bd);
$reserva=$gestor->get($id);
$idReserva=$reserva->getIdReserva();
$usuario=$sesion->get('_usuario');

$ok = json_encode(array('r' => $idReserva));
$no = json_encode(array('r' => true));
$miReserva=json_encode(array('r' => 'miReserva'));
$dniReserva=$reserva->getDni();

if($idReserva!=null){
    $dni=$usuario->getDni();
    if($dni==$dniReserva){
        $gestor->delete($id);
        echo $miReserva;
    }
    else{
        echo $ok;
    }
}else{
    echo $no;
    $dni=$usuario->getDni();
    $reservaNueva= new Reserva($id,$dni);
    $gestor->insert($reservaNueva);
    
    }