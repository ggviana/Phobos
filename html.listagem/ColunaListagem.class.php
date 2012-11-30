<?php

#doc
#	classname:	ColunaListagem
#	scope:		PUBLIC
#
#/doc

class ColunaListagem{

	private $nome;
	private $rotulo;
	private $acao;
	private $formatacao;
	
	/**
	 *	Instancia uma coluna de dados
	 *	@param $nome = nome da coluna no banco de dados
	 *	@param $rotulo = nome da coluna na visualizacao
	 */
	public function __construct($nome, $rotulo = NULL){
		$this->nome = $nome;
		$this->rotulo = $rotulo === NULL ? $nome : $rotulo;
	}
	
	/**
	 *	Retorna o nome da Coluna
	 */
	public function getNome(){
		return $this->nome;
	}
	
	/**
	 *	Retorna o rotulo da Coluna
	 */
	public function getRotulo(){
		return $this->rotulo;
	}
	
	/**
	 *	Retorna a a��o da Coluna
	 */
	public function getAcao(){
		if(isset($this->acao))
			return $this->acao->serializar();
	}
	
	/**
	 *	Define a a��o da Coluna
	 *	@param $acao = acao que essa Coluna dispara
	 */
	public function setAcao(Acao $acao){
		$this->acao = $acao;
	}
	
	/**
	 *	Retorna o nome da fun��o que vai formatar os dados antes da exibi��o
	 */
	public function getFormatacao(){
		return $this->formatacao;
	}
	
	/**
	 *	Define uma fun��o que vai formatar os dados antes da exibi��o
	 *	@param $nome_funcao = nome da fun��o formatadora
	 */
	public function setFormatacao($nome_funcao){
		$this->formatacao = $nome_funcao;	
	}
}

?>
