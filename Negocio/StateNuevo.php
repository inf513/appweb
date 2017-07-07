<?php 
include_once("State.php");
include_once("StateFuncionamiento.php");
include_once("StateReparacion.php");
include_once("EstadoEquipo.php");
class StateNuevo implements State{
	private $estadoEquipo;
	private $id = "NUEVO";

	public function __construct($estadoEquipo){
		$this->estadoEquipo = $estadoEquipo;
	}
	public function getID(){
		return $this->id;
	}	
	public function enReparacion(){
		$sReparacion = new StateReparacion($this->estadoEquipo);
		$this->estadoEquipo->setEstado($sReparacion);
		return "";
	}	
	public function enFuncionamiento(){
		$sFuncionamiento = new StateFuncionamiento($this->estadoEquipo);
		$this->estadoEquipo->setEstado($sFuncionamiento);
		return "";
	}
	public function enVenta(){
		return "no puede venderse sin antes haber entrado en reparacion o funcionamiento!";
	}
	public function enNuevo(){
		return "Ya es nuevo no puede ser de nuevo!!";
	}	
}
?>