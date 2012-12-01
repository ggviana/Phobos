<?php

#doc
#	classname:	Colecao
#	scope:		PUBLIC
#
#/doc

final class Colecao{
	/**
	 *	Nome da classe que a Colecao manipula
	 */
	private $classe;
	
	/**
	 *	Instancia um Colecao de objetos
	 *	@param $classe = nome da classe dos objetos
	 */
	public function __construct($classe){
		$this->classe = $classe;
	}
	
	/**
	 *	Carrega os objetos do banco conforme o criterio
	 *	@param $criterio = criterio de selecao dos objetos
	 */
	public function carregar(Criterio $criterio){
		// instancia a instru��o de SELECT
        $sql = new Select(constant($this->classe . '::ENTIDADE'));
        $sql->adicionarColunas('*');
		$sql->setCriterio($criterio);
        
        // obt�m transa��o ativa
        if ($conn = Transacao::conexaoAtiva()){
            // registra mensagem de log
            Transacao::log("Carregando objetos {$this->classe}: " . $sql->getInstrucao());
            
            // executa a consulta no banco de dados
            $result= $conn->Query($sql->getInstrucao());
            $results = array();
            
            if ($result){
                // percorre os resultados da consulta, retornando um objeto
                while ($row = $result->fetchObject($this->classe)){
                    $results[] = $row;
                }
            }
            return $results;
        }
        else
            throw new Exception('N�o h� transa��o ativa!!');
	}
	
	/**
	 *	Exclui os objetos do banco conforme o criterio
	 *	@param $criterio = criterio de exclusao dos objetos
	 */
	public function excluir(Criterio $criterio){
		// instancia instru��o de DELETE
        $sql = new Delete(constant($this->classe . '::ENTIDADE'));
        $sql->setCriterio($criterio);
        
        // obt�m transa��o ativa
        if ($conn = Transacao::conexaoAtiva()){
            // registra mensagem de log
            Transacao::log("Excluindo objetos {$this->classe}: " .$sql->getInstrucao());
            // executa instru��o de DELETE
            $result = $conn->exec($sql->getInstrucao());
            return $result;
        }
        else
            throw new Exception('N�o h� transa��o ativa!!');
	}
	
	/**
	 *	Retorna a quantidade de objetos do banco que satisfazem o criterio
	 *	@param $criterio = criterio de selecao dos objetos
	 */
	public function total(Criterio $criterio){
		// instancia instru��o de SELECT
        $sql = new Select(constant($this->classe . '::ENTIDADE'));
        $sql->adicionarColunas('count(*)');
        $sql->setCriterio($criterio);
        
        // obt�m transa��o ativa
        if ($conn = Transacao::conexaoAtiva()){
            // registra mensagem de log
            Transacao::log("Total de objetos {$this->classe}: " . $sql->getInstrucao());
            
            // executa instru��o de SELECT
            $result= $conn->Query($sql->getInstrucao());
            if ($result){
                $row = $result->fetch();
            }
            // retorna o resultado
            return $row[0];
        }
        else
            throw new Exception('N�o h� transa��o ativa!!');
	}
}

?>
