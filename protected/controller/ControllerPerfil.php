<?php
class ControllerPerfil extends Controller {
    function __construct($view, $conf, $var, $acc) {
        parent::__construct($view, $conf, $var, $acc);
    }
     public function main() {
    	    foreach ($this->var as $key => $value) {
            $this->data[$key] = $value;
            $$key = $value;
        }
        foreach ($_COOKIE as $key => $value) {
            $$key = $value;
        }
        if( $idEditar>0 )   {
            $datoss["Dominio"]="user";
            $datoss["txtnombres"]=$txtNombre;
            $datoss["txtapellido_paterno"]=$txtApellido_paterno;
            $datoss["txtapellido_materno"]=$txtApellido_materno;
            $datoss["txtgenero_id"]=$txtGenero;
            $datoss["txtemail"]=$txtCorreo;
            $datoss["txttelefono"]=$txtTelefono;
            $datoss["txtnacionalidad_id"]=$txtNacionalidad;
            $datoss["txtpais_nac"]=$txtPais;
            $editarPerfil = indexModel::bd($this->conf)->updateDominio($datoss, $idEditar);
        }
        if($idEditarFoto > 0){
            $estructura = dirname(__FILE__) . "/../../includes/images/users";
            if (!file_exists($estructura)) {
                if (!mkdir($estructura, 0777, true)) {
                    die('Fallo al crear la carpeta...');
                }
            }
            $file_name = $_FILES["img-foto2"]["name"];
            if($file_name !=""){
                $ext = explode(".", $file_name);
                $add = $estructura."/".$idEditarFoto.".".$ext[1];
                if (move_uploaded_file($_FILES["img-foto2"]["tmp_name"], $add)) {
                    $ex =  strtolower($ext[1]);
                    if($ex != "jpg") @unlink($estructura."$idReg.jpg");
                    if($ex != "png") @unlink($estructura."$idReg.png");
                    if($ex != "gif") @unlink($estructura."$idReg.gif");
                }

            }
        }

        $thefolder = "includes/images/users/";
        if ($handler = opendir($thefolder)) {
            while (false !== ($file = readdir($handler))) {
                $file2= explode(".",$file);
                if(is_numeric($file2[0])){
                    $im=$file2[0];
                    $this->data["id_imagenperfil"][$im][]= array( "image"=>$file);
                }
            }
            closedir($handler);
        }

        $sql="SELECT *, r.rol, p.pais, n.nacionalidad, g.genero, ac.actividad,f.fuente_ingresos FROM user AS u 
            INNER JOIN rol AS r ON r.id = u.rol_id 
            LEFT JOIN pais AS p ON p.id=u.pais_nac 
            LEFT JOIN nacionalidad AS n ON n.id=u.nacionalidad_id
            LEFT JOIN genero AS g ON g.id=u.genero_id 
            LEFT JOIN actividad_principal AS ac ON ac.id=u.actividad_principal_id 
            LEFT JOIN fuente_ingresos AS f ON f.id=u.fuente_ingresos_id WHERE u.id=".$_COOKIE["idUser"];
               $this->data["usuario"] = indexModel::bd($this->conf)->getSQL($sql)[0];
               $this->data["pais"] = indexModel::bd($this->conf)->getDominio("pais");
               $this->data["nacionalidad"] = indexModel::bd($this->conf)->getDominio("nacionalidad");
               $this->data["genero"] = indexModel::bd($this->conf)->getDominio("genero");



               if($editarPerfil>0){
                $data["isCorrect"] = TRUE;
                $data["tituloMensaje"] = "Exito!";
                $data["Mensaje"] = "El usuario se ha modificado de forma correcta.";
                $data["return"] = $this->var["path"]."perfil";
                $data["tiempo"] = "5";
                $data["return"]=indexModel::bd($this->conf)->getMensaje($data);
                $templa  = "mensajeBackEnd.html";
                $this->view->show($templa, $data, $this->accion);
    }else{
        //indexModel::bd($this->conf)->controlAcceso(["1","2","3"]);
        $this->view->show("perfil.html", $this->data, $this->accion);
         }
       
    }
}
?>
