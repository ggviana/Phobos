<?php
/**
 *	Esse script cria uma tag meta que 
 *	redireciona para uma url em um determindo tempo
 */
 require('../../widget/Elemento.class.php');
 function redirecionar($tempo, $url){
 	$meta				= new Elemento('meta');
 	$meta->http_equiv	='refresh';
 	$meta->content		="{$tempo}" . ";url={$url}";
	return $meta;
 }
?>