<?php 
include_once("State.php");
include_once("StateFuncionamiento.php");
include_once("StateVenta.php");
class StateReparacion implements State{
	private $estadoEquipo;
	private $id = "REPARACION";

	public function __construct($estadoEquipo){
		$this->estadoEquipo = $estadoEquipo;
	}
	public function getID(){
		return $this->id;
	}
	public function enReparacion(){
		return "Ya esta en estado de reparacion";
	}	
	public function enFuncionamiento(){
		$sFuncionamiento = new StateFuncionamiento($this->estadoEquipo);
		$this->estadoEquipo->setEstado($sFuncionamiento);
		return "";
	}
	public function enVenta(){
		$sVenta = new StateVenta($this->estadoEquipo);
		$this->estadoEquipo->setEstado($sVenta);
		return "";
	}
	public function enNuevo(){
		return "No puede ser nuevo!!";
	}	
}
?>
