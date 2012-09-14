<?php
#doc
#	classname:	Linha
#	scope:		PUBLIC
#
#/doc

class Linha extends Elemento{
	
	/**
	 *  Contr�i uma linha de tabela
	 */
	function __construct (){
		parent::__construct('tr');
	}

	/**
	 *  Adiciona uma c�lula a esta linha
	 *	@param $valor		= Conteudo da c�lula
	 */
	public function adicionarCelula($valor){
		// Cria uma nova celula
		$celula = new Celula($valor);
		// Adiciona a celula na linha
		parent::adicionar($celula);
		return $celula;
	}
}
?>
