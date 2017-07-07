<?php

class ActividadModel extends ModelBase{

	public $pkActividad;
	public $codigo;
	public $descripcion;

	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'spactividad';
		$pkActividad = 0;
		$codigo = '';
		$descripcion = '';
	}
	
	protected function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkActividad"] = $this->pkActividad;
			return $parametros;
	}
	protected function getParametros(){
		
		$parametros = array();
		$parametros[":codigo"] = $this->codigo;
		$parametros[":descripcion"] = $this->descripcion;

		return $parametros;
	}

	protected function getIdTabla(){
		return $this->pkActividad;
	}

	protected function getSqlListar()
	{
		return "SELECT pkActividad, codigo, descripcion FROM " . $this->tabla;
	}
	protected function modificarDatos($filas){
		return $filas;
	}	
}
?>