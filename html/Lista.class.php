<?php
#doc
#	classname:	Lista
#	scope:		PUBLIC
#
#/doc

class Lista extends Elemento{
	
	private $ordenada;
	
	/**
	 *	Contrói uma lista
	 *	@param $ordenada		= define se a lista é ordenada ou não
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
