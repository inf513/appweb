<?php 
/**
* Metodo hoja que implementa las clases abstractas del la clase componente
*/
include_once("ICodigoComponent.php");

class CodigoHoja extends ICodigoComponent
{

	private $codigo;
	private $pkCodigo;

	function __construct($codigo, $pkCodigo){
		$this->codigo = $codigo;
		$this->pkCodigo = $pkCodigo;
	}
	public function getPkCodigo(){
		return $this->pkCodigo;
	}
	public function getCodigo(){
		return $this->codigo;
	}
	public function getDescripcion(){
		return "";
	}

	/* estos metodos no se implementan en las hojas*/
	public function adicionar($componente){

	}
	public function remover($componente){

	}
	public function getComponent($index){

	}
}
?>