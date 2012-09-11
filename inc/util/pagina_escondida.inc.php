<?php
/**
 *	Esse script cria uma tag meta que 
 *	esconde a página dos sites de busca
 */
 require('../../widget/Elemento.class.php');
 function hide(){
	$meta			= new Elemento('meta');
 	$meta->name		= 'robots';
	$meta->content	= 'noindex'; 
 	return $meta;
 }
 hide()->imprimir();
?>