<?php

class OrdenTrabajoModel extends ModelBase{
  
	public $pkOrdenTrabajo;
	public $codigo;
	public $fkGestion;
	public $nombre;
	public $supervisor;
	public $areaEstimada;
	public $estado;
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'spordentrabajo';
		$pkOrdenTrabajo = 0;
		$codigo = '';
		$fkGestion = 0;
		$nombre = '';
		$supervisor = '';
		$areaEstimada = 0;
		$estado = '';
		$data = '';
	}

	protected function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkordentrabajo"] = $this->pkOrdenTrabajo;
			return $parametros;
	}
	protected function getParametros(){
		
		$parametros = array();			
	
		$parametros[":codigo"] = $this->codigo;
		$parametros[":fkgestion"] = $this->fkGestion;
		$parametros[":nombre"] = $this->nombre;
		$parametros[":supervisor"] = $this->supervisor;
		$parametros[":areaestimada"] = $this->areaEstimada;
		$parametros[":estado"] = $this->estado;
		$parametros[":data"] = $this->data;

		return $parametros;
	}

	protected function getSqlListar(){
		$consulta  = " SELECT o.pkordenTrabajo, o.codigo, o.fkGestion, o.nombre, o.supervisor, o.areaEstimada, o.estado, o.data, g.codigo as codgest ";
		$consulta .= " FROM spordentrabajo o INNER JOIN spgestion g ON o.fkGestion = g.pkGestion";

		return $consulta;
	}
	protected function getIdTabla(){
		return $this->pkOrdenTrabajo;
	}
	protected function modificarDatos($filas){
		return $filas;
	}
}
?>