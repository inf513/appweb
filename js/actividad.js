var url = "./";

// funcion de tooltip
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
// funcion de vista List actividad <nuevo>
$(document).ready(function(){
	$("#idbtnNuevo").click(function(evento){
		nuevo();
	});
})

// funciones de la vista acctividad
$(document).ready(function(){
	$("#IMGuardar").click(function(evento){
		guardar();
	});
})
$(document).ready(function(){
	$("#IMRetornar").click(function(evento){
		retornar();
	});
})
function retornar(){
	$("#principal").load( url, {
				    controlador: "Actividad",
					accion: "listar"}, 
					function(response, status, xhr){
						console.log("algo paso : " + status);
						console.log(response);
					}
	);
}
function guardar(){
	// obtenemos los datos
	msg = validar();
	if(msg.length <= 0 ){

		$("#principal").load(url, {
			controlador: "Actividad",
			accion: "guardar",
			pkActividad	: document.getElementById("IMPkActividad").value,
			codigo 			: document.getElementById("IMCodigo").value,
			descripcion 	: document.getElementById("IMDescripcion").value

		});

	}else{
		document.getElementById("idmsg").innerHTML = msg;
		$('#messsageModal').modal('show');
	}
}
function validar(){
	msg = "";
	if((document.getElementById("IMCodigo").value).length <= 0){
		msg += "Ingrese codigo de actividad </br>";
	}
	if((document.getElementById("IMDescripcion").value).length <= 0){
		msg += "Ingrese descripcion de actividad </br>";
	}
	return msg;
}
// list vist improductiva
function editar(pkActividad){
	// nesecito cargar mi vista de edicion!!
	
	if(pkActividad > 0){
		$("#principal").load(url, {
			controlador: "Actividad",
			accion: "editar",
			pkActividad: pkActividad
		});
	}else{		
		document.getElementById("idmsg").innerHTML = "Seleccione una actividad!!";
		$('#messsageModal').modal('show');		
	}
}

function eliminar(pkActividad, data){
	console.log("eliminar en actividad.js");
	if(confirm("Esta seguro de eliminar la actividad [" + data + "]?")){
		
		if(pkActividad > 0){
			$("#principal").load(url, {
				controlador: "Actividad",
				accion: "eliminar",
				pkActividad: pkActividad
			});
		}

	}

}
function nuevo(){

	$("#principal").load(url, {
		controlador: "Actividad",
		accion: "nuevo"
	});

}