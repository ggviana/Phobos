<?php

#doc
#	classname:	Logger
#	scope:		PUBLIC
#
#/doc

abstract class Logger{
	
	protected $caminho_do_arquivo;
	
	/**
	 *	Constr�i um Log
	 *	@param $caminho_do_arquivo = caminho para o arquivo que ser� feito o Log
	 */
	public function __construct($caminho_do_arquivo){
		$this->caminho_do_arquivo = $caminho_do_arquivo;
		// Faz o arquivo se n�o existir
		if(!file_exists($caminho_do_arquivo))
			file_put_contents($caminho_do_arquivo, $this->cabecalho());
	}
	
	/**
	 *	Escreve um texto no Log
	 *	@param $mensagem = mensagem escrita no arquivo de Log
	 */
	public abstract function escrever($mensagem);
	
	/**
	 *	Retorna o Cabe�alho desse Log
	 */
	protected abstract function cabecalho();
	
	/**
	 *	Refaz o rodap� do Log
	 */
	protected abstract function rodape();
	
}

?>
