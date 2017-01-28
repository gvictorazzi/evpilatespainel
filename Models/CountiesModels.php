<?php

class CountiesModels extends model {
    
    
    public function __construct() {
        parent::__construct();
    }
    


    public function countiesList( $offset = 0, $limit = true ) {
        
        $data = array();
        
        if ( $limit ) {
            $sqlComando = "SELECT *, counties.UF_CODIGO AS UFC, city.SIGLA_UF, city.UF_NOME, city.UF_REGIAO, "
                    . "city.UF_BANDEIRA"
                    . " FROM counties "
                    . "INNER JOIN city "
                    . "ON counties.UF_CODIGO=city.UF_CODIGO "
                    . "ORDER BY counties.MUN_NOME ASC"
                    . " LIMIT $offset, 10";
            
        } else {
            $sqlComando = "SELECT *, counties.UF_CODIGO AS UFC, city.SIGLA_UF, city.UF_NOME, city.UF_REGIAO, "
                    . "city.UF_BANDEIRA"
                    . " FROM counties "
                    . "INNER JOIN city "
                    . "ON counties.UF_CODIGO=city.UF_CODIGO "
                    . "ORDER BY counties.MUN_NOME ASC";
        }
        $sql = $this->dbConexao->prepare($sqlComando);
        //$sql->bindValue(":offset", $offset);
        $sql->execute();
        
        if ( $sql->rowCount() > 0 ) {
            $data = $sql->fetchAll();
        }
         
        return $data;
                
                
    }


    public function countiesListByState( $idState) {
        
        $data = array();
        
        $sqlComando = "SELECT * FROM counties "
                . "WHERE UF_CODIGO= :idState "
                . "ORDER BY counties.MUN_NOME ASC";

        $sql = $this->dbConexao->prepare($sqlComando);
        
        $sql->bindValue(":idState", $idState);
        $sql->execute();
        
        if ( $sql->rowCount() > 0 ) {
            $data = $sql->fetchAll();
        }
         
        return $data;
                
                
    }




    public function getCountiesCount() {
        
        $totCount = 0;
        
        $sqlComando = "SELECT COUNT(*) AS C FROM counties" ;
        $sql = $this->dbConexao->prepare($sqlComando);
        $sql->execute();
        $row = $sql->fetch();
        
        $totCount = $row['C'];
         
        return $totCount;
                
                
    }
}
