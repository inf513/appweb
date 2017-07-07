<?php 
require_once "Modelos/EstadoEquipoModel.php";
require_once "Modelos/EstadoModel.php";
require_once "Negocio/EstadoEquipo.php";

class EstadoEquipoController extends ControllerBase
{
	private $estado       = null;
	private $estadoEquipo = null;

	public function __construct(){
		parent::__construct();
		$this->estado = new EstadoEquipo();
		$this->estadoEquipo = new EstadoEquipoModel();
	}
	public function listar()
	{
		$listado = $this->estadoEquipo->listar("");	
		
		$this->mostrar($listado, null, 'EstadoEquipoListView.php');
	}
	public function editar(){

		$this->estadoEquipo->fkEquipo = $_POST['fkEquipo'];
		$estado = new EstadoModel();
		
		$estados = $estado->listar("");

		$modelo = $this->estadoEquipo->findOne("fkequipo", $this->estadoEquipo->fkEquipo);

		$this->mostrar($modelo, $estados,'EstadoEquipoView.php');
	}
	public function nuevo(){
		$listar = null;

		$this->mostrar($listar, 'EstadoEquipoView.php');
	}
	public function guardar()
	{
		$this->estadoEquipo->fkEquipo = $_POST['fkEquipo'];
		$this->estadoEquipo->motivo = $_POST['motivo'];
		$this->estadoEquipo->personal = $_POST['personal'];
		
		$this->estadoEquipo->fecha = $_POST['fecha'];
		$this->estadoEquipo->fecha = FuncionesComunes::formatearFormatoYYYYMMDD($this->estadoEquipo->fecha);
		
		$this->estadoEquipo->estado = $_POST['estado'];
		
		/*ya que siempre seran actualizaciones*/
		$this->estadoEquipo->pk = 1;

		$this->estadoEquipo->guardarModel();
		$this->listar();
	}
	/*funcion que valida el estado del equipo*/
	public function validarEstado(){
		$fkEquipo = $_POST['fkequipo'];
		$stad = $_POST["estado"]; # estado que se esta queriendo guardar
		#$resultado = array('data' =>" ".$fkequipo . " - " . $stad);
		# primero obtenemos el estado que estaba en la base de datos
		$estadoEQ = $this->estadoEquipo->findOne("fkEquipo", $fkEquipo);
		switch ($estadoEQ->estado) {
			case 'NUEVO':
				$this->estado->setEstado(new StateNuevo($this->estado));
				break;			
			case 'REPARACION':
				$this->estado->setEstado(new StateReparacion($this->estado));
				break;
			case 'FUNCIONAMIENTO':
				$this->estado->setEstado(new StateFuncionamiento($this->estado));
				break;
			case 'VENTA':
				$this->estado->setEstado(new StateVenta($this->estado));
				break;
			default:
				$this->estado->setEstado(new StateNuevo($this->estado));
				break;
		}
		
		
		# ahora nos preguntamos si podemos cambiar
		$resultado = $stad;

		switch ($stad) {
			case 'NUEVO':
				$resultado = $this->estado->equipoNuevo();
				break;
			case 'REPARACION':			
				$resultado = $this->estado->equipoEnReparacion();
				break;
			case 'FUNCIONAMIENTO':
				$resultado = $this->estado->equipoEnFuncionamiento();
				break;
			case 'VENTA':
				$resultado = $this->estado->equipoEnVenta();
				break;
			default:
				$resultado = "No se encontro datos";
				break;
		}

		$response["data"] = $resultado;
		echo json_encode($response);
	}

	# metodos privados
	private function mostrar($listado, $estados, $vista){
		# aqui ingresamos todos los datos que queremos enviar
		$data['listado'] = $listado;
		$data['estados'] = $estados;
		$this->show($vista, $data);
	}
}
?>