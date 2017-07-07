var url = "./";

$(function ()
	{
		$('#TFFecha').datetimepicker({
			locale : 'es'
		});
	}
);

// funcion de tooltip
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
// funcion de vista List transferencia
$(document).ready(function(){
	$("#idbtnNuevo").click(function(evento){
		nuevo();
	});
})

// funciones de la vista transferencia d personal
$(document).ready(function(){
	$("#TFGuardar").click(function(evento){
		guardar();
	});
})

$(document).ready(function(){
	$("#TFRetornar").click(function(evento){
		retornar();
	});
})

$("#detalle").click(function(){
    // recorremos todos los valores...
    alert($(this).text());

});


$(document).ready(function(){
	$("#btnDetAdd").click(function(evento){
		adicionarDetalle();
	});
})

$(document).ready(function(){
	$("#btnDtNuevo").click(function(evento){
		nuevoDetalle();
	});
})


function retornar(){
	$("#principal").load( url, {
				    controlador: "TransfEquipo",
					accion: "listar"},
					function(response, status, xhr){
						console.log("algo paso : " + status);
					}
	);
}

/**
 * Function que devuelve un array de la tabla detalles
 * @return {Array} Devuelve un array con todos los detalles
 */
function getDetalleArray(){

	var array = Array();
	var i = 0;

    $("#detalle tr").each(function (index)
    {
    	console.log("entre a fila" + i);
        var detalle = Array(6);
        $(this).children("td").each(function (index2)
        {
            switch (index2)
            {
                case 0: detalle [0] = $(this).text();
                        break;
                case 1: detalle [1]    = $(this).text();
                        break;
                case 2: detalle [2] = $(this).text();
                        break;
                case 3:
                		detalle [3] = $(this).text(); // fkequipo
                        break;
                case 4:
                		// aqui solo esta el nombre de equipo
                		detalle[4] = "";
                        break;
                case 5:
                		detalle [4] = $(this).text(); //hmto
                			break;
								case 6:
										detalle [5] = $(this).text(); // obs
											break;
            }

        })
        array[i] = detalle;
     	i = i + 1;

    })
    return array;
}
/**
 * Metodo que guarda todo el documento en el servidor
 */
function guardar(){
	//Obtenemos los datos de documento

	var detalles = getDetalleArray();
	var msg = validar(detalles);
	console.log("id ot org : " + document.getElementById("TFPkOrigen").value);
	console.log("id ot des : " + document.getElementById("TFPkDestino").value);

	if(msg.length <= 0){
		$("#principal").load(url, {
			controlador			: "TransfEquipo",
			accion				: "guardar",
			pkTransfEquipo	: document.getElementById("TFPkTransfEquipo").value,
			codigo 				: document.getElementById("TFCodigo").value,
			fkGestion			: document.getElementById("TFFkGestion").value,
			fecha				: document.getElementById("TFFecha").value,
			fkOrdenOrigen 		: document.getElementById("TFPkOrigen").value,
			fkOrdenDestino 		: document.getElementById("TFPkDestino").value,
			observacion 		: document.getElementById("TFObservacion").value,
			data 				: document.getElementById("TFCodigo").value,
			detalle 			: JSON.stringify(detalles)
		});
	}else{
		document.getElementById("idmsg").innerHTML = msg;
		$('#messsageModal').modal('show');
	}
}
function validar(detalles){
	msg = "";
	if(document.getElementById("TFPkOrigen").value <= 0){
		msg += "Ingrese codigo de Orden de Trabajo Origen </br>";
	}

	if(document.getElementById("TFPkDestino").value <= 0){
		msg += "Ingrese codigo de Orden de Trabajo destino </br>";
	}

	if((document.getElementById("TFCodigo").value).length <= 0){
		msg += "Ingrese codigo de documento </br>";
	}

	if((document.getElementById("TFFkGestion").value).length <= 0){
		msg += "No tiene Gestion Activa cierre el documento y active gestion </br>";
	}
	if(detalles.length <= 0 ){
		msg += "No Existe detalles , Ingrese por favor!! </br>";
	}

	return msg;
}
// list vist improductiva
function editar(pkTransfEquipo){
	// nesecito cargar mi vista de edicion!!

	if(pkTransfEquipo > 0){
		$("#principal").load(url, {
			controlador: "TransfEquipo",
			accion: "editar",
			pkTransfEquipo: pkTransfEquipo
		});
	}
}
function eliminar(pkTransfEquipo, data){

	if(confirm("Esta seguro de eliminar la Transferencia nro :[" + data + "]?")){
		if(pkTransfEquipo > 0){
			$("#principal").load(url, {
				controlador: "TransfEquipo",
				accion: "eliminar",
				pkTransfEquipo: pkTransfEquipo
			});
		}

	}

}

function nuevo(){

	$("#principal").load(url, {
		controlador: "TransfEquipo",
		accion: "nuevo"
	});

}

function nuevoDetalle(){
	// limpio los datos del detalle
		document.getElementById("DTpkDetTransfer").value 	= "0";
    document.getElementById("DTFItem").value 			= "";
    document.getElementById("DTfkEquipo").value 		= "0";
		document.getElementById("DTHmto").value 		= "0";
    document.getElementById("DTNombreEqui").innerHTML 	= "";
    document.getElementById("DTOnservacion").value 		= "";

}
function adicionarDetalle(){

	var msg = validarDetalle();
	if(msg.length <= 0){
	    var tabla = document.getElementById("detalle");

	    var fila = tabla.insertRow();

	    var celda1 = fila.insertCell(0); // pkdetalle
	    var celda2 = fila.insertCell(1); // fk transferencia
	    var celda3 = fila.insertCell(2); // item
	    var celda4 = fila.insertCell(3); // fkEquipo
	    //var celda5 = fila.insertCell(4); // codigo
	    var celda5 = fila.insertCell(4); // equipo
			var celda6 = fila.insertCell(5); // hmto
			var celda7 = fila.insertCell(6); // observacion
	    var celda8 = fila.insertCell(7); // editar
	    var celda9 = fila.insertCell(8); // eliminar

		// Link de Edicion
	    var linkEdit = document.createElement("a");
	        linkEdit.setAttribute("href","#");
	        linkEdit.onclick = editarDetalle(document.getElementById("DTpkDetTransfer").value);
		// creo mi span
		var spanEdit = document.createElement("span");
			spanEdit.innerHTML = ""
			spanEdit.setAttribute("class", "glyphicon glyphicon-edit");
			spanEdit.setAttribute("data-toggle", "tooltip");
			spanEdit.setAttribute("title", "Editar");

		//se lo adicionamos al link
			linkEdit.appendChild(spanEdit);
	    //------------------------------------------------------------------------------------------
	    // creo me link
	    var linkDele = document.createElement("a");
	        linkDele.setAttribute("href","#");
	        linkDele.onclick = eliminarDetalle(document.getElementById("DTpkDetTransfer").value);
		// creo mi span
		var spanDele = document.createElement("span");
			spanDele.innerHTML = ""
			spanDele.setAttribute("class", "glyphicon glyphicon-trash");
			spanDele.setAttribute("data-toggle", "tooltip");
			spanDele.setAttribute("title", "Eliminar");
	    // se lo adiciono al link
	    	linkDele.appendChild(spanDele);
	    //------------------------------------------------------------------------------------------
	    celda1.innerHTML = document.getElementById("DTpkDetTransfer").value;
	    celda2.innerHTML = document.getElementById("TFPkTransfEquipo").value;
	    celda3.innerHTML = document.getElementById("DTFItem").value;
	    celda4.innerHTML = document.getElementById("DTfkEquipo").value;
	    celda5.innerHTML = document.getElementById("DTNombreEqui").innerHTML;
			celda6.innerHTML = document.getElementById("DTHmto").value;
	    celda7.innerHTML = document.getElementById("DTOnservacion").value;
	    celda8.appendChild(linkEdit);
	    celda9.appendChild(linkDele);
	    console.log("nombre : " + document.getElementById("DTNombreEqui").innerHTML);
	}else{
		document.getElementById("idmsg").innerHTML = msg;
		$('#messsageModal').modal('show');
	}
}
function validarDetalle(){
	var msg = "";
	if(document.getElementById("DTFItem").value.length <=0)
		msg += "Ingrese Item de detalle </br>";

	if(document.getElementById("DTfkEquipo").value <= 0)
		msg += "Ingrese Equipo de trabajo </br>";

	return msg;
}
// cargamos los datos al formulario
function editarDetalle(pkDetalle){
	if(pkDetalle > 0){// es un antiguo y editando

	}else{ // es un nuevo editando

	}
}

function eliminarDetalle(pkDetalle){

}

function getOrdenTrabajo(valor){

	var ot = "";
	if(valor == 1)
		ot = document.getElementById("TFOrdenOrigen").value;
	else
		ot = document.getElementById("TFOrdenDestino").value;

	$.post(
				url,
				{
				  controlador: "TransfEquipo",
				  accion: "getOrdenTrabajo",
				  data : ot
				},
				function(datos){

					console.log("status : " + datos.status);

					if(valor == 1) {  // si uno >>> origen
						if(datos.status == "error"){
							document.getElementById("TFPkOrigen").value = 0;
							document.getElementById("TFOrdenOrigen").value = "";
							document.getElementById("TFNombreOrigen").innerHTML  = "INGRESE ORDEN DE TRABAJO!";
						}else{
							document.getElementById("TFPkOrigen").value = datos.pkordentrabajo;
							document.getElementById("TFOrdenOrigen").value = datos.data;
							document.getElementById("TFNombreOrigen").innerHTML  = datos.nombre;
						}

					}else{  // destino
						if(datos.status == "error"){
							document.getElementById("TFPkDestino").value = 0;
							document.getElementById("TFOrdenDestino").value = "";
							document.getElementById("TFNombreDestino").innerHTML  = "INGRESE ORDEN DE TRABAJO!";
						}else{
							document.getElementById("TFPkDestino").value = datos.pkordentrabajo;
							document.getElementById("TFOrdenDestino").value = datos.data;
							document.getElementById("TFNombreDestino").innerHTML  = datos.nombre;
						}
					}

				}, "json"
		  );
}

function getEquipo(){

	$.post(
				url,
				{
				  controlador: "TransfEquipo",
				  accion: "getEquipo",
				  data : document.getElementById("DTfkEquipo").value
				},
				function(datos){

					console.log("status : " + datos.status);

					if(datos.status == "error"){
						document.getElementById("DTfkEquipo").value = 0;
						document.getElementById("DTNombreEqui").innerHTML  = "EQUIPO NO ENCONTRADO!";
					}else{
						console.log("id equipo : " + datos.pkequipo);
						document.getElementById("DTfkEquipo").value = datos.pkequipo;
						document.getElementById("DTNombreEqui").innerHTML  = datos.descripcion;
					}
				}, "json"
		  );
}
