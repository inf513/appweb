<?php
require_once "Modelos/ActividadModel.php";
require_once "Negocio/FuncionesComunes.php";

class ActividadController extends ControllerBase{
   private $actividad=null;

   public function __construct(){
		parent::__construct();
		$this->actividad = new ActividadModel();
	}
    
	public function listar()
	{
		$listado = $this->actividad->listar("");
		FuncionesComunes::contadorPagina(1);
      //  print_r($listado);
		$this->mostrar($listado, 'ActividadListView.twig');
	}
    public function editar(){

		$this->actividad->pkActividad = $_POST['pkActividad'];

		$imp = $this->actividad->findOne("pkActividad", $this->actividad->pkActividad);
		$this->mostrar($imp, 'ActividadView.twig');
	}
    public function nuevo(){
		$listar = null;

		$this->mostrar($listar, 'ActividadView.twig');
	}
    public function guardar()
	{
		$this->actividad->pkActividad = $_POST['pkActividad'];
		$this->actividad->codigo = $_POST['codigo'];
		$this->actividad->descripcion = $_POST['descripcion'];
       
       echo('id '.$this->actividad->pkActividad);
		$this->actividad->guardarModel();
		$this->listar();
	}
    public function eliminar()
	{
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