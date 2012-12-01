<?php

	#doc
	#	classname:	Imagem
	#	scope:		PUBLIC
	#
	#/doc
	
	class Imagem extends Elemento{
	
		/**
		 *	Contr�i uma tag de imagem
		 */
		public function __construct ($source){
			parent::__construct('img');
			$this->src			= $source;
			$this->border		= 0;
		}
	}

?>
