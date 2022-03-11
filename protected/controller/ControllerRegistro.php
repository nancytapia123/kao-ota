<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);


include 'vendor/autoload.php';
class ControllerRegistro extends Controller {
    function __construct($view, $conf, $var, $acc) {
        parent::__construct($view, $conf, $var, $acc);
    }
     public function main() {
    	    foreach ($this->var as $key => $value) {
            $this->data[$key] = $value;
            $$key=$value;
        }
       
       if( isset($txtNombre) && isset($txtApellidoPa) && isset($txtApellidoMa) && isset($txtfecha_nacimiento) && isset($txtPais) && isset($txtEstadoNac) &&
       isset($txtTelefono)  && isset($txtAsesor)  && isset($txtCurp) && isset($txtRfc) && isset($txtHomoclave)){
         
            $datoss["Dominio"]="user";
            if($txtAsesor>0){
                $datoss["txtsupervisor_id"]=$txtAsesor;
            }     
            $datoss["txtnombres"]=$txtNombre;
            $datoss["txtapellido_paterno"]=$txtApellidoPa;
            $datoss["txtapellido_materno"]=$txtApellidoMa;
            $datoss["txtcalle"]=$txtCalle;
            $datoss["txtnumero_exterior"]=$txtNoExterior;
            $datoss["txtnumero_interior"]=$txtNoInterior;
            $datoss["txtcodigo_postal"]=$txtCodigoPostal;
            $datoss["txtcolonia"]=$txtColonia;  
            $datoss["txtmunicipio"]=$txtMunicipio;
            $datoss["txtestado"]=$txtEstado;           
            $datoss["txttelefono"]=$txtTelefono;
            $datoss["txtcurp"]=$txtCurp;
            $datoss["txtfecha_nac"]=$txtfecha_nacimiento;
            $datoss["txtpais_nac"]=$txtPais;
            $datoss["txtestado_nac"]=$txtEstadoNac;
            $datoss["txtrfc"]=$txtRfc;
            $datoss["txthomoclave"]=$txtHomoclave;
            $datoss["txtgenero_id"]=$txtgenero;
            $datoss["txtsueldo"]=$txtSueldo;
            $datoss["txtdepositos"]=$txtDepositos;
            $datoss["txtmonto"]=$txtMonto;
            $datoss["txtnacionalidad_id"]=$txtnacionalidad;
            $datoss["txtactividad_principal_id"]=$txtActividad;
            $datoss["txtfuente_ingresos_id"]=$txtFuente_ingresos;
            $actualizar = indexModel::bd($this->conf)->updateDominio($datoss,$_COOKIE["idUser"]);       
            rename($_SERVER['DOCUMENT_ROOT']."/includes/images/users/".$foto, $_SERVER['DOCUMENT_ROOT']."/includes/images/users/".$actualizar.".png");
           
            //CODIGO PARA GUARDAR IDENTIFICACION
            foreach($_FILES["image-identificacion"]['tmp_name'] as $key =>$tmp_name)
            {
                $document["Dominio"]="documento";
                    $document["txttipo_documento_id"]='1';                             
                    $guardardoc1 = indexModel::bd($this->conf)->updateDominio($document);
                if($_FILES["image-identificacion"]["name"][$key]) {
                    // Nombres de archivos de temporales
                    $archivonombre = $_FILES["image-identificacion"]["name"][$key]; 
                    $fuente = $_FILES["image-identificacion"]["tmp_name"][$key]; 
                    
                    $estructura= dirname(__FILE__) . "/../../includes/documents";//Declaramos el nombre de la carpeta que guardara los archivos
                    $extt = explode(".", $archivonombre);          
                     $add = $estructura."/".$guardardoc1.".".$extt[1];                
                        $archivo=$guardardoc1.".".$extt[1];  
                       
                     //condicional si el fuchero existe
                    if(!file_exists($estructura)){
                        mkdir($estructura, 0777) or die("Hubo un error al crear el directorio de almacenamiento");	
                    }
                    
                    $dir=opendir($estructura);
                    //$target_path = $estructura.'/'.$add; //indicamos la ruta de destino de los archivos
                    
            
                    if(move_uploaded_file($fuente, $add)) {	
                        closedir($dir); //Cerramos la conexion con la carpeta destino
                    
                        } else {	
                      
                    }
                    
                }        
                $parser  = new \Smalot\PdfParser\Parser();
                $pdf     = $parser->parseFile($add);
                $pages  = $pdf->getPages();
                $totalPages = count($pages);
                foreach ($pages as $page) {
                   $text = $page->getText();
                  
                }
                $query="UPDATE documento SET documento='".$add."',contenido='".$text."',extension='".$extt[1]."'  WHERE id=".$guardardoc1;
           
                indexModel::bd($this->conf)->getSQL($query);              
            }
             
            //CODIGO PARA GUARDAR COMPROBANTE
            foreach($_FILES["image-comprobante"]['tmp_name'] as $key =>$tmp_name)
            {
                $document["Dominio"]="documento";            
                $document["txttipo_documento_id"]='2';             
        
                $guardardoc = indexModel::bd($this->conf)->updateDominio($document);
               
                //condicional si el fuchero existe
                if($_FILES["image-comprobante"]["name"][$key]) {
                    // Nombres de archivos de temporales
                    $archivonombre = $_FILES["image-comprobante"]["name"][$key]; 
                    $fuente = $_FILES["image-comprobante"]["tmp_name"][$key]; 
                    
                    $estructura= dirname(__FILE__) . "/../../includes/documents";//Declaramos el nombre de la carpeta que guardara los archivos
                    $ext = explode(".", $archivonombre);                 
                    $add = $estructura."/".$guardardoc.".".$ext[1];    
                    $dir=opendir($estructura);
                    //$target_path = $estructura.'/'.$add; //indicamos la ruta de destino de los archivos
    
                    if(move_uploaded_file($fuente, $add)) {	
                       
                        
                        } else {	
                    
                    }
                    closedir($dir); //Cerramos la conexion con la carpeta destino
                    
                }      
                   
            }
                        $parser  = new \Smalot\PdfParser\Parser();
                        $pdf    = $parser->parseFile($add);
                        $pages  = $pdf->getPages();
                        $totalPages = count($pages);
                        foreach ($pages as $page) {
                        $text = $page->getText();
                       }
                      
                    $query="UPDATE documento SET documento='".$add."',contenido='".$text."',extension='".$ext[1]."' WHERE id=".$guardardoc;    
                    indexModel::bd($this->conf)->getSQL($query);   
            
        }

                //CONSULTA PARA OBTENER ASESOR
            $sql="SELECT * FROM user WHERE rol_id='2' AND status_id = '1' ";
            $this->data["asesor"] = indexModel::bd($this->conf)->getSQL($sql);
            //CONSULTA PARA OBTENER ACTIVIDAD PRINCIPAL
            $sql2="SELECT * FROM actividad_principal";
            $this->data["actividad"] = indexModel::bd($this->conf)->getSQL($sql2);
             //CONSULTA PARA OBTENER FUENTES DE INGRESO
             $sql3="SELECT * FROM fuente_ingresos";
             $this->data["ingresos"] = indexModel::bd($this->conf)->getSQL($sql3);

              //CONSULTA PARA OBTENER GENERO
            $consultag="SELECT * FROM genero";
            $this->data["genero"] = indexModel::bd($this->conf)->getSQL($consultag);
              //CONSULTA PARA OBTENER PAIS
              $consultapa="SELECT * FROM pais";
              $this->data["pais"] = indexModel::bd($this->conf)->getSQL($consultapa);
                       //CONSULTA PARA OBTENER NACIONALIDAD
             $query="SELECT * FROM nacionalidad";
             $this->data["nacionalidad"] = indexModel::bd($this->conf)->getSQL($query);
            //CONSULTA PARA MOSTRAR LOS DATOS REGISTRADOS DEL USUARIO
                $sql4="SELECT * FROM user As u 
                INNER JOIN fuente_ingresos AS f  ON f.id = u.fuente_ingresos_id
                INNER JOIN actividad_principal As a  ON a.id=u.actividad_principal_id 
                INNER JOIN genero As g ON g.id=u.genero_id
                INNER JOIN pais As p ON p.id=u.pais_nac
                   WHERE u.id=".$_COOKIE["idUser"];
                 $this->data["usuario"] = indexModel::bd($this->conf)->getSQL($sql4);
            if($actualizar > 0){
                $data["isCorrect"] = TRUE;
                        $data["tituloMensaje"] = "Exito!";
                        $data["Mensaje"] = "Registro guardado de forma correcta.";
                        $data["return"] = $this->var["path"]."home";
                        $data["tiempo"] = "3";
                        $data["return"]=indexModel::bd($this->conf)->getMensaje($data);
                        $templa  = "mensajeBackEnd.html";
                        $this->view->show($templa, $data, $this->accion);
            }else {
                //indexModel::bd($this->conf)->controlAcceso(["1","2","3"]);
                $this->view->show("registro.html", $this->data, $this->accion);
            }
    }
}
?>
