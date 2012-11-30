<?php

#doc
#	classname:	Select
#	scope:		PUBLIC
#
#/doc

final class Select extends InstrucaoSQL{

	private $colunas;
	
	/**
	 *	Constr�i uma Instru��o SELECT
	 *	@param $entidade = entidade afetada pela instru��o
	 */
	public function __construct($entidade = NULL){
		if($entidade)
			parent::setEntidade($entidade);
	}
	
	/**
	 *	Define as colunas afetadas por essa Instru��o SQL
	 *	@param $colunas
	 */
	public function adicionarColunas($colunas){
		if(is_array($colunas)){
			$this->colunas = $colunas;
		}
		else if(is_string($colunas)){
			$this->colunas[] = $colunas;
		}
	}
	
	/**
	 *	Monta a instru��o Select
	 */
	public function getInstrucao(){
		if($this->getEntidade()){
			$criterios = $this->criterio ? ' WHERE ' . $this->criterio->esvaziar() : '';
			return 'SELECT ' . implode(', ',$this->colunas) . ' FROM ' . $this->getEntidade() .	$criterios;
		}
		else
			throw new Exception('Defina uma tabela');
	}
	
}

?>
