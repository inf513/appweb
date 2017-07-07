<?php
interface State {
	public function enReparacion();
	public function enFuncionamiento();
	public function enVenta();
	public function enNuevo();
}
?>