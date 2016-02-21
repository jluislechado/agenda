<?php


class ManageListaEspera {
    
    private $bd = null;
    private $tabla = "listaEspera";
    
    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    
    function get($codigoEspera){
        $parametros = array();
        $parametros['codigoEspera'] = $codigoEspera;
        $this->bd->select($this->tabla, "*", "codigoEspera=:codigoEspera", $parametros);
        $fila=$this->bd->getRow();
        $listaEspera = new ListaEspera();
        $listaEspera->set($fila);
        return $listaEspera;
    }
    
    function delete($codigoEspera){
        $parametros = array();
        $parametros['codigoEspera'] = $codigoEspera;
        return $this->bd->delete($this->tabla, $parametros);
    }
    
    
    function set(ListaEspera $listaEspera){
        $parametrosSet=array();
        $parametrosSet['codigoEspera']=$listaEspera->getcodigoEspera();
        $parametrosSet['idReserva']=$listaEspera->getIdReserva();
        $parametrosSet['dni']=$listaEspera->getDni();
        $parametrosWhere = array();
        $parametrosSet['codigoEspera']=$listaEspera->getcodigoEspera();
        return $this->bd->update($this->tabla, $parametrosSet, $parametrosWhere);
        
    }
    
    function insert(ListaEspera $listaEspera){
        $parametrosSet=array();
        $parametrosSet['codigoEspera']=$listaEspera->getcodigoEspera();
        $parametrosSet['idReserva']=$listaEspera->getIdReserva();
        $parametrosSet['dni']=$listaEspera->getDni();
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