<?php
#doc
#	classname:	Celula
#	scope:		PUBLIC
#
#/doc

class Celula extends Elemento{
	
	/**
	 *	Contr�i uma c�lula de tabela
	 *	@param $valor		= conteudo da c�lula
	 */
	function __construct ($valor){
		parent::__construct('td');
		parent::adicionar($valor);
	}
}
?>
