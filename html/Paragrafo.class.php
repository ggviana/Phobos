<?php
#doc
#	classname:	Paragrafo
#	scope:		PUBLIC
#
#/doc

class Paragrafo extends Elemento{

	private $align;
	
	/**
	 *	Contrói uma tag de parágrafo
	 *	@param $texto		= texto do parágrafo
	 */
	function __construct ($texto){
		parent::__construct('p');
		parent::adicionar($texto);
	}
	
	/**
	 *	Ajusta o alinhamento do parágrafo
	 *	@param $posicao		= posição do parágrafo(1~6)
	 */
	public function setAlign($posicao){
		$this->align		= "$posicao";
	}
}
?>
