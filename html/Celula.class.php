<?php
#doc
#	classname:	Celula
#	scope:		PUBLIC
#
#/doc

class Celula extends Elemento{
	
	/**
	 *	Contrói uma célula de tabela
	 *	@param $valor		= conteudo da célula
	 */
	function __construct ($valor){
		parent::__construct('td');
		parent::adicionar($valor);
	}
}
?>
