var url = "./";

// funcion de tooltip
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
// funcion de vista List improductiva <nuevo>
$(document).ready(function(){
	$("#idbtnNuevo").click(function(evento){
		nuevo();
	});
})

// funciones de la vista improductiva
$(document).ready(function(){
	$("#POGuardar").click(function(evento){
		guardar();
	});
})
$(document).ready(function(){
	$("#PORetornar").click(function(evento){
		retornar();
	});
})

function retornar(){
	$("#principal").load( url, {
				    controlador: "Poligono",
					accion: "listar"}, 
					function(response, status, xhr){
						console.log("algo paso : " + status);
					}
	);
}
function guardar(){
	// obtenemos los datos
    msg = validar();
	if(msg.length <= 0 ){

		$("#principal").load(url, {
			controlador		: "Poligono",
			accion			: "guardar",
			pkPoligono		: document.getElementById("POPkPoligono").value,
			fkOrdenTrabajo 	: document.getElementById("POIDOt").value,
			codigo 			: document.getElementById("POCodigo").value,
			descripcion 	: document.getElementById("PODescripcion").value			
		});
	}else{
		document.getElementById("idmsg").innerHTML = msg;
		$('#messsageModal').modal('show');
	}
}
function validar(){
    msg = "";

	if(document.getElementById("POIDOt").value <= 0){
		msg += "Ingrese codigo de Orden de Trabajo </br>";
	}

	if((document.getElementById("PODescripcion").value).length <= 0){
		msg += "Ingrese descripcion </br>";
	}

	if((document.getElementById("POCodigo").value).length <= 0){
		msg += "Ingrese Codigo</br>";
    }
    
	return msg;
}
// list vist improductiva
function editar(pkPoligono){
	// nesecito cargar mi vista de edicion!!
	
	if(pkPoligono > 0){
		$("#principal").load(url, {
			controlador: "Poligono",
			accion: "editar",
			pkPoligono: pkPoligono
		});
	}else{		
		document.getElementById("idmsg").innerHTML = "Seleccione Poligono!!";
		$('#messsageModal').modal('show');
	}
}
function eliminar(pkPoligono, data){
	
	if(confirm("Esta seguro de eliminar el Poligono [" + data + "]?")){
		if(pkPoligono > 0){
			$("#principal").load(url, {
				controlador: "Poligono",
				accion: "eliminar",
				pkPoligono: pkPoligono
			});
		}

	}

}

function nuevo(){

	$("#principal").load(url, {
		controlador: "Poligono",
		accion: "nuevo"
	});

}

function salidafoco(){
    var codigo = document.getElementById("POOrdenTrabajo").value;
	$.post(
				url, 
				{ 
				  controlador: "Poligono",
				  accion: "getOrdenTrabajo",      
				  data : codigo
				},
				function(datos){
					if(datos.status == "error"){
						document.getElementById("POIDOt").value = 0;
						document.getElementById("POOrdenTrabajo").value = "";
						document.getElementById("PONombreOt").innerHTML  = "";
					}else{
						document.getElementById("POIDOt").value = datos.pkordentrabajo;
						document.getElementById("POOrdenTrabajo").value = datos.data;
						document.getElementById("PONombreOt").innerHTML  = datos.nombre;
					}
				}, "json"
		  );
}