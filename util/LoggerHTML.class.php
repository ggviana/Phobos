<?php

#doc
#	classname:	LoggerHTML
#	scope:		PUBLIC
#
#/doc

class LoggerHTML extends Logger{
	
	const CABECALHO = "<!DOCTYPE html>\n<html>\n";
	const RODAPE = '</html>';
	
	/**
	 *	Escreve um texto no Log
	 *	@param $mensagem = mensagem escrita no arquivo de Log
	 */
	public function escrever($mensagem){
		$this->rodape();
		$tempo	= date("Y-m-d H:i:s");
		$texto	= "<p><b>{$tempo}</b></p>\n<p>{$mensagem}</p>\n";
		$texto	.= self::RODAPE;
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
	protected function rodape(){
		$arquivo = file($this->caminho_do_arquivo);
		foreach($arquivo as $num_linha=>$linha){
			if($linha == self::RODAPE) unset($arquivo[$num_linha]);
		}
		file_put_contents($this->caminho_do_arquivo, $arquivo);
	}
	
}

?>
