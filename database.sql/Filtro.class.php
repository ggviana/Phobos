<?php

#doc
#	classname:	Filtro
#	scope:		PUBLIC
#
#/doc

class Filtro extends Expressao{

	private $variavel;
	private $operador;
	private $valor;
	
	/**
	 *	Contrói um novo Filtro de seleção
	 *	@param $variavel= variável
	 *	@param $operador= operador(OR, AND)
	 *	@param $valor= valor de comparação
	 */
	public function __construct($variavel, $operador, $valor){
		$this->variavel= $variavel;
		$this->operador= $operador;
		$this->valor= $this->transformar($valor);
	}

	/**
	 *	Modifica uma string para ser interpretada por um banco de dados
	 *	@param $valor= valor a ser transformado
	 */
	private function transformar($valor){
		// Se for um array
		if(is_array($valor)){
			foreach($valor as $x){
				if(is_numeric($x)){
					$array[] = $x;
				}
				else if(is_string($x)){
					$array[] = "'$x'";
				}
			}
			return '(' . implode(',', $array) . ')';
		}
		// Se for String
		else if(is_string($valor)){
			return "'$valor'";
		}
		// Se for nulo
		else if(is_null($valor)){
			return 'NULL';
		}
		// Se for boolean
		else if(is_bool($valor)){
			return $valor ? 'TRUE' : 'FALSE';
		}
		else{
			return $valor;
		}
	}
	
	/**
	 *	Retorna o a expressão do Filtro
	 */
	public function esvaziar(){
		return "{$this->variavel} {$this->operador} {$this->valor}";
	}
}

?>
