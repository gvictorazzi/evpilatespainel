<?php

class ModalidadeModels extends model {

    
    public function __construct() {
        parent::__construct();
    }

 
    public function getAllModalidades() {
        
        $Data = array();
        
        $sqlComando = "SELECT * FROM modalidades";
        
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


    
    public function getTotalModalidades() {
        
        $totalModalidades = 0;
        $sqlComando = "SELECT COUNT(*) AS C FROM modalidades";
        
        $sql = $this->dbConexao->prepare($sqlComando);
        try {
            $sql->execute();
            $tempo = $sql->fetch();
            $totalModalidades = $tempo['C'];
            
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        
        return $totalModalidades;
    }

    
    public function addModalidade($dataGrava) {
        
        $extensao = '.png';

        
        if (( $_FILES['modal_foto']['type'] == 'image/jpeg' ) || ($_FILES['modal_foto']['type'] == 'image/jpg')) {
            $extensao = '.jpg';
         }
        $nomeArquivo = md5(time().rand(0,999)).$extensao;
        move_uploaded_file($_FILES['modal_foto']['tmp_name'], 'assets/images/galeria/'.$nomeArquivo);
                
                
        $sqlComando = "INSERT INTO modalidades SET "
                . "modalidade= :modalidade,"
                . "modal_descri= :modal_descri,"
                . "modal_foto= :modal_foto,"
                . "modal_letraid= :modal_letraid,"
                . "modal_status= :modal_status";
        
        $sql = $this->dbConexao->prepare($sqlComando);
        
        try {
            $sql->bindValue(":modalidade", $dataGrava[0]);
            $sql->bindValue(":modal_descri", $dataGrava[1]);
            $sql->bindValue(":modal_letraid", $dataGrava[2]);
            $sql->bindValue(":modal_status", $dataGrava[4]);
            $sql->bindValue(":modal_foto", $nomeArquivo);
            
            $this->dbConexao->beginTransaction();
            $sql->execute();
            $this->dbConexao->commit();
            
            
        } catch(PDOException $e) {
            $this->dbConexao->rollBack();
            echo $e->getMessage();
        }
        
        
        
    }


    public function updateModalidade($idModal, $dataGrava) {
        
        $extensao = '.png';
        $nomeArquivo = '';

        
        if ( isset($_FILES['arquivo']) && !empty($_FILES['arquivo']['tmp_name']) ) {
            if (( $_FILES['modal_foto']['type'] == 'image/jpeg' ) || ($_FILES['modal_foto']['type'] == 'image/jpg')) {
                $extensao = '.jpg';
             }
            $nomeArquivo = md5(time().rand(0,999)).$extensao;
            move_uploaded_file($_FILES['modal_foto']['tmp_name'], 'assets/images/galeria/'.$nomeArquivo);
        }        
                
                
        $sqlComando = "UPDATE modalidades SET "
                . "modalidade= :modalidade,"
                . "modal_descri= :modal_descri,"
                . "modal_letraid= :modal_letraid,"
                . "modal_status= :modal_status";

        
        if ( !empty($nomeArquivo) ) {
            $sqlComando .= ",modal_foto= :modal_foto";
        }
        $sqlComando .= " WHERE id= :idModal";

        
        $sql = $this->dbConexao->prepare($sqlComando);
        
        try {
            $sql->bindValue(":idModal", $idModal);
            $sql->bindValue(":modalidade", $dataGrava[0]);
            $sql->bindValue(":modal_descri", $dataGrava[1]);
            $sql->bindValue(":modal_letraid", $dataGrava[2]);
            $sql->bindValue(":modal_status", $dataGrava[4]);
            if ( !empty($nomeArquivo ) ) {
                $sql->bindValue(":modal_foto", $nomeArquivo);
            }
            
            $this->dbConexao->beginTransaction();
            $sql->execute();
            $this->dbConexao->commit();
            
            
        } catch(PDOException $e) {
            $this->dbConexao->rollBack();
            echo $e->getMessage();
        }
        
        
        
    }

    
    public function getModalidadeById($idModal) {
        
        $Data = array();
        
        $sqlComando = "SELECT * FROM modalidades WHERE id= :idModal";
        
        $sql = $this->dbConexao->prepare($sqlComando);
        
        try {
            $sql->bindValue(":idModal", $idModal);
            $sql->execute();
            if ( $sql->rowCount() > 0 ) {
                $Data = $sql->fetch();
            }
            
        } catch(PDOException $e ) {
            
            echo $e->getMessage();
        }
        
        return $Data;
        
    }

    
    
    
}

