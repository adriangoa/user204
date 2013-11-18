jQuery(document).ready(function($){
	var error=false;
	document.querySelector('body').addEventListener('click', function(event) {
	  if (event.target.id === 'guardar-calificaciones') 
	  {
	  	error=false;
	  	$('#formulario-calificaciones input').each(function() {
	  		if($(this).attr('class') != undefined)
	  		{
	  			if($(this).val() =="" || $(this).val() > $(this).attr('class') || $(this).val() < 0 || isNaN( parseInt($(this).val() ) ))
	  			{
	  				error=true;
	  			}
	  		}
	  		
		});//fin de each

	  	if(error==false)
	  		$( "#formulario-calificaciones" ).submit();
	  	else
	  		alert("se muestra el error");
	  }
	});

});