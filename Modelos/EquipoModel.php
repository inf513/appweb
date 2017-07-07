<?php
require_once "Negocio/FuncionesComunes.php";

class EquipoModel extends ModelBase{

	public $pkEquipo;
	public $fkTipoEquipo;
	public $fkModelo;
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
		$fkTipoEquipo = 0;
		$fkModelo = 0;
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
		$parametros[":fktipoequipo"] = $this->fkTipoEquipo;
		$parametros[":fkmodelo"] = $this->fkModelo;
		$parametros[":codigo"] = $this->codigo;
		$parametros[":fktipocontrato"] = $this->fkTipoContrato;
		$parametros[":fechaingreso"] = $this->fechaIngreso;
		$parametros[":fkordentrabajo"] = $this->fkOrdenTrabajo;
		$parametros[":descripcion"] = $this->descripcion;

		return $parametros;
	}
	protected function getSqlListar(){
		$consulta = " SELECT ";
		$consulta .= " e.pkEquipo, e.fkTipoEquipo, e.fkModelo, e.codigo,  ";
		$consulta .= " e.fkTipoContrato, e.fechaIngreso, e.fkOrdenTrabajo, ";
		$consulta .= " e.descripcion, o.data, o.nombre ";
		$consulta .= " FROM spequipo e ";
		$consulta .= " 	INNER JOIN speqtipo t ON e.fkTipoEquipo = t.pkEqTipo ";
		$consulta .= " 	INNER JOIN speqmodelo m ON e.fkModelo = m.pkEqModelo ";
		$consulta .= " 	INNER JOIN spordentrabajo o ON e.fkOrdenTrabajo = o.pkOrdenTrabajo ";

		return $consulta;		
	}
 	protected function modificarDatos($filas){
		foreach ($filas as $value) {
			$value->fechaingreso = FuncionesComunes::formatearFormatoDDMMYYYY($value->fechaingreso);
		}
		return $filas;
	}
	protected function getIdTabla(){
		return $this->pkEquipo;
	}
}
?>