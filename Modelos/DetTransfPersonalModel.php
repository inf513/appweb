<?php

class DetTransfPersonalModel extends ModelBase{

	public $pkDetTransfPersonal;
	public $fkTransfPersonal;
	public $item;
	public $fkPersonal;
	public $observacion;

	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'spdettransfpersonal';
		$pkDetTransfPersonal = 0;
		$fkTransfPersonal = 0;
		$item = 0;
		$fkPersonal = 0;
		$observacion = '';
		$this->sequencia = "spdettransfpersonal_pkdettransfpersonal_seq";
	}

	protected function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkdettransfpersonal"] = $this->pkDetTransfPersonal;
			return $parametros;
	}
	protected function getParametros(){
		$parametros = array();			
		$parametros[":fktransfpersonal"] = $this->fkTransfPersonal;
		$parametros[":item"] = $this->item;
		$parametros[":fkpersonal"] = $this->fkPersonal;
		$parametros[":observacion"] = $this->observacion;
		
		return $parametros;
	}
	protected function getSqlListar(){
		$consulta = " SELECT ";
		$consulta .= " d.pkDetTransfPersonal, d.fkTransfPersonal, d.item,  ";
		$consulta .= " d.fkPersonal, d.observacion, CONCAT(p.nombreComp , p.apellidos) as personal ";
		
		$consulta .= " FROM spdettransfpersonal d ";
		$consulta .= " 	INNER JOIN sppersonal p ON d.fkPersonal = p.pkPersonal ";

		return $consulta;
	}
	protected function getIdTabla(){
		return $this->pkDetTransfPersonal;
	}
	protected function modificarDatos($filas){
		return $filas;
	}
}
?>