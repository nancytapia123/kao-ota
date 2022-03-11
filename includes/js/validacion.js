/*************paso 1***************/
const form = document.getElementById('form');
const usuario = document.getElementById('username');
const txtApellidoPa = document.getElementById('txtApellidoPa');
const txtApellidoMa = document.getElementById('txtApellidoMa');
const txtTelefono = document.getElementById('txtTelefono');
const txtfecha_nacimiento = document.getElementById('txtfecha_nacimiento');


$("#btnstep1").click(() => {
	/* paso 1*/
		if(	checkInputs(usuario, 'No puede dejar el campo en blanco') || checkInputs(usuario, 'No puede dejar el campo en blanco')
		||checkInputs(txtApellidoPa, 'No puede dejar el campo   en blanco')|| checkInputs(txtApellidoMa, 'No puede dejar el campo  en blanco')
		||	checkInputs(txtTelefono, 'No puede dejar el campo en blanco') || checkInputs(txtfecha_nacimiento, 'No puede dejar el campo en blanco')
		 ){
				alert("Favor de llenar todos los campos vacios");
				checkInputs(usuario, 'No puede dejar el campo en blanco');
				checkInputs(usuario, 'No puede dejar el campo en blanco');
				checkInputs(txtApellidoPa, 'No puede dejar el campo   en blanco');
				checkInputs(txtApellidoMa, 'No puede dejar el campo  en blanco');
				checkInputs(txtTelefono, 'No puede dejar el campo en blanco');
				checkInputs(txtfecha_nacimiento, 'No puede dejar el campo en blanco');
				

		}else{
			window.location = "#step-2";
		}
});




/***********  paso 2********************/
const txtCalle = document.getElementById('txtCalle');
const txtNoExterior = document.getElementById('txtNoExterior');
const txtMunicipio = document.getElementById('txtMunicipio');
const txtCodigoPostal = document.getElementById('txtCodigoPostal');
//const txtColonia = document.getElementById('txtColonia');
const txtEstado = document.getElementById('txtEstado');


$("#btnstep2").click(() => {

	if(checkInputs(txtCalle, 'No puede dejar el campo en blanco') || checkInputs(txtNoExterior, 'No puede dejar el campo   en blanco') ||
	checkInputs(txtCodigoPostal, 'No puede dejar el campo   en blanco')){

		checkInputs(txtCalle, 'No puede dejar el campo en blanco');
		checkInputs(txtNoExterior, 'No puede dejar el campo   en blanco');
		checkInputs(txtCodigoPostal, 'No puede dejar el campo   en blanco');
	}else{
		window.location = "#step-3";
	}

});


/* paso 3*/
const txtSueldo = document.getElementById('txtSueldo');

$("#btnstep3").click(() => {

	if(checkInputs(txtSueldo, 'No puede dejar el campo en blanco')){

		checkInputs(txtSueldo, 'No puede dejar el campo en blanco');
	}else{
		window.location = "#step-4";
	}		
	
	});



		/* paso 4*/
const txtidentificacion = document.getElementById('txtidentificacion');
const txtcomprobante = document.getElementById('txtcomprobante');
$("#btnstep4").click(() => {

	window.location = "#step-5";
	
	
	});



function checkInputs(campo, message) {
	// trim to remove the whitespaces
	const usuarioValue = campo.value.trim();



	if (usuarioValue === '') {
		setErrorFor(campo, message);
		return true;
	} else {
		setSuccessFor(campo);
		return false;
	}
}

function setErrorFor(input, message) {
	const formControl = input;
	const formControl2 = input.parentElement;
	const small = formControl2.querySelector('small');
	console.log(small);
	formControl.className = 'form-control error';
	formControl2.className = 'col-md-12 bug error2';
	///small.innerText = message;
}

function setSuccessFor(input) {
	const formControl = input;
	const formControl2 = input.parentElement;
	formControl.className = 'form-control success';
	formControl2.className = 'col-md-12 bug success2';
}

function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}



$('#validate').click(function () {

	if ($('#options').val().trim() === '') {
		alert('Debe seleccionar una opción');

	} else {
		alert('Campo correcto');
	}
});