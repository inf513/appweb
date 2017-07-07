<?php 
/**
* Clase composite
*/
include_once("ICodigoComponent.php");
include_once("./Modelos/CodigoModel.php");

class CodigoComposite extends ICodigoComponent{

	private $listCodigo;
	private $codigo; # modelo codigo

	function __construct($codigo){
		$listCodigo = array();
		$this->codigo = $codigo;
	}
	
	public function setCodigo($codigoStr){
		$this->codigo->codigo = $codigoStr;
	}
	public function getCodigoParcial(){
		return $this->codigo->codigo;
	}
	public function getPkCodigo(){
		return $this->codigo->pkCodigo;
	}
	/**
	 * Metodo que devuelve el numero de hojas que tiene
	 * @return [int] [numero de hojas]
	 */
	public function getListCount(){
		return count($this->listCodigo);
	}
	/** Es el metodo que recorre la recursividad hacia atras */
	public function getCodigo(){
		$codigoFull = "";
		foreach ($this->listCodigo as $component) {
				$codigoFull = $codigoFull . $component->getCodigo() . "-";
		}
		return $codigoFull . $this->codigo->codigo;
	}
	public function getDescripcion(){
		return $this->codigo->descripcion;
	}
	public function adicionar($componente){
		$this->listCodigo[] = $componente;
	}
	public function remover($componente){
		foreach ($this->listCodigo as $codigo) {
			if($codigo->getPkCodigo() == $componente->getPkCodigo()){
				unset($codigo);
			}
		}
	}
	public function getComponent($index){
		return $this->listCodigo[$index];
	}
}
?>