<?php
class CodigoModel extends ModelBase{

	public $pkCodigo;
	public $fkCodigoPadre;
	public $codigo;
	public $descripcion;

	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'spcodigo';
		$this->sequencia = "sequence_pkcodigo";
		$pkCargo = 0;
		$fkCodigoPadre = -1;
		$codigo = '';
		$descripcion = '';
	}

	protected function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkCodigo"] = $this->pkCodigo;
			return $parametros;
	}
	protected function getParametros(){
		
		$parametros = array();			
	
		$parametros[":fkcodigopadre"] = $this->fkCodigoPadre;
		$parametros[":codigo"] = $this->codigo;
		$parametros[":descripcion"] = $this->descripcion;

		return $parametros;
	}
	protected function getIdTabla(){
		return $this->pkCodigo;
	}
	protected function getSqlListar(){
		return " SELECT pkCodigo, fkCodigoPAdre, codigo, descripcion FROM " . $this->tabla;
	}
	protected function modificarDatos($filas){
		return $filas;
	}
}
?>