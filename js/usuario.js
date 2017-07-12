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
	$("#USGuardar").click(function(evento){
		guardar();
	});
})
$(document).ready(function(){
	$("#USRetornar").click(function(evento){
		retornar();
	});
})

function retornar(){
	$("#principal").load( url, {
				    controlador: "Usuario",
					accion: "listar"}, 
					function(response, status, xhr){

					}
	);
}
function guardar(){
	// obtenemos los datos

	msg = validar();
	if(msg.length <= 0 ){
		var e = document.getElementById("USGrupo");
		$("#principal").load(url, {
			controlador: "Usuario",
			accion: "guardar",
			pkUsuario		: document.getElementById("USPkUsuario").value,
			nickName 		: document.getElementById("USNickName").value,
			nombreCompleto 	: document.getElementById("USNombreCompleto").value,
			apellidos 		: document.getElementById("USApellidos").value,
			email 			: document.getElementById("USEmail").value,
			password 		: document.getElementById("USPassword").value,
			fkGrupoUsuario	: e.options[e.selectedIndex].value
		});
	}else{
		document.getElementById("idmsg").innerHTML = msg;
		$('#messsageModal').modal('show');
	}
}
function validar(){
	msg = "";
	
	if((document.getElementById("USNombreCompleto").value).length <= 0){
		msg += "Ingrese nombre completo  </br>";
	}
	
	if((document.getElementById("USNickName").value).length <= 0){
		msg += "Ingrese nombre de usuario  </br>";
	}
	
	if((document.getElementById("USApellidos").value).length <= 0){
		msg += "Ingrese Apellidos  </br>";
	}
	
	if((document.getElementById("USPassword").value).length <= 0){
		msg += "Ingrese Contraseña </br>";
	}
	
	if(document.getElementById("USPassword").value != document.getElementById("USPassword1").value){
		msg += "contraseñas distintas  </br>";
	}

	var e = document.getElementById("USGrupo");
	if(e.options[e.selectedIndex].value < 0){
		msg += "Seleccione un grupo de usuario </br>";
	}

	return msg;
}
// list vist improductiva
function editar(pkUsuario){
	// nesecito cargar mi vista de edicion!!
	
	if(pkUsuario > 0){
		$("#principal").load(url, {
			controlador: "Usuario",
			accion: "editar",
			pkUsuario: pkUsuario
		});
	}else{		
		document.getElementById("idmsg").innerHTML = "Seleccione un usuario";
		$('#messsageModal').modal('show');		
	}
}
function eliminar(pkUsuario, data){
	
	if(confirm("Esta seguro de eliminar el Usuario [" + data + "]?")){
		if(pkUsuario > 0){
			$("#principal").load(url, {
				controlador: "Usuario",
				accion: "eliminar",
				pkUsuario: pkUsuario
			});
		}

	}

}

function nuevo(){
	$("#principal").load(url, {
		controlador: "Usuario",
		accion: "nuevo"
	});

}