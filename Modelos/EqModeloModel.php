<?php

class EqModeloModel extends ModelBase{

	public $pkEqModelo;
	public $fkEqTipo;
	public $codigo;
	public $descripcion;

	public function __construct(){
		parent::__construct();
		$this->tabla = 'speqmodelo';
		$pkEqModelo = 0;
		$fkEqTipo = 0;
		$codigo = '';
		$descripcion = '';
	}
	protected function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkEqModelo"] = $this->pkEqModelo;
			return $parametros;
	}
	protected function getParametros(){
		
		$parametros = array();
		$parametros[":fkEqTipo"] = $this->fkEqTipo;
		$parametros[":descripcion"] = $this->descripcion;
		$parametros[":codigo"] = $this->codigo;
			
		return $parametros;
	}
	protected function getSqlListar(){
		$consulta = "SELECT pkEqModelo, fkEqTipo, codigo, descripcion FROM " . $this->tabla;
		return $consulta;
	}
	protected function getIdTabla(){
		return $this->pkEqModelo;
	}
	protected function modificarDatos($filas){
		return $filas;
	}
}
?>