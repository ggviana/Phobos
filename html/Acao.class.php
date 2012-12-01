<?php

#doc
#	classname:	Acao
#	scope:		PUBLIC
#
#/doc

class Acao{

	private $url;
	private $variaveis;
	
	/**
	 *	Constrуi uma Aзгo que dispara um mйtodo de uma classe por URL(via GET) 
	 *	@param $metodo	= mйtodo ou funзгo
	 *	@param $classe	= classe
	 */
	public function __construct($metodo, $classe = null){
		$this->url['classe']		= $classe;
		$this->url['metodo']		= $metodo;
	}
	
	/**
	 *	Adiciona variбveis na URL
	 *	@param $var		= variбvel
	 *	@param $valor	= valor
	 */
	public function adicionarVariavel($variavel, $valor){
		$this->variaveis[$variavel]	= $valor;
	}
	
	/**
	 *	Transforma a Aзгo em URL
	 */
	public function serializar(){
		if($this->variaveis)
			$this->url = array_merge($this->url, $this->variaveis);
		return '?' . http_build_query($this->url);
	}

}

?>