<?php
#doc
#	classname:	Tabela
#	scope:		PUBLIC
#
#/doc

class Tabela extends Elemento{

	/**
	 *	Contrói uma tabela
	 */
	function __construct (){
		parent::__construct('table');	
	}

	/**
	 *	Adiciona uma linha a tabela
	 */
	public function adicionarLinha(){
		// Cria uma nova linha
		$linha = new Linha();
		// Adiciona na tabela
		parent::adicionar($linha);
		return $linha;
	}
}
?>
