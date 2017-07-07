<?php
require_once "Negocio/FuncionesComunes.php";

class GestionModel extends ModelBase{

	public $pkGestion;
	public $codigo;
	public $fechaIni;
	public $fechaFin;
	public $estado;

	public function __construct(){
		parent::__construct();
		$this->tabla = 'spgestion';
		$this->secuencia = 'spgestion_pkgestion_seq';
		$pkGestion = 0;
		$codigo = '';
		$fechaIni = '1990-01-01';
		$fechaFin = '1990-01-01';
		$estado = 'F';
	}
	protected function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkgestion"] = $this->pkGestion;
			return $parametros;
	}
	protected function getParametros(){
		
		$parametros = array();
		$parametros[":codigo"] = $this->codigo;
		$parametros[":fechaini"] = $this->fechaIni;
		$parametros[":fechafin"] = $this->fechaFin;
		$parametros[":estado"] = $this->estado;
		return $parametros;
	}

	protected function getSqlListar(){
		return "SELECT pkgestion, codigo, fechaini, fechafin, estado FROM " . $this->tabla;
	}					   
	protected function getIdTabla(){		       
		return $this->pkGestion;
	}
	protected function modificarDatos($filas){
		foreach ($filas as $value) {
			$value->fechaini = FuncionesComunes::formatearFormatoDDMMYYYY($value->fechaini);
			$value->fechafin = FuncionesComunes::formatearFormatoDDMMYYYY($value->fechafin);
		}
		return $filas;
	}
}
?>