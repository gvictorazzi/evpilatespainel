<?php

class EmpresaModels extends model {

    private $infoCompany;
    
    public function __construct() {
        parent::__construct();
    }

    public function getAllEmpresas($offset = 0, $limite = 10) {

        $dados = array();
        
        $sqlComando = "SELECT * FROM empresa "
                . " LIMIT $offset,$limite";
        
        $sql = $this->dbConexao->prepare($sqlComando);
        
        try {
            $sql->execute();
            
            if ( $sql->rowCount() > 0 ) {
                $dados = $sql->fetchAll();
            }
            
        } catch(PDOException $e ) {
            echo $e->getMessage();
        }
        return $dados;
        
    }

    public function getTotalEmpresas() {
        
        $quantidade = 0;
        
        $sqlComando = "SELECT COUNT(*) AS c FROM empresa";
        
        $sql = $this->dbConexao->prepare($sqlComando);
        
        try {
            $sql->execute();
            if ( $sql->rowCount() > 0 ) {
                $quantidade = $sql->fetch();
                $quantidade = $quantidade['c'];
            }
            
        } catch(PDOException $e ) {
            echo $e->getMessage();
        }

        return $quantidade;
        
    }
    
    public function getEmpresa() {
        
        $idCompany = 1; // valor fixo temporário

        $sqlComando = "SELECT * FROM empresa WHERE id= :idc";
        $sql = $this->dbConexao->prepare($sqlComando);
        $sql->bindValue(":idc", $idCompany);
        $sql->execute();
        
        if ( $sql->rowCount() > 0 ) {
            $this->infoCompany = $sql->fetch();
        }
        
        return $this->infoCompany;
    }
        
    
}