<?php
class PoligonoModel extends ModelBase{

	public $pkPoligono;
	public $fkOrdenTrabajo;
	public $codigo;
	public $descripcion;

	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'sppoligono';
		$pkPoligono = 0;
		$fkOrdenTrabajo = 0;
		$codigo = '';
		$descripcion = '';
	}

	protected function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkPoligono"] = $this->pkPoligono;
			return $parametros;
	}
	protected function getParametros(){
		
		$parametros = array();			
		$parametros[":fkOrdenTrabajo"] = $this->fkOrdenTrabajo;
		$parametros[":codigo"] = $this->codigo;
		$parametros[":descripcion"] = $this->descripcion;

		if($tipo == 0) // insertar
			$parametros[":pkPoligono"] = $this->pkPoligono;

		return $parametros;
	}
	protected function getSqlListar(){
		return "SELECT pkPoligono, fkOrdenTrabajo, codigo, descripcion FROM " . $this->tabla;
	}
	protected function getIdTabla(){
		return $this->pkPoligono;
	}
	protected function modificarDatos($filas){
		return $filas;
	}
}
?>