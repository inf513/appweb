<?php 
include_once("State.php");
class StateVenta implements State{
	private $estadoEquipo;
	private $id = "VENDIDO";

	public function __construct($estadoEquipo){
		$this->estadoEquipo = $estadoEquipo;
	}
	public function getID(){
		return $this->id;
	}
	public function enReparacion(){
		return "No se puede reparar ya no existe en inventario!!";
	}
	public function enFuncionamiento(){		
		return "No se puede reparar ya no existe en inventario!!";
	}
	public function enVenta(){
		return "Ya se encuentra vendido!!";
	}
	public function enNuevo(){
		return "No puede ser nuevo!!";
	}
}
?>
