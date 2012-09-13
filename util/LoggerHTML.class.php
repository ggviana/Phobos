<?php

#doc
#	classname:	LoggerHTML
#	scope:		PUBLIC
#
#/doc

class LoggerHTML extends Logger{
	
	const CABECALHO = "<html>\n";
	const RODAPE = '</html>';
	
	/**
	 *	Escreve um texto no Log
	 *	@param $mensagem = mensagem escrita no arquivo de Log
	 */
	public function escrever($mensagem){
		$tempo	= date("Y-m-d H:i:s");
		$texto	= "<p><b>{$tempo}</b></p>\n";
		$texto	.= "<p>{$mensagem}</p>\n";
		$arquivo = fopen($this->caminho_do_arquivo, 'a');
		fwrite($arquivo, $texto);
		fclose($arquivo);
	}
	
	protected function cabecalho(){
		return self::CABECALHO;
	}
	
	protected function rodape(){
		if(fgets())
	}
	
}

?>
