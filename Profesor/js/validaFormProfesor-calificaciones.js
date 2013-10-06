jQuery(document).ready(function($){
	var error= document.createElement("div");

	//valida en cada elemento individualmente
	
	$('#codigo').focus(function(event) {
		
		$(".error").remove();
	});
	//---------------
	$('#nombre').focus(function(event) {
		$(".error").remove();
	});
	//---------------
	$('#apellidos').focus(function(event) {
		$(".error").remove();
	});
	//-----------
	
	$('#seccion').focus(function(event) {
		$(".error").remove();
	});
	//---------
	
	$('#carrera').focus(function(event) {
		$(".error").remove();
	});
	//----------
	
	$('#correo').focus(function(event) {
		$(".error").remove();
	});
	//----------
	
	$('#celular').focus(function(event) {
		$(".error").remove();
	});
	//----------
	
	$('#github').focus(function(event) {
		$(".error").remove();
	});
	//----------
	
	$('#web').focus(function(event) {
		$(".error").remove();
	});

	// valida cuando se da click en el boton de enviar
	$(".enviar").click(function (e) {
		e.preventDefault();//para evitar que se envie antes de validar
		//si ya hay mensajes de error se borran para validar de nuevo
		$(".error").remove();

		var camposNumber=$("input[type=number]");

		camposNumber.each(function(){

			alert(this.val());
		});

	});

});

