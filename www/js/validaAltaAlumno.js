jQuery(document).ready(function($){
	var sinError=true;
	var DIV= document.createElement("div");
	var check=true;
//se eliminan los errores
	$('input[type=checkbox]').change(function(event) {
			
			$(".error").remove();
			sinError= true;
		});

	$('#select-cursos').change(function(event) {
			
			sinError= true;
			$(".error").remove();
		});

	$('#seleccionar-todo').click(function(event) {
			
			$(".error").remove();
			sinError= true;
			$('input[type=checkbox]').attr('checked', check);
			check=!check;
			return false;
		});
///////
	$("#btn-agregar").click(function(event) {
		$(".error").remove();
		if(!$('input[type=checkbox]:checked').length)
		{
			sinError=false;
			$(DIV).text("Selecciona Alumnos")
					.addClass("error")
					.css('display', 'block')
			    	.clone().insertAfter($("#select-cursos"));
		}
		return sinError;
	});
});