<?php
class EstadoModel extends ModelBase{

	public $codigo;
	public $descripcion;

	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'spestado';
		$codigo = '';
		$descripcion = '';
	}

	protected function getParametrosWhere(){
			$parametros = array();
			$parametros[":codigo"] = $this->codigo;
			return $parametros;
	}
	protected function getParametros(){
		
		$parametros = array();			
	
		$parametros[":descripcion"] = $this->descripcion;

		return $parametros;
	}
	protected function getIdTabla(){
		return 0;
	}
	protected function getSqlListar(){
		return " SELECT codigo, descripcion FROM " . $this->tabla;
	}
	protected function modificarDatos($filas){
		return $filas;
	}
}
?>