<?php

#doc
#	classname:	InstrucaoSQL
#	scope:		PUBLIC
#
#/doc

abstract class InstrucaoSQL{

	protected $criterio;
	private $entidade;
	
	/**
	 *	Define a entidade(tabela) afetada por essa Instrução SQL
	 *	@param $entidade = entidade
	 *	
	 */
	public function setEntidade($entidade){
		$this->entidade = $entidade;
	}
	
	/**
	 *	Retorna a entidade(tabela) afetada por essa Instrução SQL
	 */
	public function getEntidade(){
		return $this->entidade;
	}
	
	/**
	 *	Define um Critério para essa Instrução
	 *	@param $criterio = criterio
	 */
	public function setCriterio(Criterio $criterio){
		$this->criterio = $criterio;
	}
	
	/**
	 *	Retorna essa Instrução SQL
	 */
	abstract function getInstrucao();
}

?>
