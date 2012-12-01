<?php
#doc
#	classname:	Lista
#	scope:		PUBLIC
#
#/doc

class Lista extends Elemento{
	
	private $ordenada;
	
	/**
	 *	Contr�i uma lista
	 *	@param $ordenada		= define se a lista � ordenada ou n�o
	 */
	function __construct ($ordenada = FALSE){
		$this->ordenada		= $ordenada;
		$this->ordenada ? parent::__construct('ol') : parent::__construct('ul');
	}
	
	
	function adicionarItem($valor = ''){
		$item		= new Elemento('li');
		$item->adicionar("$valor");	
		parent::adicionar($item);
		return $item;
	}
	
}
?>
