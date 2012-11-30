<?php

#doc
#	classname:	Delete
#	scope:		PUBLIC
#
#/doc

final class Delete extends InstrucaoSQL{

	
	
	/**
	 *	Constr�i uma Instru��o DELETE
	 *	@param $entidade = entidade afetada pela instru��o
	 */
	public function __construct($entidade = NULL){
		if($entidade)
			parent::setEntidade($entidade);
	}
	
	
	/**
	 *	Monta a instru��o Delete
	 */
	public function getInstrucao(){
		if($this->getEntidade() and $this->criterio)
			return $sql = "DELETE FROM " . $this->getEntidade() . " WHERE " . $this->criterio->esvaziar();
		else
			throw new Exception('Defina uma Tabela e um crit�rio');
	}
	
}

?>
