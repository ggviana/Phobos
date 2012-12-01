<?php

#doc
#	classname:	Update
#	scope:		PUBLIC
#
#/doc

final class Update extends InstrucaoSQL{

	private $valores;
	
	/**
	 *	Constrói uma Instrução UPDATE
	 *	@param $entidade = entidade afetada pela instrução
	 */
	public function __construct($entidade = NULL){
		$valores = array();
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
	 *	Monta a instrução Update
	 */
	public function getInstrucao(){
		if($this->getEntidade() and $this->criterio){
			$set = array();
			foreach($this->valores as $coluna=>$valor){
				$set[] = "{$coluna} = {$valor}";
			}
			return 'UPDATE ' . $this->getEntidade() .
			' SET ' . implode(', ', $set) .
			' WHERE ' . $this->criterio->esvaziar();
		}
		else
			throw new Exception('Defina uma Tabela e um Critério');
	}
	
}

?>
