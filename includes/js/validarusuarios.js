
    
    
    $("#txtEmail").change(function(){
        $(".alert").remove();
        var datos = {

        "email": $("#txtEmail").val()

        };
           
       $.ajax({
            type: "POST",
            async: false,
            url:  "includes/ajax/validarUsuarios.php",
            data: datos
        }).done(function (response) {

          //  var response = JSON.parse(response);
          //  console.log("hola",response.existente);
            if(response.existente > 0){
                $("#txtEmail").parent().after('<div style="font-size:x-small" class= "alert alert-warning">Este correo ya existe, favor de ingresar otro</div>');
                $("#txtEmail").val("");
            }else{
          
            }
        });
        

        });




       