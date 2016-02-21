<?php


class Usuario {
    private $dni;
    private $clave;
    private $administrador;
    
    function __construct($dni=null, $clave=null, $administrador=null) {
        $this->dni = $dni;
        $this->clave = $clave;
        $this->administrador = $administrador;
    }
    
    function getDni() {
        return $this->dni;
    }

    function getClave() {
        return $this->clave;
    }

    function getAdministrador() {
        return $this->administrador;
    }

    function setDni($dni) {
        $this->dni = $dni;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setAdministrador($administrador) {
        $this->administrador = $administrador;
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