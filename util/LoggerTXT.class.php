<?php

#doc
#	classname:	LoggerTXT
#	scope:		PUBLIC
#
#/doc

class LoggerTXT extends Logger{
	const CABECALHO = "---------------------------------------------------------------------------------\n";
	const RODAPE = '';
	
	/**
	 *	Escreve um texto no Log
	 *	@param $mensagem = mensagem escrita no arquivo de Log
	 */
	public function escrever($mensagem){
		$this->cabecalho();
		$tempo	= date("Y-m-d H:i:s");
		$texto	= "{$tempo} - {$mensagem}\n";
		$arquivo = fopen($this->caminho_do_arquivo, 'a');
		fwrite($arquivo, $texto);
		fclose($arquivo);
	}
	
	/**
	 *	Retorna o Cabeçalho desse Log
	 */
	protected function cabecalho(){
		return self::CABECALHO;
	}
	
	/**
	 *	Refaz o rodapé do Log
	 */
	protected function rodape(){ /* Não há necessidade de um rodapé aqui */ }
	
}

?>
