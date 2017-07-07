var url = "./";

$(function ()
	{
		$('#EQFechaIngreso').datetimepicker({
			locale : 'es'
		});
	}
);

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
	$("#EQGuardar").click(function(evento){
		guardar();
	});
})
$(document).ready(function(){
	$("#EQRetornar").click(function(evento){
		retornar();
	});
})

function retornar(){
	$("#principal").load( url, {
				    controlador: "Equipo",
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
		var cod = document.getElementById("EQCodigo");
		var c = document.getElementById("EQContrato");
		$("#principal").load(url, {
			controlador		: "Equipo",
			accion			: "guardar",
			pkEquipo		: document.getElementById("EQPkEquipo").value,
			fkCodigo		: cod.options[cod.selectedIndex].value,
			codigo 			: cod.options[cod.selectedIndex].text,
			fkTipoContrato 	: c.options[c.selectedIndex].value,
			fechaIngreso	: document.getElementById("EQFechaIngreso").value,
			fkOrdenTrabajo 	: document.getElementById("EQIDOt").value,
			descripcion 	: document.getElementById("EQDescripcion").value,
			
		});
	}else{
		document.getElementById("idmsg").innerHTML = msg;
		$('#messsageModal').modal('show');
	}
}
function validar(){
	msg = "";
	
	if(document.getElementById("EQIDOt").value <= 0){
		msg += "Ingrese codigo de Orden de Trabajo </br>";
	}

	if((document.getElementById("EQDescripcion").value).length <= 0){
		msg += "Ingrese descripcion de actividad </br>";
	}

	var cod = document.getElementById("EQCodigo");
	if(cod.options[cod.selectedIndex].value < 0){
		msg += "Seleccione Codigo de equipo </br>";
	}

	var c = document.getElementById("EQContrato");
	if(c.options[c.selectedIndex].value < 0){
		msg += "Seleccione Tipo de Contrato </br>";
	}

	return msg;
}
// list vist improductiva
function editar(pkEquipo){
	// nesecito cargar mi vista de edicion!!
	
	if(pkEquipo > 0){
		$("#principal").load(url, {
			controlador: "Equipo",
			accion: "editar",
			pkEquipo: pkEquipo
		});
	}else{		
		document.getElementById("idmsg").innerHTML = "Seleccione Equipo!!";
		$('#messsageModal').modal('show');		
	}
}
function eliminar(pkEquipo, data){
	
	if(confirm("Esta seguro de eliminar el Equipo [" + data + "]?")){
		if(pkEquipo > 0){
			$("#principal").load(url, {
				controlador: "Equipo",
				accion: "eliminar",
				pkEquipo: pkEquipo
			});
		}

	}

}

function nuevo(){

	$("#principal").load(url, {
		controlador: "Equipo",
		accion: "nuevo"
	});

}

function salidafoco(){

	$.post(
				url, 
				{ 
				  controlador: "Equipo",
				  accion: "getOrdenTrabajo",
				  data : document.getElementById("EQOrdenTrabajo").value
				},
				function(datos){
					
					console.log("status : " + datos.status);

					if(datos.status == "error"){
						document.getElementById("EQIDOt").value = 0;
						document.getElementById("EQOrdenTrabajo").value = "";
						document.getElementById("EQNombreOt").innerHTML  = "";
					}else{
						document.getElementById("EQIDOt").value = datos.pkordentrabajo;
						document.getElementById("EQOrdenTrabajo").value = datos.data;
						document.getElementById("EQNombreOt").innerHTML  = datos.nombre;
					}
				}, "json"
		  );
}