<?php

#doc
#	classname:	Registro
#	scope:		PUBLIC
#
#/doc

/**
 *	Esta classe provê os métodos necessários para persistir e
 *	recuperar objetos da base de dados.
 *	Toda classe que herda Registro deve conter uma constante ENTIDADE
 *	
 */
abstract class Registro{
	/**
	 *	Array contendo os dados do objeto
	 */
	protected $dados;
	
	/**
	 *	Instancia um Registro, se declarado o id
	 *	carrega o objeto
	 *	@param $id = id
	 */
	public function __construct($id = NULL){
		if($id){
			$objeto = $this->carregar($id);
			if($objeto)
				$this->fromArray($objeto->toArray());
		}
	}
	
	/**
	 *	Executado quando o objeto é clonado
	 *	Se o registro for clonado limpa o id
	 */
	public function __clone(){
		unset($this->id);
	}
	
	/**
	 *	Executado quando uma propriedade é atribuída ao objeto
	 *	@param $propriedade = nome da propriedade
	 *	@param $valor = valor da propriedade
	 */
	public function __set($propriedade, $valor){
		// verifica se existe o método set_<nome da propriedade>
		// que sobreescreve esse set
		if(method_exists($this, 'set_'.$propriedade))
			call_user_func(array($this, 'set_'.$propriedade), $valor);
		else{
			if($valor === NULL)
				unset($this->dados[$propriedade]);
			else
				$this->dados[$propriedade] = $valor;
		}
	}
	
	/**
	 *	Executado quando uma propriedade é requerida
	 *	@param $propriedade = nome da propriedade
	 */
	public function __get($propriedade){
		// verifica se existe o método get_<nome da propriedade>
		// que sobreescreve esse get
		if(method_exists($this, 'get_'.$propriedade))
			call_user_func(array($this, 'fet_'.$propriedade));
		else{
			if(isset($this->dados[$propriedade]))
				return $this->dados[$propriedade];
		}
	}
	
	/**
	 *	Retorna a endidade do objeto(tabela)
	 */
	public function get_entidade(){
		$nome_classe = get_class($this);
		return constant("{$nome_classe}::ENTIDADE");
	}
	
	/*
     * Preenche os dados do objeto com um array
     */
    public function fromArray($dados){
        $this->dados = $dados;
    }
    
    /*
     * retorna os dados do objeto como array
     */
    public function toArray(){
        return $this->dados;
    }
    
    /*
     * Armazena o objeto na base de dados e retorna
     * o número de linhas afetadas pela instrução SQL (zero ou um)
     */
    public function armazenar(){
		// PREPARANDO SQL
        // Verifica se tem ID ou se existe na base de dados
		// Se nao existir, insert
        if (empty($this->dados['id']) or (!$this->carregar($this->id))){
            // incrementa o ID
            if (empty($this->dados['id']))
                $this->id = $this->getUltimo() +1;
            // cria uma instrução de insert
            $sql = new Insert($this->get_entidade());
            // percorre os dados do objeto passando os dados pro insert
            foreach ($this->dados as $key => $value)
                $sql->setDados($key, $this->$key);
        }
		// Se ja existir, update
        else{
            // instancia instrução de update
            $sql = new Update($this->get_entidade());
            // cria um critério de seleção baseado no ID
            $criteria = new Criterio();
            $criteria->adicionarExpressao(new Filtro('id', '=', $this->id));
            $sql->setCriterio($criteria);
            // percorre os dados do objeto passando os dados pro update
            foreach ($this->dados as $key => $value){
                if ($key !== 'id'){ // o ID não precisa ir no UPDATE
                    $sql->setDados($key, $this->$key);
                }
            }
        }
		// EXECUTANDO SQL
        // Obtém transação ativa
        if ($conn = Transacao::conexaoAtiva()){
            // faz o log e executa o SQL
            Transacao::log("Armazenando ".get_class($this).": " . $sql->getInstrucao());
            $result = $conn->exec($sql->getInstrucao());
            // retorna o resultado
            return $result;
        }
        else
            throw new Exception('Não há transação ativa!!');
    }
    
    /**
     *	Recupera (retorna) um objeto da base de dados
     *	através de seu ID e instancia ele na memória
     *	@param $id = ID do objeto
     */
    public function carregar($id){
        // instancia instrução de SELECT
        $sql = new Select($this->get_entidade());
        $sql->adicionarColunas('*');
        
        // cria critério de seleção baseado no ID
        $criteria = new Criterio();
        $criteria->adicionarExpressao(new Filtro('id', '=', $id));
        $sql->setCriterio($criteria);
        
        // obtém transação ativa
        if ($conn = Transacao::conexaoAtiva()){
            // cria mensagem de log e executa a consulta
            Transacao::log("Carregando ".get_class($this).": " . $sql->getInstrucao());
            $result= $conn->Query($sql->getInstrucao());
            
            // se retornou algum dado
            if ($result){
                // retorna os dados em forma de objeto
                $objeto = $result->fetchObject(get_class($this));
            }
            return $objeto;
        }
        else
            throw new Exception('Não há transação ativa!!');
    }
    
    /**
     *	Exclui um objeto da base de dados através de seu ID.
     *	@param $id = ID do objeto
     */
    public function excluir($id = NULL){
        // o ID é o parâmetro ou a propriedade ID
        $id = $id ? $id : $this->id;
        
        // instancia uma instrução de DELETE
        $sql = new Delete($this->get_entidade());
        
        // cria critério de seleção de dados
        $criteria = new Criterio;
        $criteria->adicionarExpressao(new Filtro('id', '=', $id));
        $sql->setCriterio($criteria);
        
        // obtém transação ativa
        if ($conn = Transacao::conexaoAtiva()){
            // faz o log e executa o SQL
            Transacao::log("Excluindo ".get_class($this).": " . $sql->getInstrucao());
            $result = $conn->exec($sql->getInstrucao());
            // retorna o resultado
            return $result;
        }
        else
            throw new Exception('Não há transação ativa!!');
    }
    
    /**
     *	Retorna o último ID
     */
    private function getUltimo(){
        // inicia transação
        if ($conn = Transacao::conexaoAtiva()){
            // instancia instrução de SELECT
            $sql = new Select($this->get_entidade());
            $sql->adicionarColunas('max(ID) as ID');
            
            // cria log e executa instrução SQL
            Transacao::log("Ultimo id de ".get_class($this).": " . $sql->getInstrucao());
            $result= $conn->Query($sql->getInstrucao());
            
            // retorna os dados do banco
            $row = $result->fetch();
            return $row[0];
        }
        else
            throw new Exception('Não há transação ativa!!');
    }
}

?>
