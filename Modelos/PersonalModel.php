<?php
require_once('Negocio/FuncionesComunes.php');
class PersonalModel extends ModelBase{

	public $pkPersonal;
	public $fechaIngreso;
	public $nombreComp;
	public $apellidos;
	public $direccion;
	public $telefono;
	public $ci;
	public $fechaNac;
	public $fkCargo;
	public $fkOrdenTrabajo;
	public $email;
	

	public function __construct()
	{
		parent::__construct();
		$this->tabla = 'sppersonal';
		$pkPersonal = 0;
		$fechaIngreso = '1990-01-01';
		$nombreComp = '';
		$apellidos = 0;
		$direccion = '';
		$telefono = '';
		$ci = '';
		$fechaNac = '1990-01-01';
		$fkCargo = 0;
		$fkOrdenTrabajo = 0;
		$email = '';
	}
	

	protected function getParametrosWhere(){
			$parametros = array();
			$parametros[":pkpersonal"] = $this->pkPersonal;
			return $parametros;
	}
	protected function getParametros(){
		
		$parametros = array();			
	
		$parametros[":fechaIngreso"] 	= $this->fechaIngreso;
		$parametros[":nombreComp"] 		= $this->nombreComp;
		$parametros[":apellidos"] 		= $this->apellidos;
		$parametros[":direccion"] 		= $this->direccion;
		$parametros[":telefono"] 		= $this->telefono;
		$parametros[":ci"]				= $this->ci;
		$parametros[":fechaNac"]		= $this->fechaNac;
		$parametros[":fkCargo"] 		= $this->fkCargo;
		$parametros[":fkOrdenTrabajo"] 	= $this->fkOrdenTrabajo;
		$parametros[":email"] 			= $this->email;
	
		return $parametros;
	}
	protected function getSqlListar(){
		$consulta = " SELECT p.pkPersonal, p.fechaIngreso, p.nombreComp, p.apellidos, ";
		$consulta .= " p.direccion, p.telefono, p.ci, p.fechaNac, p.fkCargo, p.fkOrdenTrabajo, p.email, ";
		$consulta .= " c.descripcion, o.data, o.nombre";
		$consulta .= " FROM sppersonal p ";
		$consulta .= " INNER JOIN spcargo c ON p.fkcargo = c.pkCargo ";
		$consulta .= " INNER JOIN spordentrabajo o ON p.fkOrdenTrabajo = o.pkOrdenTrabajo ";		
		return $consulta;
	}
	protected function getIdTabla(){
		return $this->pkPersonal;
	}
	protected function modificarDatos($filas){
		# debo realizar los cambios de la fecha
		foreach ($filas as $value) {
			$value->fechaingreso = FuncionesComunes::formatearFormatoDDMMYYYY($value->fechaingreso);
			$value->fechanac = FuncionesComunes::formatearFormatoDDMMYYYY($value->fechanac);
		}
		return $filas;
	}
}
?>