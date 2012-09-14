<?php
#doc
#	classname:	Paragrafo
#	scope:		PUBLIC
#
#/doc

class Paragrafo extends Elemento{

	private $align;
	
	/**
	 *	Contr�i uma tag de par�grafo
	 *	@param $texto		= texto do par�grafo
	 */
	function __construct ($texto){
		parent::__construct('p');
		parent::adicionar($texto);
	}
	
	/**
	 *	Ajusta o alinhamento do par�grafo
	 *	@param $posicao		= posi��o do par�grafo(1~6)
	 */
	public function setAlign($posicao){
		$this->align		= "$posicao";
	}
}
?>
