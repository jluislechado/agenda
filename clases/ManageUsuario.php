<?php


class ManageUsuario {
    
    private $bd = null;
    private $tabla = "usuario";
    
    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    
    function get($dni){
        $parametros = array();
        $parametros['dni'] = $dni;
        $this->bd->select($this->tabla, "*", "dni=:dni", $parametros);
        $fila=$this->bd->getRow();
        $usuario = new Usuario();
        $usuario->set($fila);
        return $usuario;
    }
    
    function delete($dni){
        $parametros = array();
        $parametros['dni'] = $dni;
        return $this->bd->delete($this->tabla, $parametros);
    }
    
    
    function set(Usuario $usuario){
        $parametrosSet=array();
        $parametrosSet['dni']=$usuario->getDni();
        $parametrosSet['clave']=$usuario->getClave();
        $parametrosSet['administrador']=$usuario->getAdministrador();
        $parametrosWhere = array();
        $parametrosWhere['dni'] = $usuario->getDni();
        return $this->bd->update($this->tabla, $parametrosSet, $parametrosWhere);
        
    }
    
    function insert(Usuario $usuario){
        $parametrosSet=array();
        $parametrosSet['dni']=$usuario->getDni();
        $parametrosSet['clave']=$usuario->getClave();
        $parametrosSet['administrador']=$usuario->getAdministrador();
        return $this->bd->insert($this->tabla, $parametrosSet);
    }
    
    function getList($pagina=1, $orden="", $nrpp=Constant::NRPP, $condicion ="1=1", $parametros = array()){
        
        $ordenPredeterminado = "$orden, dni";
        if($orden==="" || $orden === null){
            $ordenPredeterminado = "dni";
        }
         $registroInicial = ($pagina-1)*$nrpp;
         $this->bd->select($this->tabla, "*", $condicion, $parametros , $ordenPredeterminado , "$registroInicial, $nrpp");
         $r=array();
         while($fila =$this->bd->getRow()){
             $usuario = new Usuario();
             $usuario->set($fila);
             $r[]=$usuario;
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
        $this->bd->query($this->tabla, "dni", array(), "dni");
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