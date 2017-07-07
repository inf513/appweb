var url = "./";
$(function ()
	{
		$('#ESFecha').datetimepicker({
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
	$("#ESGuardar").click(function(evento){
		guardar();
	});
})
$(document).ready(function(){
	$("#ESRetornar").click(function(evento){
		retornar();
	});
})

function retornar(){
	$("#principal").load( url, {
				    controlador: "EstadoEquipo",
					accion: "listar"},
					function(response, status, xhr){
						console.log(response);
					}
	);
}
function guardar(){
	msg = validar();

	if(msg.length <= 0 ){
		var cod = document.getElementById("ESEstado");
		$("#principal").load(url, {
			controlador		: "EstadoEquipo",
			accion			: "guardar",
			fkEquipo		: document.getElementById("ESFkEquipo").value,
			fecha 			: document.getElementById("ESFecha").value,
			motivo 			: document.getElementById("ESMotivo").value,
			personal 		: document.getElementById("ESPersonal").value,
			estado 			: cod.options[cod.selectedIndex].value
		});

	}else{
		document.getElementById("idmsg").innerHTML = msg;
		$('#messsageModal').modal('show');
	}
}
function validar(){
	msg = "";
	if((document.getElementById("ESMotivo").value).length <= 0){
		msg += "Ingrese motivo de cambio de estado </br>";
	}
	if((document.getElementById("ESPersonal").value).length <= 0){
		msg += "Ingrese responsable de cambio de estado </br>";
	}
	if((document.getElementById("IDError").innerHTML).length > 0){
		msg += "Estado no valido </br>";
	}

	return msg;
}

function editar(fkEquipo){
	// nesecito cargar mi vista de edicion!!
	
	if(fkEquipo > 0){
		$("#principal").load(url, {
			controlador: "EstadoEquipo",
			accion: "editar",
			fkEquipo: fkEquipo
		});
	}else{
		document.getElementById("idmsg").innerHTML = "Seleccione un Equipo por favor!!";
		$('#messsageModal').modal('show');
	}
}

function nuevo(){

	$("#principal").load(url, {
		controlador: "Improductiva",
		accion: "nuevo"
	});

}

function validarEstado(){

	var cod = document.getElementById("ESEstado");
	var id = document.getElementById("ESFkEquipo").value;
	respuesta = "";
	console.log(cod.options[cod.selectedIndex].value);

	$.post(
			url,
			{ 
			  controlador	: "EstadoEquipo",
			  accion		: "validarEstado",
			  fkequipo 		: id,
			  estado 		: cod.options[cod.selectedIndex].value
			},
			function(datos){								
				document.getElementById("IDError").innerHTML = datos.data;
			}, "json"
		  );
	
}

