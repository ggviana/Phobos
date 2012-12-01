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
	 *	Retorna a ação da Coluna
	 */
	public function getAcao(){
		if(isset($this->acao))
			return $this->acao->serializar();
	}
	
	/**
	 *	Define a ação da Coluna
	 *	@param $acao = acao que essa Coluna dispara
	 */
	public function setAcao(Acao $acao){
		$this->acao = $acao;
	}
	
	/**
	 *	Retorna o nome da função que vai formatar os dados antes da exibição
	 */
	public function getFormatacao(){
		return $this->formatacao;
	}
	
	/**
	 *	Define uma função que vai formatar os dados antes da exibição
	 *	@param $nome_funcao = nome da função formatadora
	 */
	public function setFormatacao($nome_funcao){
		$this->formatacao = $nome_funcao;	
	}
}

?>
