<?php
class CargoModel extends ModelBase{

	public $pkCargo;
	public $codigo;
	public $descripcion;

	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'spcargo';
		$pkCargo = 0;
		$codigo = '';
		$descripcion = '';
	}

	protected function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkCargo"] = $this->pkCargo;
			return $parametros;
	}
	protected function getParametros(){
		
		$parametros = array();			
	
		$parametros[":codigo"] = $this->codigo;
		$parametros[":descripcion"] = $this->descripcion;

		return $parametros;
	}
	protected function getIdTabla(){
		return $this->pkCargo;
	}
	protected function getSqlListar(){
		return " SELECT pkCargo, codigo, descripcion FROM " . $this->tabla;
	}
	protected function modificarDatos($filas){
		return $filas;
	}
}
?>