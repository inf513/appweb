<?php
include_once("StateNuevo.php");
class EstadoEquipo{
	private $estado; # estado actual del equipo

	public function __construct(){
		$estado = new StateNuevo($this);
	}

	public function getEstado(){
		return $this->estado;
	}
	public function setEstado($state){
		$this->estado = $state;
	}
	public function equipoEnReparacion(){
		return $this->estado->enReparacion();
	}
	public function equipoEnFuncionamiento(){
		return $this->estado->enFuncionamiento();
	}
	public function equipoEnVenta(){
		return $this->estado->enVenta();
	}
	public function equipoNuevo(){
		return $this->estado->enNuevo();
	}
}
?>