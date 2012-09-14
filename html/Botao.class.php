<?php
#doc
#	classname:	class
#	scope:		PUBLIC
#
#/doc

class class extends Elemento{

	private Acao $acao;
	
	#	Constructor
	function __construct ($texto){
		parent::('button');
		parent::adicionar($texto);
	}

	public adicionarAcao(Acao $acao){
		$this->$acao = $acao;
	}
}
?>
