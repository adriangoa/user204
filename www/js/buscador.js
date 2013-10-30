$(document).on("ready", main);

function main(){
	$("#buscar").on("keyup", buscar);
}

function buscar(){
	var resultado = $(".resultado");//se obtienen todos los divs de resultado
	var texto = $("#buscar").val();
	texto = texto.toLowerCase();
	resultado.show();//se muestran todos
	for(var i=0; i< resultado.size(); i++){//ciclo para mostrar solo el necesario
		var contenido = resultado.eq(i).text();
		contenido = contenido.toLowerCase();
		var index = contenido.indexOf(texto);//busca en cualquier parte del contenido
		if(index == -1){
			resultado.eq(i).hide();//si no se encuentra, se esconde
		}
	}
}