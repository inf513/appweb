<?php
require_once "Modelos/GestionModel.php";
require_once "Modelos/EstadisticaModel.php";
class FuncionesComunes{
	# funcion que devuelve el codigo de gestion a partir de la llave primaria
	public static function getGestionCodigo($pkGestion){
		try {
			$ges = new GestionModel();

			$listado = $ges->listar(" pkGestion = " . $pkGestion);
			$listados = $listado->fetchAll();
			if(count($listados)>0)
				return $listados[0]['codigo'];
			else
				return 0;
		} catch (PDOException $e) {
			return 0;
			echo "Error en [getGestionCodigo]" .$e->getMessage();
		}
	}

	public static function formatearFormatoYYYYMMDD($fecha){
		$date = new DateTime($fecha);
		return $date->format('Y-m-d');
	}
	public static function formatearFormatoDDMMYYYY($fecha){
		$date = new DateTime($fecha);

		$data =  $date->format('d-m-Y');
		
		return $data;
	}	

	public static function contadorPagina($i){
		
		$estadistica = new Estadisticamodel();
		$c = $estadistica ->findOne('id',$i);
		//$i=id;
			
		$estadistica->visitas=$c->visitas+1;
		$estadistica->id=$i;
		$estadistica->paginas = $c->paginas;
		$estadistica->guardarModel(); 
	}
}
?>