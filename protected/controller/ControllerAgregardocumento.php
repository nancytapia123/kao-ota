<?php
class ControllerAgregardocumento extends Controller{
    function __construct($view, $conf, $var, $acc){
        parent::__construct($view, $conf, $var, $acc);
    }
    public function main(){
        foreach ($this->var as $key => $value){
            $this->data[$key] = $value;
            $$key = $value;
        }
        //indexModel::bd($this->conf)->controlAcceso(["1", "2"]);


        if (isset($cmdGuardar2) && $cmdGuardar2==1) {
            $documento = array(
                'Dominio' => "documento",
                'txttipo_documento_id' => $txttipo_documento_id);

                $idReg = indexModel::bd($this->conf)->updateDominio($documento);
            

            //condicional si el fuchero existe
        if($_FILES["txtFile"]["name"][$key]) {

            if (isset($_FILES["txtFile"])) {
                $estructura = dirname(__FILE__)."/../../includes/files/user";
                //echo "X:".$estructura;
                if (!file_exists($estructura)) {
                    if (!mkdir($estructura, 0777, true)) {
                        die('Fallo al crear las carpetas...');
                    }
                }

                $file_name = $_FILES["txtFile"]["name"];
                $ext = explode(".", $file_name);
                $add = $estructura."/".$file_name;
                if (move_uploaded_file($_FILES["txtFile"]["tmp_name"], $add)) {
                    
                } else {
    
                }
            }
    
    
        
        }


    }
        $this->data["datos1"] = indexModel::bd($this->conf)->getDominio("user");

        $this->view->show("agregarDocumento.html", $this->data, $this->accion);
    }
}
?>