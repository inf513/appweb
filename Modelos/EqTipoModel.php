<?php

class EqTipoModel extends ModelBase{

	public $pkEqTipo;
	public $codigo;
	public $descripcion;

	public function __construct(){
		parent::__construct();
		$this->tabla = 'speqtipo';
		$pkEqTipo = 0;
		$codigo = '';
		$descripcion = '';
	}

	protected function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkEqTipo"] = $this->pkEqTipo;
			return $parametros;
	}
	protected function getParametros(){
		
		$parametros = array();			
		$parametros[":descripcion"] = $this->descripcion;
		$parametros[":codigo"] = $this->codigo;
			
		return $parametros;
	}
	protected function getIdTabla(){
		return $this->pkEqTipo;
	}
	protected function getSqlListar(){
		return "SELECT pkEqTipo, codigo, descripcion FROM " . $this->tabla;
	}
	protected function modificarDatos($filas){
		return $filas;
	}
}
?>