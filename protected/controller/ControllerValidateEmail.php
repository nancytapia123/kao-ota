<?php
ini_set('display_errors',0);
error_reporting(E_ALL);

class ControllerValidateEmail extends Controller {
    function __construct($view, $conf, $var, $acc) {
        parent::__construct($view, $conf, $var, $acc);
    }
     public function main() {
    	    foreach ($this->var as $key => $value) {
            $this->data[$key] = $value;
            $$key = $value;
        }
      

           $dd = explode("/",$this->var["con"]);
        
           //echo $dd[1];
           $sql="SELECT * FROM user WHERE clave_validar='".$dd[1]."'";
          //echo "sql", $sql;
           $datos = indexModel::bd($this->conf)->getSQL($sql)[0];
           var_dump("datos",$datos);
           // echo "hola", $datos->id;

            $sql2="UPDATE user SET status_id='1' WHERE id='".$datos->id."'";
            //echo "sql",$sql2;
                indexModel::bd($this->conf)->getSQL($sql2);
                // var_dump("datos",$consulta);
                $consulta=1;
                if($consulta>0){
          
                    $data["isCorrect"] = TRUE;
                            $data["tituloMensaje"] = "Cuenta activada";
                            $data["Mensaje"] = "Tu cuenta ya ha sido activada, ingresa al sistema con tu correo y contraseña registrados.";
                            $data["return"] ="https://bt-mexico.vip/";
                            $data["tiempo"] = "5";
                            $data["return"]=indexModel::bd($this->conf)->getMensaje($data);
                            $templa  = "mensajeBackEnd.html";
                            $this->view->show($templa, $data, $this->accion);
                }

           
           








        indexModel::bd($this->conf)->controlAcceso(["1","2"]);
       // $this->view->show("home.html", $this->data, $this->accion);
    }
}
?>
