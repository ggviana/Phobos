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
	 *	Constr�i uma A��o que dispara um m�todo de uma classe por URL(via GET) 
	 *	@param $metodo	= m�todo ou fun��o
	 *	@param $classe	= classe
	 */
	public function __construct($metodo, $classe = null){
		$this->url['classe']		= $classe;
		$this->url['metodo']		= $metodo;
	}
	
	/**
	 *	Adiciona vari�veis na URL
	 *	@param $var		= vari�vel
	 *	@param $valor	= valor
	 */
	public function adicionarVariavel($variavel, $valor){
		$this->variaveis[$variavel]	= $valor;
	}
	
	/**
	 *	Transforma a A��o em URL
	 */
	public function serializar(){
		if($this->variaveis)
			$this->url = array_merge($this->url, $this->variaveis);
		return '?' . http_build_query($this->url);
	}

}

?>