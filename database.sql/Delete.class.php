<?php

#doc
#	classname:	Delete
#	scope:		PUBLIC
#
#/doc

final class Delete extends InstrucaoSQL{

	
	
	/**
	 *	Constrói uma Instrução DELETE
	 *	@param $entidade = entidade afetada pela instrução
	 */
	public function __construct($entidade = NULL){
		if($entidade)
			parent::setEntidade($entidade);
	}
	
	
	/**
	 *	Monta a instrução Delete
	 */
	public function getInstrucao(){
		if($this->getEntidade() and $this->criterio)
			return $sql = "DELETE FROM " . $this->getEntidade() . " WHERE " . $this->criterio->esvaziar();
		else
			throw new Exception('Defina uma Tabela e um critério');
	}
	
}

?>
