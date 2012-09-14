<?php

#doc
#	classname:	Conexao
#	scope:		PUBLIC
#
#/doc

final class Conexao{
	
	private function __construct(){}
	
	/**
	 *	Abre uma conexão a partir de um arquivo ini
	 *	@param $aquivo = caminho absoluto para o arquivo de conexão
	 */
	public static function abrir($arquivo){
		if(file_exists($arquivo)){
			$dados = parse_ini_file($arquivo);
			
			$user		= isset($dados['user'])		? $dados['user']	: NULL;
			$pass		= isset($dados['pass'])		? $dados['pass']	: NULL;
			$name		= isset($dados['name'])		? $dados['name']	: NULL;
			$host		= isset($dados['host'])		? $dados['host']	: NULL;
			$type		= isset($dados['type'])		? $dados['type']	: NULL;
			$port		= isset($dados['port'])		? $dados['port']	: NULL;
			
			switch($type){
				//MySQL
				case 'mysql':
					$port = $port ? $port : '3307';
					$conexao = new PDO("mysql:host={$host}; port={$port}; dbname={$name}", $user, $pass);
					break;
				//SQLite
				case 'sqlite':
					$conexao = new PDO("sqlite:{$name}");
					break;
				//MSSQLServer
				case 'mssql':
					$conexao = new PDO("mssql:host={$host},1433; dbname={$name};", $user, $pass);
					break;
				//Oracle
				case 'oci':
					$conexao = new PDO("oci:dbname={$name}", $user, $pass);
					break;
				//Postgre
				case 'pgsql':
					$port = $port ? $port : '5432';
					$conexao = new PDO("pgsql:dbname={$name}; user={$user}; password{$pass}; host={$host}; port={$port}");
					break;
			}
			$conexao->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			return $conexao;
		}
	}	
}

?>
