<?php
class GrupoModel extends ModelBase{

	public $pkGrupo;
	public $descripcion;
	public $estado;

	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'grupo';
		$pkGrupo = 0;
		$descripcion = '';
		$estado = "";
	}
	protected function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkGrupo"] = $this->pkGrupo;
			return $parametros;
	}
	protected function getParametros(){		
		$parametros = array();			
		$parametros[":descripcion"] = $this->descripcion;	
		$parametros[":estado"] = $this->estado;
		return $parametros;
	}
	protected function getSqlListar(){
		$consulta = "SELECT pkGrupo, descripcion, estado FROM " . $this->tabla;
		return $consulta;
	}
	protected function getIdTabla(){
		return $this->pkGrupo;
	}
	protected function modificarDatos($filas){
		return $filas;
	}
}
?>