{"filter":false,"title":"Usuario.php","tooltip":"/clases/Usuario.php","ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":8,"column":68},"end":{"row":8,"column":68},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":9,"state":"php-start","mode":"ace/mode/php"}},"hash":"32e543bfdb6168cfedb14dacdf0b95ef0b367bbd","undoManager":{"mark":13,"position":13,"stack":[[{"start":{"row":0,"column":0},"end":{"row":70,"column":1},"action":"insert","lines":["<?php","","","class Capullo {","    private $dni;","    private $clave;","    private $administrador;","    ","    function __construct($dni=null, $clave=null, $administrador=null) {","        $this->dni = $dni;","        $this->clave = $clave;","        $this->administrador = $administrador;","    }","    ","    function getDni() {","        return $this->dni;","    }","","    function getClave() {","        return $this->clave;","    }","","    function getAdministrador() {","        return $this->administrador;","    }","","    function setDni($dni) {","        $this->dni = $dni;","    }","","    function setClave($clave) {","        $this->clave = $clave;","    }","","    function setAdministrador($administrador) {","        $this->administrador = $administrador;","    }","","    public function getJson(){","        $r = '{';","        foreach ($this as $indice => $valor) {","            $r .= '\"' .$indice . '\":' . json_encode($valor). ','; //Se codifican algunos caracteres","        }","        $r = substr($r, 0,-1);","        $r .='}';","        return $r;","    }","    ","    function set($valores, $inicio=0){","        $i = 0;","        foreach ($this as $indice => $valor) {","           $this->$indice = $valores[$i+$inicio];","           $i++;","        }","    }","    ","    public function __toString() {","        $r ='';","        foreach ($this as $key => $valor) { ","            $r .= \"$valor \";","        }","        return $r;","    }","    ","    function read() {","        foreach ($this as $key => $valor){","            $this->$key = Request::req($key);","        }","    }","","}"],"id":1}],[{"start":{"row":3,"column":6},"end":{"row":3,"column":13},"action":"remove","lines":["Capullo"],"id":2},{"start":{"row":3,"column":6},"end":{"row":3,"column":7},"action":"insert","lines":["U"]}],[{"start":{"row":3,"column":7},"end":{"row":3,"column":8},"action":"insert","lines":["s"],"id":3}],[{"start":{"row":3,"column":8},"end":{"row":3,"column":9},"action":"insert","lines":["u"],"id":4}],[{"start":{"row":3,"column":9},"end":{"row":3,"column":10},"action":"insert","lines":["a"],"id":5}],[{"start":{"row":3,"column":10},"end":{"row":3,"column":11},"action":"insert","lines":["r"],"id":6}],[{"start":{"row":3,"column":11},"end":{"row":3,"column":12},"action":"insert","lines":["i"],"id":7}],[{"start":{"row":3,"column":12},"end":{"row":3,"column":13},"action":"insert","lines":["o"],"id":8}],[{"start":{"row":8,"column":64},"end":{"row":8,"column":68},"action":"remove","lines":["null"],"id":9},{"start":{"row":8,"column":64},"end":{"row":8,"column":65},"action":"insert","lines":["0"]}],[{"start":{"row":8,"column":64},"end":{"row":8,"column":65},"action":"remove","lines":["0"],"id":10}],[{"start":{"row":8,"column":64},"end":{"row":8,"column":65},"action":"insert","lines":["n"],"id":11}],[{"start":{"row":8,"column":65},"end":{"row":8,"column":66},"action":"insert","lines":["u"],"id":12}],[{"start":{"row":8,"column":66},"end":{"row":8,"column":67},"action":"insert","lines":["l"],"id":13}],[{"start":{"row":8,"column":67},"end":{"row":8,"column":68},"action":"insert","lines":["l"],"id":14}]]},"timestamp":1456003180000}