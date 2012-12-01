<?php

#doc
#	classname:	TabelaListagem
#	scope:		PUBLIC
#
#/doc

class TabelaListagem extends Tabela{

	private $colunas;
	private $acoes;
	private $num_linhas;
	
	/**
	 *	Instancia uma nova Tabela de Listagem
	 */
	public function __construct(){
		parent::__construct();
		$this->class = 'tabela_listagem';
	}
	
	/**
	 *	Adiciona um coluna na tabela
	 *	@param $coluna = objeto ColunaListagem
	 */
	public function adicionarColuna(ColunaListagem $coluna){
		$this->$colunas[] = $coluna
	}

	/**
	 *	Cria o cabeçalho e a estrutura da Tabela
	 */
	public function criarCabecalho(){
		$linha = parent::adicionarLinha();
		if($acoes){
			foreach($this->acoes as $acao){
				$celula = $linha->adicionarCelula('');
				$celula->class = 'list_head_col';
			}
		}
		if($colunas){
			foreach($this->colunas as $coluna){
				$celula = $linha->adicionarCelula($coluna->getRotulo());
				$celula->class = 'list_head_col';
				$url = $coluna->getAcao();
				if($url){
					$celula->onmouseover= "this.className='list_head_col_over';";
					$celula->onmouseout	= "this.className='list_head_col';";
					$celula->onclick	= "document.location='{$url}'";
				}
			}
		}
	}
	
	/**
	 *	Adiciona uma objeto na tabela na forma de linha
	 *	@param $objeto = objeto que contenha dados
	 */
	public function adicionarLinha($objeto){
		$linha = parent::adicionarLinha();
		if($acoes){
			foreach($this->acoes as $acao){
				$url    = $acao->serializar();
				$rotulo = $acao->getRotulo();
				$imagem = $acao->getImagem();
				$coluna = $acao->getColuna();
				$key	= $objeto->$coluna;
				
				$link = new Elemento('a');
				$link->href="{$url}&key={$key}";
				if($imagem){
					$imagem = new Imagem($imagem);
					$link->adicionar($imagem);
				}
				elseif($rotulo)
					$link->adicionar($rotulo);
				$linha->adicionarCelula($link);
			}
		}
		if($colunas){
			foreach($this->colunas as $coluna){
				$nome = $coluna->getNome();
				$rotulo = $coluna->getRotulo();
				$formatacao = $coluna->getFormatacao();
				$dado = $objeto->$nome;
				if($formatacao)
					call_user_func($formatacao, $dado);
				$linha->adicionarCelula($dado);
			}
		}
		$this->num_linhas ++;
	}
	
	/**
	 *	Adiciona uma Ação a essa tabela
	 *	@param $acao = objeto AcaoListagem
	 */
	public function adicionarAcao(AcaoListagem $acao){
		$this->acoes[] = $acao;
	}
	
	/**
	 *	Exclui todas as linhas
	 */
	public function limpar(){
		$cabecalho = $this->linhas[0];
		$this->filhos = new array();
		$this->filhos[] = $cabecalho;
		$this->num_linhas = 0;
	}
	

	
}

?>
