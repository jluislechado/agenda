<?php


class ManageReserva {
    
    private $bd = null;
    private $tabla = "reserva";
    
    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    
    function get($idReserva){
        $parametros = array();
        $parametros['idReserva'] = $idReserva;
        $this->bd->select($this->tabla, "*", "idReserva=:idReserva", $parametros);
        $fila=$this->bd->getRow();
        $reserva = new Reserva();
        $reserva->set($fila);
        return $reserva;
    }
    
    function delete($idReserva){
        $parametros = array();
        $parametros['idReserva'] = $idReserva;
        return $this->bd->delete($this->tabla, $parametros);
    }
    
    
    function set(Reserva $reserva){
        $parametrosSet=array();
        $parametrosSet['idReserva']=$reserva->getIdReserva();
        $parametrosSet['dni']=$reserva->getDni();
        $parametrosWhere = array();
        $parametrosWhere['idReserva'] = $reserva->getIdReserva();
        return $this->bd->update($this->tabla, $parametrosSet, $parametrosWhere);
        
    }
    
    function insert(Reserva $reserva){
        $parametrosSet=array();
        $parametrosSet['idReserva']=$reserva->getIdReserva();
        $parametrosSet['dni']=$reserva->getDni();
        return $this->bd->insert($this->tabla, $parametrosSet);
    }
    
    function getList($pagina=1, $orden="", $nrpp=Constant::NRPP, $condicion ="1=1", $parametros = array()){
        
        $ordenPredeterminado = "$orden, idReserva";
        if($orden==="" || $orden === null){
            $ordenPredeterminado = "idReserva";
        }
         $registroInicial = ($pagina-1)*$nrpp;
         $this->bd->select($this->tabla, "*", $condicion, $parametros , $ordenPredeterminado , "$registroInicial, $nrpp");
         $r=array();
         while($fila =$this->bd->getRow()){
             $reserva = new Reserva();
             $reserva->set($fila);
             $r[]=$reserva;
         }
         return $r;
    }
    
    function getListJson($pagina=1, $orden="", $nrpp=Constant::NRPP, $condicion ="1=1", $parametros = array()){
        $lista = $this->getList($pagina, $orden, $nrpp, $condicion, $parametros);
        $r = "[ ";
        foreach ($lista as $objeto){
            $r .= $objeto->getJson() . ",";
        }
        $r = substr($r, 0, -1) . "]";
        return $r;
    }
    
     function getValuesSelect(){
        $this->bd->query($this->tabla, "idReserva", array(), "idReserva");
        $array = array();
        while($fila=$this->bd->getRow()){
            $array[$fila[0]] = $fila[1];
        }
        return $array;
    }
    
    function count($condicion="1 = 1", $parametros = array()){
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }

}