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
	 *	Abre uma conexão e uma transação com o banco de dados
	 *	@param $aquivo = caminho absoluto para o arquivo de conexão
	 */
	public static function abrir($arquivo){
		if(empty($conexao)){
			self::$logger	= null;
			self::$conexao	= Conexao::abrir($arquivo);	
			self::$conexao->beginTransaction();
		}
		else throw new Exception('Já há uma conexão Ativa');
	}
	
	/**
	 *	Define um Logger para a Transação
	 */
	 public static function setLogger(Logger $logger){
	 	self::$logger	= $logger;
	 }
	 
	 /**
	  *	Escreve uma mensagem para o Log dessa Transação
	  *	@param $mensagem	= mensagem
	  */
	 public static function log($mensagem){
	 	if(self::$logger)
			self::$logger->escrever($mensagem);
	 }
	
	/**
	 *	Retorna a conexão Ativa
	 */
	public static function conexaoAtiva(){
		return self::$conexao;
	}
	
	/**
	 *	Fecha a Conexão normalmente
	 */
	public static function fechar(){
		self::$conexao->commit();
		self::$conexao	= null;
	}
	
	/**
	 *	Fecha a Conexão desfazendo as alterações
	 */
	public static function desfazer(){
		self::$conexao->rollback();
		self::$conexao	= null;
	}
	
}

?>
