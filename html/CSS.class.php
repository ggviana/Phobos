<?php

#doc
#	classname:	Style
#	scope:		PUBLIC
#
#/doc

class CSS {

	private $nome;
	private $propriedades;
	static private $carregado;
	
	#	Constructor
	function __construct ($nome){
		$this->nome = $nome;
	}

	public function __set($nome, $valor){
		$nome = str_replace('_','-',$nome);
		$this->propriedades[$nome] = $valor;
	}

	public function imprimir(){
		// Se não foi carregado
		if (!isset(self::$carregado[$this->nome])){
			echo "<style type='text/css' media='screen'>\n.{$this->nome}\n{\n";
			if($this->propriedades)
				foreach ($this->propriedades as $nome => $valor)
					echo "\t {$nome}: {$valor};\n";
			echo "}\n</style>\n";
			self::$carregado[$this->nome] = true;
		}
	}
	
}

?>
