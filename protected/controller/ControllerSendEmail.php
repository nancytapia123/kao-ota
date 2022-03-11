<?php

use Symfony\Component\Finder\Expression\ValueInterface;

ini_set('display_errors',0);
error_reporting(E_ALL);



class controllerSendEmail {
    function __construct($view, $conf, $var, $acc) {
        $this->view = $view;
        $this->conf = $conf;
        $this->var = $var;
        $this->accion = $acc;
    }

    public function main() {
        foreach ($this->var as $key => $value) {
            //echo $key."--".$value."<br>";
            $this->data[$key] = $value;
            $$key = $value;
        }

    
      
      //  $this->data["usuario"] = indexModel::bd($this->conf)->getDominio("user");
       


        // --> Generar la clave  llave para que valide correo 
            if(isset($btnRegistro) ){

                
                  
              $clave = uniqid();
                // echo "clave".$clave;
                 //--> Enviar el correo 
                  $cadena= "https://bt-mexico.vip/ValidateEmail/".$clave;
         
                 $mensaje="<h1>Gracias por registrarte</h1>  
                          <h2>Para confirmar tu correo electronico y puedas comenzar a realizar tu contrato has click en el siguiente enlace:</h2>
                          <a href='{$cadena}'>Confirma tu correo</a>";
                 $correo=$txtEmail;
                 $name="Nombre";
                 $asunto="Validacion";
                 $mail = indexModel::bd($this->conf)->sendMail($correo, $name, $asunto, $mensaje, $opc = 0);
                 //var_dump($mail);
                 //exit();
                 // --> Guardar registro 
             
             if( isset($txtEmail)){
                     
                             $datoss["Dominio"]="user";
                             $datoss["txtnombres"]=""; 
                             $datoss["txtapellido_paterno"]="";
                             $datoss["txtapellido_materno"]="";
                             $datoss["txtdireccion"]="";
                             $datoss["txtemail"]=$txtEmail; 
                             $datoss["txttelefono"]="";
                             $datoss["txtpassword"]=$txtPassword;
                             $datoss["txtrol_id"]='3';
                             $datoss["txtstatus_id"]='2';
                             //$datoss["txtclave_validar"]=$clave;
                            // echo "clave2".$clave;
                             $guardarRe = indexModel::bd($this->conf)->updateDominio($datoss);
                            
                        //exit ();
                 }
         
         
                 if($guardarRe>0){
          
                     $data["isCorrect"] = TRUE;
                             $data["tituloMensaje"] = "Por favor revisa tu correo.";
                             $data["Mensaje"] = "Enviamos un correo para que puedas validar tu cuenta";
                             $data["return"] = $this->var["path"]."sendEmail";
                             $data["tiempo"] = "5";
                             $data["return"]=indexModel::bd($this->conf)->getMensaje($data);
                             $templa  = "mensajeBackEnd.html";
                             $this->view->show($templa, $data, $this->accion);
                 }
                 //$res = indexModel::bd($this->conf)->updateDominio($datoss,$this->var["idReg"]);
                 
            }

       

        if($res > 0){
            $data["isCorrect"] = TRUE;
            $data["tituloMensaje"] = "Exito!";
            if($this->var["idReg"]>0 && $this->var["Action"]=="delete"){
                $data["Mensaje"] = "Registo eliminado de forma correcta.";
            }else{
                $data["Mensaje"] = "Registo guardado de forma correcta.";
            }
            if(key_exists($this->var["Dominio"], $directos)){
                $data["return"] = $this->var["path"]."".$this->var["Dominio"];
            }else{
                $data["return"] = $this->var["path"]."catalogo/".$this->var["Dominio"];
            }
            $data["tiempo"] = "3";
        }elseif(isset($cmdRegresar)){
            $data["isCorrect"] = TRUE;
            $data["tituloMensaje"] = "Regresando!";
            $data["Mensaje"] = "Regresando de forma correcta.";
            $data["return"] = $this->var["path"]."catalogo/".$this->var["Dominio"];
            $data["tiempo"] = "3";
        }else{
            $data["isCorrect"] = FALSE;
            $data["tituloMensaje"] = "Error!!!";
            if($this->var["idReg"]>0 && $this->var["Action"]=="delete"){
                $data["Mensaje"] = "El registo no pudo ser eliminado consulte al administrador.";
            }else{
                $data["Mensaje"] = "El registo no pudo ser guardado consulte al administrador.";
            }
            if(key_exists($this->var["Dominio"], $directos)){
                $data["return"] = $this->var["path"]."".$this->var["Dominio"];
            }else{
                $data["return"] = $this->var["path"]."catalogo/".$this->var["Dominio"];
            }
            $data["tiempo"] = "3";
        }
        if($_COOKIE["idRol"]==2 && $this->var["Dominio"]=="user"){
            $data["return"] = $this->var["path"]."editar-perfil";
        }

        $data["return"]=indexModel::bd($this->conf)->getMensaje($data);
        $templa  = "mensajeBackEnd.html";
      // $this->view->show($templa, $data, $this->accion);
        $this->view->show("sendEmail.html", $this->data, $this->accion);
    }
}
?>
