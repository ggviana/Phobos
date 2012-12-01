<?php

#doc
#	classname:	AcaoListagem
#	scope:		PUBLIC
#
#/doc

class AcaoListagem extends Acao{
	
	private $caminho_imagem;
	private $rotulo;
	private $coluna;
	
	/**
	 *	Define uma imagem pra essa Ação
	 *	@param $caminho_imagem = caminho para imagem
	 */
	public function setImagem($caminho_imagem){
		$this->caminho_imagem = $caminho_imagem;
	}
	
	/**
	 *	Retorna o caminho para imagem dessa Ação
	 */
	public function getImagem(){
		return $this->caminho_imagem;
	}
	
	/**
	 *	Retorna o rotulo da Coluna
	 */
	public function getRotulo(){
		return $this->rotulo;
	}
	
	/**
	 *	Retorna o nome da coluna afetada por essa ação
	 */
	public function getColuna(){
		return $this->coluna;
	}
	
	/**
	 *	Define a coluna que essa ação afeta
	 *	@param 
	 */
	public function setColuna($coluna){
		$this->coluna =  $coluna;
	}
}

?>
