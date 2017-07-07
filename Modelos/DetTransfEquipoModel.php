<?php

class DetTransfEquipoModel extends ModelBase{

	public $pkDetTransfEquipo;
	public $fkTransfEquipo;
	public $item;
	public $fkEquipo;
  	public $hmto;
	public $observacion;

	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'spdettransfequipo';
		$pkDetTransfEquipo = 0;
		$fkTransfEquipo = 0;
		$item = 0;
		$fkEquipo = 0;
    	$hmto = 0;
		$observacion = '';
		$this->sequencia = "spdettransfequipo_pkdettransfequipo_seq";
	}
	protected function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkdettransfequipo"] = $this->pkDetTransfEquipo;
			return $parametros;
	}
	protected function getParametros(){
		$parametros = array();
		$parametros[":fktransfequipo"] = $this->fkTransfEquipo;
		$parametros[":item"] = $this->item;
		$parametros[":fkequipo"] = $this->fkEquipo;
		$parametros[":observacion"] = $this->observacion;
    	$parametros[":hmto"] = $this->hmto;

		return $parametros;
	}

	protected function getSqlListar(){
		$consulta = " SELECT ";
		$consulta .= " d.pkDetTransfequipo, d.fkTransfEquipo, d.item, d.hmto, ";
		$consulta .= " d.fkEquipo, d.observacion, p.descripcion as equipo ";

		$consulta .= " FROM spdettransfequipo d ";
		$consulta .= " 	INNER JOIN spequipo p ON d.fkEquipo = p.pkEquipo ";

		return $consulta;
	}
	protected function getIdTabla(){
		return $this->pkDetTransfEquipo;
	}
	protected function modificarDatos($filas){
		return $filas;
	}
}
?>
