<?php

class ItemObraModel extends ModelBase{

	public $pkItemObra;
	public $fkOrdenTrabajo;
	public $fkPoligono;
	public $fkActividad;
	public $codigo;
	public $descripcion;
	public $areaTrab;
	public $rendimiento;

	public function __construct()
	{
		parent::__construct();
		$this->tabla 	= 'spitemobra';		
		$pkItemObra 	= 0;
		$fkOrdenTrabajo = 0;
		$fkPoligono 	= 0;
		$fkActividad 	= 0;
		$codigo 		= '';
		$descripcion 	= '';
		$areaTrab 		= 0;
		$rendimiento 	= 0;
	}
	protected function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkitemobra"] = $this->pkItemObra;
			return $parametros;
	}
	protected function getParametros(){
		
		$parametros = array();	
		$parametros[":fkordentrabajo"] = $this->fkOrdenTrabajo;
		$parametros[":fkpoligono"] = $this->fkPoligono;
		$parametros[":fkactividad"] = $this->fkActividad;
		$parametros[":codigo"] = $this->codigo;
		$parametros[":descripcion"] = $this->descripcion;
		$parametros[":areatrab"] = $this->areaTrab;
		$parametros[":rendimiento"] = $this->rendimiento;

		return $parametros;
	}

	protected function getSqlListar(){
		$consulta  = " SELECT ";
		$consulta .= " o.pkItemObra, o.fkOrdenTrabajo, o.fkPoligono, o.fkActividad, ";
		$consulta .= " o.codigo, o.descripcion, o.areaTrab, o.rendimiento, i.nombre, i.data ";
		$consulta .= " FROM spitemobra o ";
		$consulta .= " INNER JOIN spordentrabajo i ON o.fkOrdenTrabajo = i.pkOrdenTrabajo ";
		return $consulta;
	}
	protected function getIdTabla(){
		return $this->pkItemObra;
	}
	protected function modificarDatos($filas){
		return $filas;
	}

}
?>