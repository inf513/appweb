<?php
require_once "Modelos/OrdenTrabajoModel.php";
require_once "Modelos/PersonalModel.php";
require_once "Modelos/GestionModel.php";
require_once "Modelos/TransfPersonalModel.php";
require_once "Modelos/DetTransfPersonalModel.php";

class TransfPersonalController extends ControllerBase
{
	private $personal = null;
	private $ot = null;
	private $transferencia = null;
	private $detTransferencia = null;
	private $gestion = null;

	public function __construct(){
		parent::__construct();

		$this->personal = new PersonalModel();
		$this->ot = new OrdenTrabajoModel();
		$this->transferencia = new TransfPersonalModel();
		$this->detTransferencia= new DetTransfPersonalModel();
		$this->gestion = new GestionModel();
		// obtenemos la session actual
		$g = $this->gestion->findOne("estado", "T");
		$_SESSION['pkgestion'] = $g->pkgestion;
	}
	public function listar()
	{
		$listado = $this->transferencia->listar(" t.estado = 'T' ");

		$this->mostrar($listado, null ,'TransfPersonalListView.php');
	}
	public function editar(){
		$this->transferencia->pkTransfPersonal = $_POST['pkTransfPersonal'];

		# obtengo solo el encabezado
		$listado = $this->transferencia->findOne("pkTransfPersonal", 
								$this->transferencia->pkTransfPersonal);

		#obtengo el detalles
		$detalles = $this->detTransferencia->listar("fkTransfPersonal = " . $this->transferencia->pkTransfPersonal);

		$this->mostrar($listado, $detalles, 'TransfPersonalView.php');
	}
	public function nuevo(){
		$listar = null;

		$this->obtenerGestionActiva();

		$this->mostrar($listar, null, 'TransfPersonalView.php');
	}

	public function guardar()
	{
		$editando = true;

		if(empty($_POST['pkTransfPersonal'])){
			$editando = false;
		}else{
			$editando = true;
		}

		# encabezado
		$this->transferencia->pkTransfPersonal = $this->guardarEncabezado();

		if($this->transferencia->pkTransfPersonal > 0){
			$this->guardarDetalle($this->transferencia->pkTransfPersonal, $editando);
		}

		$this->listar();
	}
	private function setDatosForm($data){
		$this->transferencia->pkTransfPersonal 	= $data['pkTransfPersonal'];
		$this->transferencia->codigo 			= $data['codigo'];

		// por ahora mantendremos
		//$this->transferencia->fkGestion 		= $_POST['fkGestion'];
		$this->transferencia->fkGestion 		= 1;

		$this->transferencia->fecha 			= $data['fecha'];
		$this->transferencia->fkOrdenOrigen		= $data['fkOrdenOrigen'];
		$this->transferencia->fkOrdenDestino 	= $data['fkOrdenDestino'];
		$this->transferencia->observacion 		= $data['observacion'];

		$lista = $this->gestion->findOne("pkGestion", $this->transferencia->fkGestion);

		$this->transferencia->data 				= $this->transferencia->codigo . '-' . $lista->codigo;
		$this->transferencia->estado			= "T";
	}
	/**
	 * Metodo que devuelve la ultima llave generada. si se guardo correctamente
	 * @return Devuelve menor a CERO si no guardo correctamente
	 */
	private function guardarEncabezado(){
		try {

			$this->setDatosForm($_POST);
			$this->transferencia->guardarModel();

			return $this->transferencia->lastPrimaryKey();
		} catch (Exception $e) {
			echo "[TransfPersonalController.guardarEncabezado]" . $e->getMessage();
			return -1;
		}
	}
	private function obtenerGestionActiva(){
		$lista = $this->gestion->findOne("estado", "T");

		$_SESSION['pkgestion'] = $lista->pkgestion;
		$_SESSION['codgest'] = $lista->codigo;
	}

	private function guardarDetalle($pkTransf, $editando){
		 $detalles = json_decode($_POST['detalle']);

		 //print_r($detalles);

		 //echo "llave encabezado : " . $pkTransf;
		 //echo "editando : " . $editando;

		 foreach ($detalles as $detalle){
		 	if(strlen ($detalle[2]) > 0 ){
		 		$this->detTransferencia->pkDetTransfPersonal 	= $detalle[0];

		 		if($editando){ # se esta editando un documento
		 			//echo "entre a true";
		 			$this->detTransferencia->fkTransfPersonal 	= $detalle[1];
		 		}else{# Es un nuevo documento
		 			//echo "entre a false";
		 			$this->detTransferencia->fkTransfPersonal 	= $pkTransf;
		 		}
			 	$this->detTransferencia->item 					= $detalle[2];#->item;
			 	$this->detTransferencia->fkPersonal 			= $detalle[3];#->fkPersonal;
			 	$this->detTransferencia->observacion 			= $detalle[4];#->observacion;
			 	$this->detTransferencia->guardarModel();
		 	}
		}
	}
	public function eliminar()
	{
		$this->transferencia->pkTransfPersonal = $_POST['pkTransfPersonal'];
		$t = $this->transferencia->findOne(	"pkTransfPersonal", 
											$this->transferencia->pkTransfPersonal);
		if(!is_null($t)){
			$this->transferencia->estado = "F";
			$this->transferencia->guardarModel();
		}

		$this->listar();
	}
	/**
	 * Metodo que obtiene el codigo y nombre de la orden de trabajo
	 */
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
	/**
	 * Metodo que encuentra una persona.
	 */
	public function getPersonal(){
		$data = $_POST['data'];
		$listado = $this->personal->findOne("pkPersonal", $data);

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
