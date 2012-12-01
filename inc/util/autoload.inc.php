<?php
/**
 * Função para carregar as classes necessárias
 * @param $classe = nome da classe a ser carregada
 * @author Guilherme Guimarães Viana (ggviana@hotmail.com.br)
 */
function __autoload($classe){
	foreach(glob("*") as $arquivo){
		if(file_exists($include = "{$classe}.class.php")){
			require($include);
			break;
		}
		else if(is_dir($arquivo)){
			if(file_exists($include = "{$arquivo}/{$classe}.class.php"))
				require($include);
		}
	}
}
?>
