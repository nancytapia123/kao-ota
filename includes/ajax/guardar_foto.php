<?php
header('content-type: application/json; charset=utf-8');
header("access-control-allow-origin: *");
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
include 'configAjax.php';
ini_set('display_errors',0);
error_reporting(E_ALL);
//include '../../framework/catalogos/catalogos.php';
foreach ($_REQUEST as $key => $value) {
   // echo $key . "--".$value."<br>";
    $$key =  Security($value);
}


if(isset($_POST["photo"])){
            
$imagenCodificada = $_POST["photo"]; //Obtener la imagen

if(strlen($imagenCodificada) <= 0) exit("No se recibió ninguna imagen");
//La imagen traerá al inicio data:image/png;base64, cosa que debemos remover
$imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));
 
//Venía en base64 pero sólo la codificamos así para que viajara por la red, ahora la decodificamos y
//todo el contenido lo guardamos en un archivo
$imagenDecodificada = base64_decode($imagenCodificadaLimpia);

//Calcular un nombre único
$nombreImagenGuardada = "foto_".uniqid().".png";
 
//Escribir el archivo
file_put_contents("../images/users/".$nombreImagenGuardada, $imagenDecodificada);
 
//Terminar y regresar el nombre de la foto
exit($nombreImagenGuardada);


}


//genero

if(isset($_POST["genero_id"])){
    $query="SELECT * FROM genero WHERE id=$genero_id";
    $genero = $db->prepare($query);
    $genero->execute();
    $ge = $genero->fetchAll(PDO::FETCH_OBJ)[0];
    
    echo json_encode($ge);  
}

//pais
if(isset($_POST["pais_id"])){
    $query="SELECT * FROM pais WHERE id=$pais_id";
    $pais = $db->prepare($query);
    $pais->execute();
    $pa = $pais->fetchAll(PDO::FETCH_OBJ)[0];
    
    echo json_encode($pa);    
}

//actividad principal
if(isset($_POST["actividad_id"])){
    $query="SELECT * FROM actividad_principal WHERE id=$actividad_id";
    $pais = $db->prepare($query);
    $pais->execute();
    $pa = $pais->fetchAll(PDO::FETCH_OBJ)[0];
    
    echo json_encode($pa);    
}

//fuente de ingreso
if(isset($_POST["fuente_id"])){
    $query="SELECT * FROM fuente_ingresos WHERE id=$fuente_id";
    $pais = $db->prepare($query);
    $pais->execute();
    $pa = $pais->fetchAll(PDO::FETCH_OBJ)[0];
    
    echo json_encode($pa);    
}

?>