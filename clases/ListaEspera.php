<?php

class ListaEspera {
    private $codigoEspera;
    private $idReserva;
    private $dni;
    
    function __construct($codigoEspera=null,$idReserva=null, $dni=null) {
        $this->codigoEspera=$codigoEspera;
        $this->idReserva = $idReserva;
        $this->dni = $dni;
    }
    
    function getCodigoEspera() {
        return $this->codigoEspera;
    }
    
    function getIdReserva() {
        return $this->idReserva;
    }

    function getDni() {
        return $this->dni;
    }
    
    function setCodigoEspera($codigoEspera) {
        $this->codigoEspera = $codigoEspera;
    }

    function setIdReserva($idReserva) {
        $this->idReserva = $idReserva;
    }

    function setDni($dni) {
        $this->dni = $dni;
    }
    
    public function getJson(){
        $r = '{';
        foreach ($this as $indice => $valor) {
            $r .= '"' .$indice . '":' . json_encode($valor). ','; //Se codifican algunos caracteres
        }
        $r = substr($r, 0,-1);
        $r .='}';
        return $r;
    }
    
    function set($valores, $inicio=0){
        $i = 0;
        foreach ($this as $indice => $valor) {
           $this->$indice = $valores[$i+$inicio];
           $i++;
        }
    }
    
    public function __toString() {
        $r ='';
        foreach ($this as $key => $valor) { 
            $r .= "$valor ";
        }
        return $r;
    }
    
    function read() {
        foreach ($this as $key => $valor){
            $this->$key = Request::req($key);
        }
    }



}