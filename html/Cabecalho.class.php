<?php
#doc
#	classname:	Cabecalho
#	scope:		PUBLIC
#
#/doc

class Cabecalho extends Elemento{

	private $align;
	
	/**
	 *	Constr�i uma tag Heading
	 *	@param $tamanho		= tamanho do Heading(1~6)
	 *	@param $texto		= texto do Heading
	 */
	function __construct ($tamanho, $texto){
		parent::__construct('h'.$tamanho);
		parent::adicionar($texto);
	}

	/**
	 *	Ajusta o alinhamento do Header
	 *	@param $posicao		= posi��o do Heading(1~6)
	 */
	public function setAlign($posicao){
		$this->align		= "$posicao";
	}
}
?>
