{"filter":false,"title":"Reserva.php","tooltip":"/clases/Reserva.php","undoManager":{"mark":0,"position":0,"stack":[[{"start":{"row":0,"column":0},"end":{"row":61,"column":1},"action":"insert","lines":["<?php","","class Reserva {","    private $idReserva;","    private $dni;","    ","    function __construct($idReserva=null, $dni=null) {","        $this->idReserva = $idReserva;","        $this->dni = $dni;","    }","    ","    function getIdReserva() {","        return $this->idReserva;","    }","","    function getDni() {","        return $this->dni;","    }","","    function setIdReserva($idReserva) {","        $this->idReserva = $idReserva;","    }","","    function setDni($dni) {","        $this->dni = $dni;","    }","    ","    public function getJson(){","        $r = '{';","        foreach ($this as $indice => $valor) {","            $r .= '\"' .$indice . '\":' . json_encode($valor). ','; //Se codifican algunos caracteres","        }","        $r = substr($r, 0,-1);","        $r .='}';","        return $r;","    }","    ","    function set($valores, $inicio=0){","        $i = 0;","        foreach ($this as $indice => $valor) {","           $this->$indice = $valores[$i+$inicio];","           $i++;","        }","    }","    ","    public function __toString() {","        $r ='';","        foreach ($this as $key => $valor) { ","            $r .= \"$valor \";","        }","        return $r;","    }","    ","    function read() {","        foreach ($this as $key => $valor){","            $this->$key = Request::req($key);","        }","    }","","","","}"],"id":1}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":0,"column":0},"end":{"row":61,"column":1},"isBackwards":true},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1455990661793,"hash":"06378efff635b0794d94470d00e7c300b493aeda"}