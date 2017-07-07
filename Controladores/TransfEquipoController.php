<?php
require_once "Modelos/OrdenTrabajoModel.php";
require_once "Modelos/EquipoModel.php";
require_once "Modelos/GestionModel.php";
require_once "Modelos/TransfEquipoModel.php";
require_once "Modelos/DetTransfEquipoModel.php";

class TransfEquipoController extends ControllerBase
{

	private $equipo = null;
	private $ot = null;
	private $transferencia = null;
	private $detTransferencia = null;
	private $gestion = null;

	public function __construct(){
		parent::__construct();

		$this->equipo = new EquipoModel();
		$this->ot = new OrdenTrabajoModel();
		$this->transferencia = new TransfEquipoModel();
		$this->detTransferencia= new DetTransfEquipoModel();
		$this->gestion = new GestionModel();

		// obtenemos la session actual
		$g = $this->gestion->findOne("estado", "T");
		$_SESSION['pkgestion'] = $g->pkgestion;
	}
	public function listar()
	{
		$listado = $this->transferencia->listar(" t.estado = 'T' ");

		$this->mostrar($listado, null ,'TransfEquipoListView.php');
	}
	public function editar(){
		$this->transferencia->pkTransfEquipo = $_POST['pkTransfEquipo'];

		# obtengo solo el encabezado
		$listado = $this->transferencia->findOne("pkTransfEquipo", $this->transferencia->pkTransfEquipo);

		#obtengo el detalle
		$detalles = $this->detTransferencia->listar(
				"fkTransfEquipo = " . $this->transferencia->pkTransfEquipo);

		$this->mostrar($listado, $detalles, 'TransfEquipoView.php');
	}
	public function nuevo(){
		$listar = null;

		$this->obtenerGestionActiva();

		$this->mostrar($listar, null, 'TransfEquipoView.php');
	}

	public function guardar()
	{
		$editando = true;

		if(empty($_POST['pkTransfEquipo'])){
			$editando = false;
		}else{
			$editando = true;
		}

		# encabezado
		$this->transferencia->pkTransfEquipo = $this->guardarEncabezado();

		if($this->transferencia->pkTransfEquipo > 0){
			$this->guardarDetalle($this->transferencia->pkTransfEquipo, $editando);
		}
		$this->listar();
	}
	/**
	 * Metodo que devuelve la ultima llave generada. si se guardo correctamente
	 * @return Devuelve menor a CERO si no guardo correctamente
	 */
	private function guardarEncabezado(){
			try {

				$this->setDatosTransferencia($_POST);

				$this->transferencia->guardarModel();

				return $this->transferencia->lastPrimaryKey();
			} catch (Exception $e) {
				echo "[TransfEquipoController.guardarEncabezado]" . $e->getMessage();
				return -1;
			}
	}
	private function setDatosTransferencia($data){
		$this->transferencia->pkTransfEquipo 	= $data['pkTransfEquipo'];
		$this->transferencia->codigo 			= $data['codigo'];

		//$this->transferencia->fkGestion 		= $_POST['fkGestion'];
		$this->transferencia->fkGestion 		= 1;

		$this->transferencia->fecha 			= $data['fecha'];
		$this->transferencia->fkOrdenOrigen		= $data['fkOrdenOrigen'];
		$this->transferencia->fkOrdenDestino 	= $data['fkOrdenDestino'];
		$this->transferencia->observacion 		= $data['observacion'];

		$lista = $this->gestion->findOne(
										"pkGestion", 
										$this->transferencia->fkGestion);

		$this->transferencia->data 				= $this->transferencia->codigo . '-' . $lista->codigo;
		$this->transferencia->estado			= "T";
	}
	private function obtenerGestionActiva(){
		$lista = $this->gestion->findOne("estado", "T");
		$_SESSION['pkgestion'] = $lista->pkgestion;
		$_SESSION['codgest'] = $lista->codigo;
	}

	private function guardarDetalle($pkTransf, $editando){
		$detalles = json_decode($_POST['detalle']);

		//echo "llave encabezado : " . $pkTransf;
		//echo "editando : " . $editando;

		foreach ($detalles as $detalle){
		 if(strlen ($detalle[2]) > 0 ){
			 $this->detTransferencia->pkDetTransfEquipo 	= $detalle[0];

			 if($editando){ # se esta editando un documento
				 //echo "entre a true";
				 $this->detTransferencia->fkTransfEquipo 	= $detalle[1];
			 }else{# Es un nuevo documento
				 //echo "entre a false";
				 $this->detTransferencia->fkTransfEquipo 	= $pkTransf;
			 }
			 $this->detTransferencia->item 					= $detalle[2];#->item;
			 $this->detTransferencia->fkEquipo 			= $detalle[3];#->fkEquipo;
			 $this->detTransferencia->hmto 					= $detalle[4];#->observacion;
			 $this->detTransferencia->observacion 	= $detalle[5];#->observacion;
			 $this->detTransferencia->guardarModel();

		 }
		}
	}
	public function eliminar()
	{
		$this->transferencia->pkTransfEquipo = $_POST['pkTransfEquipo'];
		
		$t = $this->transferencia->findOne(
											"pkTransfEquipo", 
											$this->transferencia->pkTransfEquipo);

		if(!is_null($t)){
			# si no es nulo, entonces eliminacion logica
			$this->setDatosTransferencia($t);
			$this->estado = "F";
			$this->transferencia->guardarModel();
		}

		$this->listar();
	}
	public function getOrdenTrabajo(){
		$data = $_POST['data'];
		$listado = $this->ot->findOne("data", $data);

		if(count($listado) > 0){
			$listado->status = "success";
			echo json_encode($listado);
		}else{
			$listado = array();
			$listado['status'] = "error";
			echo json_encode($listado);
		}
	}

	public function getEquipo(){
		$data = $_POST['data'];
		$listado = $this->equipo->findOne("e.codigo", $data);

		if(count($listado) > 0){
			$listado->status = "success";
			echo json_encode($listado);
		}else{
			$listado = array();
			$listado['status'] = "error";
			echo json_encode($listado);
		}
	}

	# metodos privados
	private function mostrar($listado, $detalles, $vista){
		# aqui ingresamos todos los datos que queremos enviar
		$data['listado'] = $listado;	
		$data['detalles'] = $detalles;

		$this->show($vista, $data);
	}
}
?>
