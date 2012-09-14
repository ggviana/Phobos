<?php
#doc
#	classname:	Painel
#	scope:		PUBLIC
#
#/doc

class Painel extends Elemento{
	
	/**
	 *  Constroi um painel
	 *	@param	$largura
	 *	@param	$altura
	 */
	 
	function __construct ($largura, $altura, CSS $estilo = null){
		
		// Se o estilo não for incluido, cria um padrão
		if(!$estilo){
			$estilo_padrao = new CSS('padrao');
			$estilo_padrao->position			= 'relative';
			$estilo_padrao->width				= $largura;
			$estilo_padrao->height				= $altura;
			$estilo_padrao->border				= '2px solid';
			$estilo_padrao->border_color		= 'grey';
			$estilo_padrao->background_color	= '#f0f0f0';
			$estilo_padrao->imprimir();
		}
		
		// Cria o painel
		parent::__construct('div');
		$this->class = 'painel';
	}

	/**
	 *  Posiciona um objeto no painel
	 *	@param	$objeto
	 *	@param	$coluna
	 *	@param	$fileira
	 */
	
	public function posicionar($objeto, $coluna, $fileira){
		// Cria uma nova camada para o objeto
		$camada = new Elemento('div');
		$camada->style		= "position:absolute; left:{$coluna}px; top:{$fileira}px;";
		$camada->adicionar($objeto);
		// Adiciona a camada ao painel
		parent::adicionar($camada);
		
	}
}
?>
