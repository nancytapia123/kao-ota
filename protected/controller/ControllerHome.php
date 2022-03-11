<?php
class ControllerHome extends Controller {
    function __construct($view, $conf, $var, $acc) {
        parent::__construct($view, $conf, $var, $acc);
    }
     public function main() {
    	    foreach ($this->var as $key => $value) {
            $this->data[$key] = $value;
            $$key = $value;
        }

        $sql="SELECT * FROM user WHERE id= ".$_COOKIE["idUser"];
            $usu= indexModel::bd($this->conf)->getSQL($sql);
            //var_dump($usu);
           foreach($usu as $v){
                if(empty($v->nombres) || is_null($v->nombres) || empty($v->apellido_paterno) ||is_null($v->apellido_paterno) 
                                      || empty($v->apellido_materno) || is_null($v->apellido_materno)
                                      || is_null($v->telefono) || empty($v->telefono)){
                   
                   $this->data["alerta"]=1;
                }else{
                    $this->data["alerta"]=0;
                    //echo "no nulo";
                }


                
              
           }





       //indexModel::bd($this->conf)->controlAcceso(["1","2","3"]);
        $this->view->show("home.html", $this->data, $this->accion);
    }
}
?>
