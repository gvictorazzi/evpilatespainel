<?php

class VendasModels extends model {
    
    public function __construct() {
        parent::__construct();
    }

    
    public function getVendas($offset = 0, $limite = 0) {

        $dados = array();
        
        $sqlComando = "SELECT vendas.id,
            usuarios.nome as cliente,
            vendas.valor,
            pagamentos.nome as tppagto,
            vendas.statuspagto
            FROM vendas
            LEFT JOIN usuarios on usuarios.id = vendas.id_usuario
            LEFT JOIN pagamentos on pagamentos.id = vendas.forma_pg";
        
        if ($limite > 0 ) {
            $sqlComando .= " LIMIT $offset,$limite";   
        }
        
        $sqlComando = $this->dbConexao->query($sqlComando);
        if ( $sqlComando->rowCount() > 0 ) {
            $dados = $sqlComando->fetchAll();
        }
        return $dados;
        
    }

    public function getTotalVendas() {

        $quantidade = 0;
        
        $sqlComando = "SELECT COUNT(*) AS c FROM vendas";
        $sqlComando = $this->dbConexao->query($sqlComando);
        
        if ( $sqlComando->rowCount() > 0 ) {
            $quantidade = $sqlComando->fetch();
            $quantidade = $quantidade['c'];
        }

        return $quantidade;
           
    }

    public function getVendasById($idVendas) {

        $dados = array();
        
        $sqlComando = "SELECT * FROM vendas WHERE id='$idVendas'";
        
        $sqlComando = $this->dbConexao->query($sqlComando);
        if ( $sqlComando->rowCount() > 0 ) {
            $dados = $sqlComando->fetch();
        }
        return $dados;
        
    }


    
}