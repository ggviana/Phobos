<?php
#doc
#	classname:	Elemento
#	scope:		PUBLIC
#
#/doc

class Elemento {

	private $nome;
	private $propriedades;
	protected $filhos;

	/**
	 *	Constrói uma tag de elemento html
	 *	@param $nome		= nome da tag
	 */
	public function __construct($nome){
		$this->nome = $nome;
	}
	
	/**
	 *	Atribui as propriedades da tag
	 *	@param $nome		= nome do atributo
	 *	@param $valor		= valor do atributo
	 */
	public function __set($nome, $valor){
		$nome = str_replace('_','-',$nome);
		$valor = str_replace('_','-',$valor);
		$this->propriedades[$nome] = $valor;
	}
	
	/**
	 *	Adiciona um objeto a tag
	 *	@param $filho		= objeto
	 */
	public function adicionar($filho){
		$this->filhos[] = $filho;
	}
	
	/**
	 *	Imprime a abertura da tag
	 */
	private function abreTag(){
		// abre a tag
		echo "<{$this->nome}";
		// escreve as propriedades
		if($this->propriedades)
			foreach ($this->propriedades as $nome=>$valor)
				echo " {$nome}=\"{$valor}\"";
		echo '>';
	}
	
	/**
	 *	Imprime o fechamento da tag
	 */
	private function fechaTag(){
		echo "</{$this->nome}>\n";
	}
	
	/**
	 *	Imprime a tag
	 */
	public function imprimir(){
		// Imprime a abertura da tag
		$this->abreTag();
		
		// Se tiver propriedades
		if ($this->filhos){
			// Percorre os filhos
			foreach ($this->filhos as $filho){
				// Se for objeto
				if(is_object($filho))
					$filho->imprimir();
				else if((is_string($filho)) or (is_numeric($filho)))
					echo "$filho";
			}
		}
		// imprime o fechamento da tag
		$this->fechaTag();
	}
	
}
?>
