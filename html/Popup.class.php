<?php
#doc
#	classname:	Popup
#	scope:		PUBLIC
#
#/doc

class Popup extends Elemento{

	private $posx;
	private $posy;
	private $largura;
	private $altura;
	private $titulo;
	private $conteudos;
	static private $contador;
	
	/**
	 *	Constrói uma janela de Popup
	 *	@param $titulo		= titulo da Popup
	 */
	function __construct ($titulo){
		self::$contador ++;
		$this->titulo		= $titulo;
	}

	/**
	 *	Ajusta a posição do Popup
	 *	@param $x		= posição vertical
	 *	@param $y		= posição horizontal
	 */
	public function setPosicao($x, $y){
		$this->posx		= $x;
		$this->posy		= $y;
	}
	
	/**
	 *	Ajusta o tamanho do Popup
	 *	@param $largura		= largura do Popup
	 *	@param $altura		= altura do Popup
	 */
	public function setTamanho($largura, $altura){
		$this->largura		= $largura;
		$this->altura		= $altura;
	}
	
	/**
	 *	Adiciona conteúdo ao Popup
	 *	@param $conteudo	= conteúdo a ser adicionado
	 */
	public function setAlign($conteudo){
		$this->conteudos	= $conteudo;
	}
	
	/**
	 *	Imprime o Popup
	 */
	public function imprimir(){
		$popup_id				= 'Popup'.self::$contador;
		// Definindo o CSS do Popup
		$estilo					= new CSS($popup_id);
		$estilo->position		= 'absolute';
		$estilo->left			= $this->x;
		$estilo->top			= $this->y;
		$estilo->width			= $this->largura;
		$estilo->height			= $this->altura;
		$estilo->background		= '#e0e0e0';
		$estilo->border			= '1px solid #000000';
		$estilo->z_index		= '10000';
		$estilo->imprimir();
		// Criando a janela dentro de uma div
		
		
	}
}
?>
