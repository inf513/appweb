<?php

abstract class ICodigoComponent{


	public abstract function getPkCodigo();	
	public abstract function getCodigo();
	public abstract function getDescripcion();

	public abstract function adicionar($componente);
	public abstract function remover($componente);
	public abstract function getComponent($index);
}
?>

