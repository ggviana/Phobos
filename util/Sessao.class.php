<?php

#doc
#	classname:	Sessao
#	scope:		PUBLIC
#
#/doc

class Sessao{
	
	/**
	 *	Instancia uma Sessao
	 */
	public function __construct(){
		session_start();
	}
	
	/**
	 *	Adiciona/Altera uma variavel de sessao
	 *	@param $variavel = nome da variavel
	 *	@param $valor = valor da variavel
	 */
	public function setVariavel($variavel, $valor){
		$_SESSION[$variavel] = $valor;
	}
	
	/**
	 *	Recupera o valor de uma variavel
	 *	@param $variavel = nome da variavel
	 *	@return
	 */
	public function getVariavel($variavel){
		if(isset($_SESSION[$variavel]))
			return $_SESSION[$variavel];
		return NULL;
	}
	
	/**
	 *	Termina uma sessao
	 */
	public function finalizar(){
		$_SESSION = array();
		session_destroy();
	}
}
?>
