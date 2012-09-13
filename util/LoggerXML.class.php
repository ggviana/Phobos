<?php

#doc
#	classname:	LoggerXML
#	scope:		PUBLIC
#
#/doc

class LoggerXML extends Logger{
	
	const CABECALHO = "<logs>\n";
	const RODAPE = '</logs>';
	
	/**
	 *	Escreve um texto no Log
	 *	@param $mensagem = mensagem escrita no arquivo de Log
	 */
	public function escrever($mensagem){
		$tempo	= date("Y-m-d H:i:s");
		$texto	= "<log>\n";
		$texto	.= "<horario>{$tempo}</horario>\n";
		$texto	.= "<mensagem>{$mensagem}</mensagem>\n";
		$texto	.= "</log>\n";
		$arquivo = fopen($this->caminho_do_arquivo, 'a');
		fwrite($arquivo, $texto);
		fclose($arquivo);
	}
	
	protected function cabecalho(){
		return self::CABECALHO;
	}
	
	protected function rodape(){
		
	}
	
}

?>
