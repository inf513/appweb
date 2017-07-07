<?php

class TransfEquipoModel extends ModelBase{

	public $pkTransfEquipo;
	public $codigo;
	public $fkGestion;
	public $fecha;
	public $fkOrdenOrigen;
	public $fkOrdenDestino;
	public $observacion;
	public $data;
	public $estado;

	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'sptransfequipo';
		$pkTransfEquipo = 0;
		$codigo = "";
		$fkGestion = 0;
		$fecha = '1990-01-01';
		$fkOrdenOrigen = 0;
		$fkOrdenDestino = 0;
		$observacion = '';
		$data = '';
		$estado = '';
		$this->sequencia = "sptransfequipo_pktransfequipo_seq";
	}

	protected function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkTransfEquipo"] = $this->pkTransfEquipo;
			return $parametros;
	}
	protected function getParametros(){
		$parametros = array();
		$parametros[":codigo"] = $this->codigo;
		$parametros[":fkGestion"] = $this->fkGestion;
		$parametros[":fecha"] = $this->fecha;
		$parametros[":fkOrdenOrigen"] = $this->fkOrdenOrigen;
		$parametros[":fkOrdenDestino"] = $this->fkOrdenDestino;
		$parametros[":observacion"] = $this->observacion;
		$parametros[":data"] = $this->data;
		$parametros[":estado"] = $this->estado;

		return $parametros;
	}
	protected function getSqlListar(){
		$consulta = " SELECT ";
		$consulta .= " t.pkTransfEquipo, t.codigo, t.fkGestion, t.fecha, ";
		$consulta .= " t.fkOrdenOrigen, t.fkOrdenDestino, t.observacion, t.data, ";
		$consulta .= " t.estado, w.data as codOtOrigen, w.nombre as nombreOrigen, ";
		$consulta .= " q.data as codOtDestino, q.nombre as nombreDestino ";

		$consulta .= " FROM sptransfequipo t ";
		$consulta .= " 	INNER JOIN spOrdenTrabajo w ON t.fkOrdenOrigen  = w.pkOrdenTrabajo ";
		$consulta .= " 	INNER JOIN spOrdenTrabajo q ON t.fkOrdenDestino = q.pkOrdenTrabajo ";

		return $consulta;
	}
	
	protected function getIdTabla(){
		return $this->pkTransfEquipo;
	}

	protected function modificarDatos($filas){		
		# debo realizar los cambios de la fecha
		foreach ($filas as $value) {
			$value->fecha = FuncionesComunes::formatearFormatoDDMMYYYY($value->fecha);
		}
		return $filas;
	}
}
?>
