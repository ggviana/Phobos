<?php
/**
 *	Esse script cria uma tag meta que 
 *	define a codificação do documento
 */
 require('../../widget/Elemento.class.php');
 function charset($charset = 'utf8'){
 	$meta				= new Elemento('meta');
 	$meta->http_equiv	='Content-Type';
 	$meta->content		='text/html';
	switch($charset){
		case 'utf8':
		$meta->charset	='UTF-8';break;
		case 'ascii':
		$meta->charset	='ISO-8859-1';break;
	}
	return $meta;
 }
?>