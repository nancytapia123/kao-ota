
<?php
include 'configAjax.php';

foreach ($_REQUEST as $key => $value) {
    // echo $key . "--".$value."";
     $$key =  Security($value);
  }

if (isset($_POST["email"])){

    $sql="SELECT * FROM user WHERE email = '$email'";
   // echo $sql;
    $usuarios = $db->prepare($sql);
      $usuarios->execute();
      $validar =$usuarios->rowCount();
     //echo $validar;
      if($validar>0){
        $excepcion = array("existente" =>"1");
      }else{
        $excepcion = array("existente" =>"0");
			
       
      }
      
      echo json_encode($excepcion);

}