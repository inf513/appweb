<?php
require_once "Negocio/FuncionesComunes.php";

class EquipoModel extends ModelBase{

	public $pkEquipo;
	public $fkCodigo;
	public $codigo;
	public $fkTipoContrato;
	public $fechaIngreso;
	public $fkOrdenTrabajo;
	public $descripcion;


	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'spequipo';
		$pkEquipo = 0;
		$fkCodigo = 0;
		$codigo = '';
		$fkTipoContrato = 0;
		$fechaIngreso = '1990-01-01';
		$fkOrdenTrabajo = 0;
		$descripcion = '';
	}
	protected function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkequipo"] = $this->pkEquipo;
			return $parametros;
	}
	protected function getParametros(){
		$parametros = array();			
		$parametros[":fkcodigo"] = $this->fkCodigo;
		$parametros[":codigo"] = $this->codigo;
		$parametros[":fktipocontrato"] = $this->fkTipoContrato;
		$parametros[":fechaingreso"] = $this->fechaIngreso;
		$parametros[":fkordentrabajo"] = $this->fkOrdenTrabajo;
		$parametros[":descripcion"] = $this->descripcion;

		return $parametros;
	}
	protected function getSqlListar(){
		$consulta = " SELECT ";
		$consulta .= " e.pkEquipo, e.fkcodigo, c.codigo, ";
		$consulta .= " e.fkTipoContrato, e.fechaIngreso, e.fkOrdenTrabajo, ";
		$consulta .= " e.descripcion, o.data, o.nombre ";
		$consulta .= " FROM spequipo e ";
		$consulta .= " 	INNER JOIN spcodigo c ON c.pkcodigo = e.fkcodigo ";
		$consulta .= " 	INNER JOIN spordentrabajo o ON e.fkOrdenTrabajo = o.pkOrdenTrabajo ";

		return $consulta;
	}
	protected function getIdTabla(){
		return $this->pkEquipo;
	}
	protected function modificarDatos($filas){
		foreach ($filas as $value) {
			$value->fechaingreso = FuncionesComunes::formatearFormatoDDMMYYYY($value->fechaingreso);
		}
		return $filas;
	}
}
?>