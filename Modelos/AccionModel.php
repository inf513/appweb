<?php
class AccionModel extends ModelBase{

	public $pkAccion;
	public $codigo;
	public $descripcion;
	public $estado;

	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'accion';
		$pkAccion = 0;
		$codigo = '';
		$descripcion = "";
		$estado = "";
	}

	protected function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkaccion"] = $this->pkAccion;
			return $parametros;
	}
	protected function getParametros(){
		
		$parametros = array();			
		$parametros[":codigo"] = $this->codigo;
		$parametros[":descripcion"] = $this->descripcion;
		$parametros[":estado"] = $this->estado;
		return $parametros;
	}
	protected function modificarDatos($filas){
		return $filas;
	}
	protected function getIdTabla(){
		return $this->pkAccion;
	}
	protected function getSqlListar(){
		return "SELECT pkAccion, codigo, descripcion, estado FROM " . $this->tabla;
	}
}
?>