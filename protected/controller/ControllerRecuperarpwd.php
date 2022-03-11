<?php
class ControllerRecuperarpwd extends Controller {
    function __construct($view, $conf, $var, $acc) {
        parent::__construct($view, $conf, $var, $acc);
    }
     public function main() {
        $txtcorreo="";

    	    foreach ($this->var as $key => $value) {
            $this->data[$key] = $value;
            $$key = $value;
        }

        if($txtcorreo != "")
        {
            $consulta_pwd = "SELECT id,password from user WHERE email ='$txtcorreo'";
            $tables = indexModel::bd($this->conf)->getSQL($consulta_pwd);

            if ($tables != null) {

                $charset ="abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $password = "";
  
                    for($i=0;$i<10;$i++){
                      $rand =rand() % strlen($charset);
                      $password .=substr($charset,$rand,1);
                    }
                 //   echo $password;
  
                   $clave_nueva = md5($password);
                   $id = $tables[0]->id;
  
  
                    $update_pwd ="UPDATE usuarios set password='$clave_nueva' WHERE id='$id'";
                    $res = indexModel::bd($this->conf)->getSQL($update_pwd);
  
        $respuesta = indexModel::sendMail($txtCorreo,"Residuos","Solicitud de nueva contraseña","Su nueva contrase&ntilde;a es: ".$password);
             //echo $respuesta;
             $this->data['mensaje']=$respuesta;
  
            }else{
                $this->data['mensaje']= "3";
            }
        }
        //indexModel::bd($this->conf)->controlAcceso(["1","2"]);
        $this->view->show("recuperar.html", $this->data, $this->accion);
    }
}
?>
