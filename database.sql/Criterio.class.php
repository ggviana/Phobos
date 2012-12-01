<?php

#doc
#	classname:	Criterio
#	scope:		PUBLIC
#
#/doc

class Criterio extends Expressao{

	private $expressoes;
	private $operadores;
	private $propriedades;
	
	/**
	 *	Contrói um novo Critério de seleção
	 */
	public function __construct(){
		$this->expressoes= array();
		$this->operadores= array();
	}

	/**
	 *	Adiciona uma nova expressão ao Critério
	 *	@param $valor= valor a ser transformado
	 *	@param $operador= Operador que acompanha a expressao(AND, OR)
	 */
	public function adicionarExpressao(Expressao $expressao, $operador = SELF::OPERADOR_AND){
		if(empty($this->expressoes))
			$operador= NULL;
			
		$this->expressoes[]= $expressao;
		$this->operadores[]= $operador;
	}
	
	/**
	 *	Define o valor de uma propriedade
	 *	@param $propriedade= nome da propriedade
	 *	@param $valor= $valor da propriedade
	 */
	public function setPropriedade($propriedade, $valor){
		if(isset($valor))
			$this->propriedades[propriedade]= $valor;
		else
			$this->propriedades[propriedade]= NULL;
	}
	
	/**
	 *	Retorna uma propriedade específica desse Critério
	 *	@param $propriedade= propriedade 
	 */
	public function getPropriedade($propriedade){
		if(isset($this->propriedades[propriedade]))
			return $this->propriedades;
	}
	
	/**
	 *	Retorna o a expressão do Critério
	 */
	public function esvaziar(){
		// Concatenando as expressoes
		if(is_array($this->expressoes)){
			if(count($this->expressoes) > 0){
				$str= '';
				foreach($this->expressoes as $i=>$expressao)
					$str.= $this->operadores[$i] . $expressao->esvaziar() . ' ';
				
				return '(' . trim($str) . ')';
			}
		}
	}
}

?>
