 /*-- ==========================
            SUBIENDO FOTO DE EDITAR PERFIL  
      =============================--*/ 

      $("#img-foto2").change(function(){

        var imagen = this.files[0];
        
  /*-- ======================================
  VALIDAMOS EL FORMATO DE LA FOTO DE USUARIO   
  ============================================--*/ 

  if(imagen["type"] !="image/jpg" && imagen["type"] != "image/png"){

  $("#img-foto2").val("");

  alert("El formato de la imagen solo puede ser JPG o PNG, seleccione otra imagen");
              
  }else{

              var datosImagen = new FileReader;
              datosImagen.readAsDataURL(imagen);

              $(datosImagen).on("load",function(event){

                    var rutaImagen =event.target.result;
                    
                    $(".previsualizar2").attr("src", rutaImagen);

              })
         }
  })
