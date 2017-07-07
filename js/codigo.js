var url = "./";

// funcion de tooltip
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
// funcion de vista List de codigos <nuevo>
$(document).ready(function(){
	$("#idbtnNuevoCodigo").click(function(evento){
		nuevo();
	});
})

// funciones de la vista codigo
$(document).ready(function(){
	$("#COGuardar").click(function(evento){
		guardar();
	});
})
$(document).ready(function(){    
	$("#CORetornar").click(function(evento){
		console.log("on ready back");
		retornar();
	});
})

$(document).ready(function(){    
	$("#COAddHoja").click(function(evento){
		console.log("Adicionar hoja");
		adicionarHoja();
	});
})

$(document).ready(function(){    
	$("#CODelHoja").click(function(evento){
		console.log("Eliminar hoja");
		eliminarHoja();
	});
})

function retornar(){
	$("#principal").load( url, {
				    controlador: "Codigo",
					accion: "listar"}, 
					function(response, status, xhr){
						console.log(response);
					}
	);
}

function codigoDATA(pkcodigo, codigo){
	this.pkcodigo = pkcodigo;
	this.codigo   = codigo;
}

function getValues(){
	var lista = [];
	$("#idCompuesto option").each(function (){
		var cod = new codigoDATA($(this).val(), $(this).text());
	    lista.push(cod);
	});    
	return lista;
}



function guardar(){
	// obtenemos los datos	
	hojas = JSON.stringify(getValues());
	
	msg = validar();
	if(msg.length <= 0 ){		
		$("#principal").load(url, {
			controlador: "Codigo",
			accion: "guardar",
			pkCodigo		: document.getElementById("COPkCodigo").value,
			codigo 			: document.getElementById("COCodigo").value,
			descripcion 	: document.getElementById("CODescripcion").value,
			compuesto 		: hojas
		});

	}else{
		document.getElementById("idmsg").innerHTML = msg;
		$('#messsageModal').modal('show');
	}
}

function validar(){
	msg = "";
	if((document.getElementById("COCodigo").value).length <= 0){
		msg += "Ingrese codigo </br>";
	}
	if((document.getElementById("CODescripcion").value).length <= 0){
		msg += "Ingrese descripcion </br>";
	}
	return msg;
}


// list vist codigo
function editar(pkCodigo){
	// nesecito cargar mi vista de edicion!!	
	if(pkCodigo > 0){
		$("#principal").load(url, {
			controlador: "Codigo",
			accion: "editar",
			pkCodigo: pkCodigo
		});
	}else{		
		document.getElementById("idmsg").innerHTML = "Seleccione un Codigo!!";
		$('#messsageModal').modal('show');		
	}
}

function eliminar(pkCodigo, data){
	if(confirm("Esta seguro de eliminar el Codigo [" + data + "]?")){
		
		if(pkCodigo > 0){
			$("#principal").load(url, {
				controlador: "Codigo",
				accion: "eliminar",
				pkCodigo: pkCodigo
			});
		}

	}

}

function nuevo(){
	console.log("nueveo");
	$("#principal").load(url, {
		controlador: "Codigo",
		accion: "nuevo"
	});

}
function adicionarHoja(){

	idCodigo = document.getElementById("pkCodigoCompuesto").value;
	codigo   = document.getElementById("CODCompuesto").value;
	descripc = document.getElementById("CODescripcionComp").innerHTML;

	//$("#idCompuesto").append("<option value='" + idCodigo + "'>" + codigo + " : " + descripc + "</option>");
	if(codigo.length > 0){
		$("#idCompuesto").append("<option value='" + idCodigo + "'>" + codigo + "</option>");
	}
	
}

function eliminarHoja(){
	var select = document.getElementById("idCompuesto");
	select.remove(select.selectedIndex);
}

function salidafoco(){
	$.post(
				url, 
				{ 
				  controlador: "Codigo",
				  accion: "getCodigo",
				  data : document.getElementById("CODCompuesto").value
				},
				function(datos){
					
					console.log("status : " + datos.status);

					if(datos.status == "error"){
						document.getElementById("pkCodigoCompuesto").value = 0;
						document.getElementById("CODCompuesto").value = "";
						document.getElementById("CODescripcionComp").innerHTML  = "CODIGO COMP. NO VALIDO";

					}else{
						document.getElementById("pkCodigoCompuesto").value = datos.pkcodigo;
						document.getElementById("CODCompuesto").value = datos.codigo;
						document.getElementById("CODescripcionComp").innerHTML  = datos.descripcion;
					}
				}, "json"
		  );
}