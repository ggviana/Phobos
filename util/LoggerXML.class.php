<?php

#doc
#	classname:	LoggerXML
#	scope:		PUBLIC
#
#/doc

class LoggerXML extends Logger{
	
	const CABECALHO = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<logs>\n";
	const RODAPE = '</logs>';
	
	/**
	 *	Escreve um texto no Log
	 *	@param $mensagem = mensagem escrita no arquivo de Log
	 */
	public function escrever($mensagem){
		$this->rodape();
		$tempo	= date("Y-m-d H:i:s");
		$texto	= "<log>\n";
		$texto	.= "<horario>{$tempo}</horario>\n";
		$texto	.= "<mensagem>{$mensagem}</mensagem>\n";
		$texto	.= "</log>\n";
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
	 *	Refaz o Rodapé do Log
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
