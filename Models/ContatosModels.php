<?php

class ContatosModels extends model {
    
    
    public function __construct() {
        parent::__construct();
    }
    


    public function contatosList( $offset = 0, $limit = true ) {
        
        $data = array();
        
        if ( $limit ) {
            $sqlComando = "SELECT * FROM contatos ORDER BY contato_tipo LIMIT $offset, 10";
        } else {
            $sqlComando = "SELECT * FROM contatos ORDER BY contato_tipo";
        }
        $sql = $this->dbConexao->prepare($sqlComando);
        $sql->execute();
        
        if ( $sql->rowCount() > 0 ) {
            $data = $sql->fetchAll();
        }
         
        return $data;
                
                
    }

    public function getContatosCount() {
        
        $contatosCount = 0;
        
        $sqlComando = "SELECT COUNT(*) AS C FROM contatos" ;
        $sql = $this->dbConexao->prepare($sqlComando);
        $sql->execute();
        $row = $sql->fetch();
        
        $contatosCount = $row['C'];
         
        return $contatosCount;
                
                
    }
    
    
    public function save( $contato, $linkicone, $status ) {
        
        $extensao = '.png';

        
        if (( $_FILES['link_icone']['type'] == 'image/jpeg' ) || ($_FILES['link_icone']['type'] == 'image/jpg')) {
            $extensao = '.jpg';
         }
        $nomeArquivo = md5(time().rand(0,999)).$extensao;
        move_uploaded_file($_FILES['link_icone']['tmp_name'], 'assets/images/cadastros/'.$nomeArquivo);

        $sqlComando = "INSERT INTO contatos SET "
                . "contato_tipo= :tipo,"
                . "link_icone= :linkicone,"
                . "contato_status= :status";
        
        $this->dbConexao->beginTransaction();
        
        $sql = $this->dbConexao->prepare($sqlComando);
        
        try {
            $sql->bindValue(":tipo", $contato);
            $sql->bindValue(":linkicone", $nomeArquivo);
            $sql->bindValue(":status", $status);
            
            $sql->execute();
            $this->dbConexao->commit();
            
        } catch(PDOException $e) {
            $this->dbConexao->rollBack();
            echo $e->getMessage();
            
        }
        
        
        
    }
}
