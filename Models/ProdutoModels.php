<?php

class ProdutoModels extends model {
    
    public function __construct() {
        parent::__construct();
    }

    public function getProdutosByIdCategoria($idCategoria, $quantidade = FALSE) {

        if ( $quantidade === FALSE ) {
            $dados = array();
        }
        else {
            $dados = 0;
        }
        
        $sqlComando = "SELECT * FROM produtos WHERE id_categoria='$idCategoria'";
        $sqlComando = $this->dbConexao->query($sqlComando);
        if ( $sqlComando->rowCount() > 0 ) {
            if ( $quantidade === TRUE )
                $dados = $sqlComando->rowCount();
            else {
                $dados = $sqlComando->fetchAll();
            }
        }
        
        return $dados;
        
    }

    public function getProdutosById($idProduto) {

        $dados = array();
        
        $sqlComando = "SELECT * FROM produtos WHERE id='$idProduto'";
        $sqlComando = $this->dbConexao->query($sqlComando);
        if ( $sqlComando->rowCount() > 0 ) {
            $dados = $sqlComando->fetch();
        }
        
        return $dados;
        
    }


    
    public function getProdutos($offset, $limite) {

        $dados = array();
        
        $sqlComando = "SELECT *, (SELECT categorias.titulo FROM categorias"
                . " where categorias.id=produtos.id_categoria) as categoria  FROM produtos"
                . " LIMIT $offset,$limite";
        $sqlComando = $this->dbConexao->query($sqlComando);
        if ( $sqlComando->rowCount() > 0 ) {
            $dados = $sqlComando->fetchAll();
        }
        return $dados;
        
    }

    public function getTotalProdutos() {
        
        $quantidade = 0;
        
        $sqlComando = "SELECT COUNT(*) AS c FROM produtos";
        $sqlComando = $this->dbConexao->query($sqlComando);
        
        if ( $sqlComando->rowCount() > 0 ) {
            $quantidade = $sqlComando->fetch();
            $quantidade = $quantidade['c'];
        }

        return $quantidade;
        
    }
    
    public function inserirProdutos($produto, $descricao, $categoria, $preco, $quantidade, $md5Imagem) {
        
        
        $sqlComando = "INSERT INTO produtos SET id_categoria='$categoria', nome='$produto', imagem='$md5Imagem',"
                . " preco='$preco', quantidade='$quantidade', descricao='$descricao' ";
        
        $sqlComando = $this->dbConexao->query($sqlComando);


        
    }
    

    public function AtualizaProdutos($idProduto, $produto, $descricao, $categoria, $preco, $quantidade) {
        
        
        $sqlComando = "UPDATE produtos SET id_categoria='$categoria', nome='$produto',"
                . " preco='$preco', quantidade='$quantidade', descricao='$descricao' WHERE id='$idProduto' ";
        
        $sqlComando = $this->dbConexao->query($sqlComando);


        
    }
    
    
    public function atualizaImagem($idProduto, $imagem) {
        
        $sqlComando = "UPDATE produtos SET imagem='$md5Imagem WHERE id='$idProduto' ";
        $sqlComando = $this->dbConexao->query($sqlComando);
        
    }

    
    
}