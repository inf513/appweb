<?php
require_once "Negocio/FuncionesComunes.php";
class EstadoEquipoModel extends ModelBase{

	public $pk; # no se guarda
	public $fkEquipo;
	public $motivo;
	public $estado; //NUEVO, VENTA, FUNCIONAMIENTO....
	public $fecha;
	public $personal;
	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'spestadoequipo';
		$fkEquipo = 0;
		$motivo = '';
		$estado = 'NUEVO';
		$fecha = '1990-01-01';
		$fkPersonal = 0;
	}

	protected function getParametrosWhere(){
			$parametros = array();
			$parametros[":fkequipo"] = $this->fkEquipo;
			return $parametros;
	}
	protected function getParametros(){
		
		$parametros = array();			
		
		$parametros[":fkequipo"] = $this->fkEquipo;
		$parametros[":motivo"] = $this->motivo;
		$parametros[":estado"] = $this->estado;
		$parametros[":fecha"] = $this->fecha;
		$parametros[":personal"] = $this->personal;
		
		return $parametros;
	}
	protected function getIdTabla(){
		return $this->pk;
	}
	protected function getSqlListar(){
		$consulta = "SELECT s.fkequipo, s.motivo, s.estado, s.fecha, s.personal, e.codigo ";
		$consulta .= " FROM spestadoequipo s inner join spequipo e on s.fkequipo = e.pkequipo ";

		return $consulta;
	}
	protected function modificarDatos($filas){
		foreach ($filas as $value) {
			$value->fecha = FuncionesComunes::formatearFormatoDDMMYYYY($value->fecha);
		}
		return $filas;
	}
}
?>