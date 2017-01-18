<?php

class CitiesModels extends model {
    
    
    public function __construct() {
        parent::__construct();
    }
    


    public function citiesList( $offset = 0, $limit = true ) {
        
        $data = array();
        
        if ( $limit ) {
            $sqlComando = "SELECT * FROM city ORDER BY UF_NOME LIMIT $offset, 10";
        } else {
            $sqlComando = "SELECT * FROM city ORDER BY UF_NOME";
        }
        $sql = $this->dbConexao->prepare($sqlComando);
        //$sql->bindValue(":offset", $offset);
        $sql->execute();
        
        if ( $sql->rowCount() > 0 ) {
            $data = $sql->fetchAll();
        }
         
        return $data;
                
                
    }

    public function getCitiesCount() {
        
        $clientCount = 0;
        
        $sqlComando = "SELECT COUNT(*) AS C FROM city" ;
        $sql = $this->dbConexao->prepare($sqlComando);
        $sql->execute();
        $row = $sql->fetch();
        
        $clientCount = $row['C'];
         
        return $clientCount;
                
                
    }
}
