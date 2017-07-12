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
		$this->sequencia = "sppoligono_pkpoligono_seq";
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

		return $parametros;
	}
	protected function getSqlListar(){
		$consulta = " SELECT";
		$consulta .= " p.pkpoligono, p.fkordentrabajo,";
		$consulta .= " p.codigo, p.descripcion,";
		$consulta .= " o.data as codOt, o.nombre as nombreOt";
		$consulta .= " from sppoligono p";
		$consulta .= " inner join spordentrabajo o on p.fkordentrabajo = o.pkordentrabajo";
		return $consulta;
	}
	protected function getIdTabla(){
		return $this->pkPoligono;
	}
	protected function modificarDatos($filas){
		return $filas;
	}
}
?>