jQuery(document).ready(function($){
	var DIALOG= document.createElement("div");
	$(".mostrarHoja").click(function (e){
		$( DIALOG ).html("");
		//se obtiene con ajax
		//creamos el objeto Ajax
		var miajax=nuevoAjax();
		//hago la peticion a mi server
		miajax.open('get','index.php?ctl=Profesor&act=mostrarHojaExtra&idActividad='+$(this).attr("id"),true);

		//funcion para cuando ccambie el estatus
		miajax.onreadystatechange=function()
		{

			if(miajax.readyState==4)
			{

				
				var json = eval(miajax.responseText);
				for( i in json){
					$( DIALOG ).append('<label for"'+(parseInt(i)+1)+'">Porcentaje Rublo '+(parseInt(i)+1)+'</label><input type="text" value="'+json[i].porcentaje+'" disabled="true">');
					
				}

				$( DIALOG ).dialog({
			      modal: true,
			      title: "Rublos de evaluacion",
			      buttons: {
			        Cerrar: function() {
			          $( this ).dialog( "close" );
			        }
			      }
			    });
				
			}
		}

		miajax.send(null);
		return false;
	});	

	
});
