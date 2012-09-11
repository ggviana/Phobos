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
		file_put_contents($caminho_do_arquivo, '');
	}
	
	/**
	 *	Escreve um texto no Log
	 *	@param $mensagem = mensagem escrita no arquivo de Log
	 */
	abstract function escrever($mensagem);
	
}

?>
