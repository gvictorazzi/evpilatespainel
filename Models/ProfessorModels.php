<?php

class ProfessorModels extends model {

    
    public function __construct() {
        parent::__construct();
    }

 
    public function getAllProfessores() {
        
        $Data = array();
        
        $sqlComando = "SELECT *, professores.id AS idProf FROM professores";
        
        $sql = $this->dbConexao->prepare($sqlComando);
        
        try {
            $sql->execute();
            if ( $sql->rowCount() > 0 ) {
                $Data = $sql->fetchAll();
            }
            
        } catch(PDOException $e ) {
            
            echo $e->getMessage();
        }
        
        return $Data;
        
    }


    
    public function getTotalProfessores() {
        
        $totalProfessores = 0;
        $sqlComando = "SELECT COUNT(*) AS C FROM professores";
        
        $sql = $this->dbConexao->prepare($sqlComando);
        try {
            $sql->execute();
            $tempo = $sql->fetch();
            $totalProfessores = $tempo['C'];
            
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        
        return $totalProfessores;
    }

    
    

    
}