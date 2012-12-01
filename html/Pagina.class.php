<?php
#doc
#	classname:	Pagina
#	scope:		PUBLIC
#
#/doc
include_once('Elemento.class.php');
class Pagina extends Elemento{

	public $head;
	
	/**
	 * Cria uma página
	 * @param $titulo = Titulo da página
	 */
	function __construct ($titulo){
		parent::__construct('html');
		
		// Charset
		$meta 			 = new Elemento('meta');
		$meta->http_equiv='Content_Type';
		$meta->content	 ='text/html';
		$meta->charset	 ='UTF-8';
		// Titulo
		$title 			 = new Elemento('title');
		$title->adicionar($titulo);
		// Head
		$head 			 = new Elemento('head');
		$head->adicionar($meta);
		$head->adicionar($title);
		
		parent::adicionar($head);
		
	}

	/**
	 * imprimir()
	 * Imprime o conteúdo da página
	 */
	
	public function imprimir(){
		$this->run();
		parent::imprimir();
	}

	/**
	 *  Chama as funções dadas na url
	 */
	
	public function run(){
		// Se a url tiver conteúdo
		if($_GET){
			// Se houver variavel class na url $class recebe seu valor
			$class 		 = isset($_GET['class']) ? $_GET['class'] : NULL;
			// Se houver variavel method na url $method recebe seu valor
			$method		 = isset($_GET['method']) ? $_GET['method'] : NULL;
			// Se $class não for nula
			if($class){				
				$object  = ($class == get_class($this)) ? $this : new $class;
				if(method_exists($object,$method)){
					call_user_func(array($object,$method),$_GET);
				}
			}
			// Se $method não for nula
			else if (function_exists($method)){
				call_user_func($method,$_GET);
			}
		}
	}
}
?>
