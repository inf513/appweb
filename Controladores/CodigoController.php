<?php

require_once "Modelos/CodigoModel.php";
include_once("./Negocio/CodigoComposite.php");
include_once("./Negocio/CodigoHoja.php");
class CodigoController extends ControllerBase
{
	private $codigo = null;

	public function __construct(){
		parent::__construct();
		$this->codigo = new CodigoModel();
	}
	public function listar()
	{
		$listado = $this->codigo->listar("");
		$this->mostrar($listado, 'CodigoListView.php');
	}
	public function editar(){

		$this->codigo->pkCodigo = $_POST['pkCodigo'];

		$cod = $this->codigo->findOne("pkCodigo", $this->codigo->pkCodigo);
		$composite = $this->recuperarComposite($cod);		
		$this->mostrar($composite, 'CodigoView.php');
	}
	public function nuevo(){
		$listar = null;

		$this->mostrar($listar, 'CodigoView.php');
	}
	public function guardar()
	{

		$this->codigo->pkCodigo = $_POST['pkCodigo'];
		$this->codigo->codigo = $_POST['codigo'];
		$this->codigo->descripcion = $_POST['descripcion'];
		$this->codigo->fkCodigoPadre = -1;

		$listaHijos = json_decode($_POST['compuesto']);
		
		
		$this->generarComposite($this->codigo, $listaHijos);
				
		$this->listar();

	}
	/**
	 * Metodo que genera un compuesto
	 * @param  [array] $codigo [array con los datos de codigo]
	 */
	private function recuperarComposite($codArray){
		
		$this->codigo->pkCodigo = $codArray->pkcodigo;
		$this->codigo->descripcion = $codArray->descripcion;
		$this->codigo->fkCodigoPadre = $codArray->fkcodigopadre;

		$list = explode("-", $codArray->codigo);
		
		//$listaHojas = array();

		$count = count($list);
				
		$composite = new CodigoComposite($this->codigo);
		foreach ($list as $value) {
			if($count != 1){
				# son las hojas
				$cd = $this->codigo->findOne("codigo", $value);
				//$listaHojas[] = $cd;
				$hoja = new CodigoHoja($cd->codigo, $cd->pkcodigo);
				$composite->adicionar($hoja);
			}else{ # es el codigo del composite

				$this->codigo->codigo = $value;
			}			
			$count = $count - 1;
		}		
		
		return $composite;
	}
	private function generarComposite($codigoComp, $hojas){
		$composite = new CodigoComposite($codigoComp);
		$codigoH = null;

		foreach ($hojas as $hoja) {			
			$codHoja = new CodigoHoja($hoja->codigo, $hoja->pkcodigo);
			$composite->adicionar($codHoja);
		}

		/* Es el verdadero codigo full */
		$codigoComp->codigo = $composite->getCodigo();
		$codigoComp->guardarModel();
	}
	public function eliminar()
	{
		$this->codigo->pkCodigo = $_POST['pkCodigo'];
		$this->codigo->delModel();

		$this->listar();
	}

	# metodos privados
	private function mostrar($listado, $vista){
		# aqui ingresamos todos los datos que queremos enviar
		$data['listado'] = $listado;
				
		$this->show($vista, $data);
	}
	public function getCodigo(){
		$data = $_POST['data'];
		$listado = $this->codigo->findOne("codigo", $data);
		
		if(count($listado) > 0){
			$listado->status = "success";
			echo json_encode($listado);
		}else{
			$listado = array();
			$listado["status"] = "error";
			echo json_encode($listado);
		}
	}
}

?>