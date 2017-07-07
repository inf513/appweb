<?php
require_once "Modelos/OrdenTrabajoModel.php";
require_once "Modelos/EquipoModel.php";

require_once "Modelos/CodigoModel.php";
require_once "Modelos/EstadoEquipoModel.php";
class EquipoController extends ControllerBase
{
	private $ot = null;
	private $codigo = null;
	private $equipo = null;

	public function __construct(){
		parent::__construct();

		$this->codigo = new CodigoModel();
		$this->ot = new OrdenTrabajoModel(); 
		$this->equipo = new EquipoModel();
	}
	public function listar()
	{
		$listado = $this->equipo->listar("");
		$this->mostrar($listado, null, 'EquipoListView.php');
	}
	public function editar(){
		$this->equipo->pkEquipo = $_POST['pkEquipo'];

		$eq = $this->equipo->findOne("pkEquipo", $this->equipo->pkEquipo);

		#Ademas enviamos la lista de codigos
		$codigos = $this->codigo->listar("");

		$this->mostrar($eq, $codigos, 'EquipoView.php');
	}
	public function nuevo(){
		$listar = null;

		#Solo enviamos los codigos
		$codigos = $this->codigo->listar("");

		$this->mostrar($listar, $codigos, 'EquipoView.php');
	}

	public function guardar()
	{
		$this->equipo->pkEquipo 		= $_POST['pkEquipo'];
		$this->equipo->fkCodigo 		= $_POST['fkCodigo'];
		$this->equipo->codigo 			= $_POST['codigo'];
		$this->equipo->fkTipoContrato	= $_POST['fkTipoContrato'];		
		$this->equipo->fechaIngreso 	= $_POST['fechaIngreso'];
		$this->equipo->fkOrdenTrabajo 	= $_POST['fkOrdenTrabajo'];
		$this->equipo->descripcion 		= $_POST['descripcion'];
		
		$this->equipo->fechaIngreso = FuncionesComunes::formatearFormatoYYYYMMDD($this->equipo->fechaIngreso);

		/**
		 * cada que un equipo se guarda se crea un estado de de equipo por defecto
		 */
		$this->guardarEstado($this->equipo->pkEquipo, $this->equipo->fechaIngreso);

		$this->equipo->guardarModel();

		$this->listar();
	}
	private function guardarEstado($pkEquipo, $fecha){
		$modelo = new EstadoEquipoModel();
		$modelo->fkEquipo = $pkEquipo;
		$modelo->motivo   = "NUEVA ADQUISICION";
		$modelo->estado   = "NUEVO";
		$modelo->fecha    = $fecha;
		# VERIFICAR ESTO
		
		$modelo->personal = "limbert";		

		$verificar  = $modelo->findOne("fkequipo",$pkEquipo);
		if(is_null($verificar)){
			$modelo->pk = 0;
		}else{
			$modelo->pk = 1;
		}

		$modelo->guardarModel();

	}
	public function eliminar()
	{
		$this->equipo->pkEquipo = $_POST['pkEquipo'];
		$this->equipo->delModel();

		$this->listar();
	}
	public function getOrdenTrabajo(){
		$this->ot->data = $_POST['data'];
		$orden = $this->ot->findOne("data", $this->ot->data);

		if(count($orden) > 0){
			$orden->status = "success";

			echo json_encode($orden);
		}else{
			$orden = array();
			$orden['status'] = "error";
			
			echo json_encode($orden);
		}
	}
	# metodos privados
	private function mostrar($listado, $codigos, $vista){
		# aqui ingresamos todos los datos que queremos enviar
		$data['listado'] = $listado;
		$data['codigos'] = $codigos;
		$this->show($vista, $data);
	}
}
?>