<?php
require_once "Modelos/PoligonoModel.php";
require_once "Modelos/OrdenTrabajoModel.php";

class PoligonoController extends ControllerBase
{
	private $poligono = null;

	public function __construct(){
		parent::__construct();
		$this->poligono = new PoligonoModel();
	}
	public function listar()
	{
		$listado = $this->poligono->listar("");
		$this->mostrar($listado, 'PoligonoListView.twig');
	}
	public function editar(){

		$this->poligono->pkPoligono = $_POST['pkPoligono'];

		$pol = $this->poligono->findOne("pkPoligono", $this->poligono->pkPoligono);
		
		print_r($pol);

		$this->mostrar($pol, 'PoligonoView.twig');
	}
	public function nuevo(){
		$listar = null;

		$this->mostrar($listar, 'PoligonoView.twig');
	}
	public function guardar()
	{
		
		$this->poligono->pkPoligono = $_POST['pkPoligono'];
		$this->poligono->fkOrdenTrabajo = $_POST['fkOrdenTrabajo'];
		$this->poligono->codigo = $_POST['codigo'];
		$this->poligono->descripcion = $_POST['descripcion'];

		$this->poligono->guardarModel();
		$this->listar();
	}
	public function eliminar()
	{
		$this->poligono->pkPoligono = $_POST['pkPoligono'];
		$this->poligono->delModel();

		$this->listar();
	}

	# metodos privados
	private function mostrar($listado, $vista){
		# aqui ingresamos todos los datos que queremos enviar
		$data['listado'] = $listado;
		$this->show($vista, $data);
	}

	public function getOrdenTrabajo(){
		$data = $_POST['data'];
		$orden = new OrdenTrabajoModel();
		$ot = $orden->findOne("data", $data);
		
		if(count($ot) > 0){
			$listado = array();
			$listad["status"] = "success";
			$listado["data"] = $ot->data;
			$listado["nombre"] = $ot->nombre;
			$listado["pkordentrabajo"] = $ot->pkordentrabajo;
			
			echo json_encode($listado);
		}else{
			$listado = array();
			$listado["status"] = "error";
			$listado["data"] = null;
			$listado["nombre"] = null;
			$listado["pkordentrabajo"] = 0;
			echo json_encode($listado);	
		}
	}
	
}
?>