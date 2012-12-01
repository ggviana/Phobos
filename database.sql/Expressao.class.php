<?php

#doc
#	classname:	Expressao
#	scope:		PUBLIC
#
#/doc

abstract class Expressao {

	const OPERADOR_AND = 'AND ';
	const OPERADOR_OR = 'OR ';
	
	abstract public function esvaziar();
}

?>
