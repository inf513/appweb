<?php

class ImproductivaModel extends ModelBase{

	public $pkImproductiva;
	public $codigo;
	public $descripcion;

	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'spimproductiva';
		$this->sequencia = 'spimproductiva_pkimproductiva_seq';
		$pkImproductiva = 0;
		$codigo = '';
		$descripcion = '';
	}
	protected function getIdTabla(){
		return $this->pkImproductiva;
	}
	protected function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkimproductiva"] = $this->pkImproductiva;
			return $parametros;
	}
	protected function getParametros(){
		
		$parametros = array();			
		$parametros[":descripcion"] = $this->descripcion;
		$parametros[":codigo"] = $this->codigo;
			
		return $parametros;
	}
	protected function getSqlListar(){
		return  "SELECT pkimproductiva, codigo, descripcion FROM " . $this->tabla;
	}
	protected function modificarDatos($filas){
		return $filas;
	}
}
?>