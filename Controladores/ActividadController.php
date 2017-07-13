<?php
require_once "Modelos/ActividadModel.php";
require_once "Negocio/FuncionesComunes.php";

class ActividadController extends ControllerBase{
   	private $actividad=null;
	private $contarSw = true;
   public function __construct(){
		parent::__construct();
		$this->actividad = new ActividadModel();
		$this->contarSw = true;
	}
    
	public function listar()
	{
		$listado = $this->actividad->listar("");
		if($this->contarSw){
			FuncionesComunes::contadorPagina(1);
		}
		$this->mostrar($listado, 'ActividadListView.twig');
	}
    public function editar(){
		$this->contarSw = false;
		$this->actividad->pkActividad = $_POST['pkActividad'];

		$imp = $this->actividad->findOne("pkActividad", $this->actividad->pkActividad);
		$this->mostrar($imp, 'ActividadView.twig');
	}
    public function nuevo(){
		$listar = null;
		$this->contarSw = false;
		$this->mostrar($listar, 'ActividadView.twig');
	}
    public function guardar()
	{
		$this->contarSw = false;
		$this->actividad->pkActividad = $_POST['pkActividad'];
		$this->actividad->codigo = $_POST['codigo'];
		$this->actividad->descripcion = $_POST['descripcion'];
       
		$this->actividad->guardarModel();
		$this->listar();
	}
    public function eliminar()
	{
		$this->contarSw = false;
		$this->actividad->pkActividad = $_POST['pkActividad'];
		$this->actividad->delModel();

		$this->listar();
	}
    	# metodos privados
	private function mostrar($listado, $vista){
		# aqui ingresamos todos los datos que queremos enviar
		$data['listado'] = $listado;
		$this->show($vista, $data);
	}
}
?>