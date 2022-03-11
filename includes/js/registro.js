
		/* paso 1*/
$("#btnstep4").click(function () {

    var datos = {
        genero_id: $("#txtgenero").val(),
       
    };

    $.ajax({
        type: "POST",
        async: false,
        url: "includes/ajax/guardar_foto.php",
        data: datos,
        dataType: "json",
      }).done(function (response) {
       
        $("#Mgenero").text(response.genero);
      });


      var datos2 = {
        
        pais_id: $("#txtPais").val(),
    };
      $.ajax({
        type: "POST",
        async: false,
        url: "includes/ajax/guardar_foto.php",
        data: datos2,
        dataType: "json",
      }).done(function (response) {
        
        $("#Mpais").text(response.pais);
      });
       

      var datos3 = {
        
        actividad_id: $("#txtActividad").val(),
    };
      $.ajax({
        type: "POST",
        async: false,
        url: "includes/ajax/guardar_foto.php",
        data: datos3,
        dataType: "json",
      }).done(function (response) {
       
        $("#Mact_principal").text(response.actividad);
      });


      var datos4 = {
        
        fuente_id: $("#txtFuente_ingresos").val(),
    };
      $.ajax({
        type: "POST",
        async: false,
        url: "includes/ajax/guardar_foto.php",
        data: datos4,
        dataType: "json",
      }).done(function (response) {
       
        $("#Mfuente").text(response.fuente_ingresos);
      });

        $("#Mnombre").text( $("#username").val());
        $("#Mapellido_p").text( $("#txtApellidoPa").val());
        $("#Mapellido_m").text( $("#txtApellidoMa").val());
        $("#Mfecha_nac").text( $("#txtfecha_nacimiento").val());
        $("#Mestado").text( $("#txtEstadoNac").val());
        $("#Mtelefono").text( $("#txtTelefono").val());
        $("#Mcalle").text( $("#txtCalle").val());
        $("#MnoExterior").text( $("#txtNoExterior").val());
        $("#MnoInterior").text( $("#txtNoInterior").val());
        $("#McodigoPostal").text( $("#txtCodigoPostal").val());
        $("#Mcolonia").text( $("#txtColonia").val());
        $("#Mmunicipio").text( $("#txtMunicipio").val());
        $("#Mestadod").text( $("#txtEstado").val());
        $("#Msueldo").text( $("#txtSueldo").val());


});

	

	