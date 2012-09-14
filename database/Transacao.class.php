<?php

#doc
#	classname:	Transacao
#	scope:		PUBLIC
#
#/doc

final class Transacao{
	
	private static $logger;
	private static $conexao;
	
	private function __construct(){}
	
	/**
	 *	Abre uma conex�o e uma transa��o com o banco de dados
	 *	@param $aquivo = caminho absoluto para o arquivo de conex�o
	 */
	public static function abrir($arquivo){
		if(empty($conexao)){
			self::$logger	= null;
			self::$conexao	= Conexao::abrir($arquivo);	
			self::$conexao->beginTransaction();
		}
		else throw new Exception('J� h� uma conex�o Ativa');
	}
	
	/**
	 *	Define um Logger para a Transa��o
	 */
	 public static function setLogger(Logger $logger){
	 	self::$logger	= $logger;
	 }
	 
	 /**
	  *	Escreve uma mensagem para o Log dessa Transa��o
	  *	@param $mensagem	= mensagem
	  */
	 public static function log($mensagem){
	 	if(self::$logger)
			self::$logger->escrever($mensagem);
	 }
	
	/**
	 *	Retorna a conex�o Ativa
	 */
	public static function conexaoAtiva(){
		return self::$conexao;
	}
	
	/**
	 *	Fecha a Conex�o normalmente
	 */
	public static function fechar(){
		self::$conexao->commit();
		self::$conexao	= null;
	}
	
	/**
	 *	Fecha a Conex�o desfazendo as altera��es
	 */
	public static function desfazer(){
		self::$conexao->rollback();
		self::$conexao	= null;
	}
	
}

?>
