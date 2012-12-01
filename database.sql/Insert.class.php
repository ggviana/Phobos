<?php

#doc
#	classname:	Insert
#	scope:		PUBLIC
#
#/doc

final class Insert extends InstrucaoSQL{

	private $valores;
	
	/**
	 *	Constr�i uma Instru��o INSERT
	 *	@param $entidade = entidade afetada pela instru��o
	 */
	public function __construct($entidade = NULL){
		$this->valores = array();
		if($entidade)
			parent::setEntidade($entidade);
	}
	
	/**
	 *	Define o valor para uma coluna
	 *	@param $coluna = coluna da tabela
	 *	@param $valor = valor da coluna
	 */
	public function setDados($coluna, $valor){
		if(is_scalar($valor)){
			if(is_string($valor) and (!empty($valor))){
				$valor = addslashes($valor);
				$this->valores[$coluna] = "'$valor'";
			}
			else if(is_bool($valor)){
				$this->valores[$coluna] = $valor ? 'TRUE' : 'FALSE';
			}
			else if(is_null($valor)){
				$this->valores[$coluna] = 'NULL';
			}
			else{
				$this->valores[$coluna] = $valor;
			}
		}
	}
	
	/**
	 *	N�o � poss�vel definir um crit�rio para Inserts, logo, uma Exce��o � lan�ada
	 */
	public function setCriterio(Criterio $criterio){
		throw new Exception('Incapaz de definir um Crit�rio para INSERT');
	}
	
	/**
	 *	Monta a instru��o Insert
	 */
	public function getInstrucao(){
		if($this->getEntidade())
			return 'INSERT INTO ' . $this->getEntidade() .
			' (' . implode(', ', array_keys($this->valores)) . ')' .
			' VALUES ' . '(' . implode(', ', array_values($this->valores)) . ')';
		else
			throw new Exception('Defina uma Tabela');
	}
	
}

?>
