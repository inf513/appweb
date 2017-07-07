<?php 
include_once("State.php");
include_once("StateReparacion.php");
include_once("StateVenta.php");
include_once("EstadoEquipo.php");
class StateFuncionamiento implements State{
	private $estadoEquipo;
	private $id;

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
		return "Ya esta en funcionamiento!!";
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