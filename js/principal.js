var url = "./";


$(document).ready(function(){
	$("#idFImproductiva").click(function(evento){
		cargarForumulario(evento, "Improductiva", "listar");	
	});

	$("#idFActividad").click(function(evento){
		cargarForumulario(evento, "Actividad", "listar");	
	});

	$("#idFEstadistica").click(function(evento){
		cargarForumulario(evento, "Estadistica", "listar");	
	});

	$("#idFUsuario").click(function(evento){
		cargarForumulario(evento, "Usuario", "listar");	
	});

	$("#idFOt").click(function(evento){
		cargarForumulario(evento, "OrdenTrabajo", "listar");	
	});
	$("#idFActividad").click(function(evento){
		cargarForumulario(evento, "Actividad", "listar");	
	});
	$("#idFPersonal").click(function(evento){
		cargarForumulario(evento, "Personal", "listar");
	});
	$("#idFProductiva").click(function(evento){
		cargarForumulario(evento, "ItemObra", "listar")
	});

	$("#idFEquipo").click(function(evento){
		cargarForumulario(evento, "Equipo", "listar")
	});

	$("#idFGestion").click(function(evento){
		cargarForumulario(evento, "Gestion", "listar")
	});

	$("#idFPoligono").click(function(evento){
		cargarForumulario(evento, "Poligono", "listar")
	});

	$("#idEstadoEquipo").click(function(evento){
		cargarForumulario(evento, "EstadoEquipo", "listar")
	});

	$("#idCodigo").click(function(evento){
		cargarForumulario(evento, "Codigo", "listar")
	});


	$("#idFTransfPersonal").click(function(evento){
		cargarForumulario(evento, "TransfPersonal", "listar")
	});

	$("#idFTransfEquipo").click(function(evento){
		cargarForumulario(evento, "TransfEquipo", "listar")
	});

	$("#inicio").click(function(evento){
		cargarForumulario(evento, "Autenticacion", "inicio")
	})


	// deshabilitamos los links
    var navItems = $('.admin-menu li > a');
    var navListItems = $('.admin-menu li');
    var allWells = $('.admin-content');
    var allWellsExceptFirst = $('.admin-content:not(:first)');
    
    allWellsExceptFirst.hide();
    navItems.click(function(e)
    {

	e.preventDefault();
	        navListItems.removeClass('active');
	        $(this).closest('li').addClass('active');
    });

})

function cargarForumulario(evento, controll, action){
	
	evento.preventDefault();

	$("#principal").load( url, {
				    controlador: controll,
					accion: action}, 
					function(response, status, xhr){

					}
	);
}