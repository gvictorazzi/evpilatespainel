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

    
    public function add($dataGrava, $modalidades) {
        
        $modalidadeList = implode(",", $modalidades);
        $modalidadeList = addslashes($modalidadeList);
        $numcpf = limparCampo($dataGrava[5]);
        $numrg = limparCampo($dataGrava[6]);
        
        $extensao = ".png";
       
        if (( $_FILES['foto_prof']['type'] == 'image/jpeg' ) || ($_FILES['foto_prof']['type'] == 'image/jpg')) {
            $extensao = '.jpg';
         }
        $nomeArquivo = md5(time().rand(0,999)).$extensao;
        move_uploaded_file($_FILES['foto_prof']['tmp_name'], 'assets/images/professores/'.$nomeArquivo);
        
        
        $sqlComando = "INSERT INTO professores SET "
                . "prof_nome= :prof_nome,"
                . "prof_apelido= :prof_apelido,"
                . "prof_email= :prof_email,"
                . "prof_tel= :prof_tel,"
                . "prof_cel= :prof_cel,"
                . "prof_cpf= :prof_cpf,"
                . "prof_rg= :prof_rg,"
                . "prof_end= :prof_end,"
                . "prof_num= :prof_num,"
                . "prof_compl= :prof_compl,"
                . "prof_bairro= :prof_bairro,"
                . "prof_cidade= :prof_cidade,"
                . "prof_uf= :prof_uf,"
                . "prof_cep= :prof_cep,"
                . "prof_foto= :prof_foto,"
                . "prof_modalidade= :prof_modalidade,"
                . "prof_bio= :prof_bio,"
                . "prof_status= :prof_status";
        
        $sql = $this->dbConexao->prepare($sqlComando);
        
        try {
            $sql->BindValue(":prof_nome", $dataGrava[0]);
            $sql->BindValue(":prof_apelido", $dataGrava[1]);
            $sql->BindValue(":prof_email", $dataGrava[2]);
            $sql->BindValue(":prof_tel", $dataGrava[3]);
            $sql->BindValue(":prof_cel", $dataGrava[4]);
            $sql->BindValue(":prof_cpf", $numcpf);
            $sql->BindValue(":prof_rg", $numrg);
            $sql->BindValue(":prof_end", $dataGrava[8]);
            $sql->BindValue(":prof_num", $dataGrava[9]);
            $sql->BindValue(":prof_compl", $dataGrava[10]);
            $sql->BindValue(":prof_bairro", $dataGrava[11]);
            $sql->BindValue(":prof_cidade", $dataGrava[13]);
            $sql->BindValue(":prof_uf", $dataGrava[12]);
            $sql->BindValue(":prof_cep", $dataGrava[7]);
            $sql->BindValue(":prof_foto", $nomeArquivo);
            $sql->bindValue(":prof_modalidade", $modalidadeList);
            $sql->BindValue(":prof_bio", $dataGrava[15]);
            $sql->BindValue(":prof_status", $dataGrava[14]);
            
            $this->dbConexao->beginTransaction();
            $sql->execute();
            $this->dbConexao->commit();
            
        } catch(PDOException $e) {
            $this->dbConexao->rollBack();
            echo $e->getMessage();
            
        }
        
        
    }
    
    function limparCampo($campo) {
        $result = '';
        
        $result = str_replace(".", "", $campo);
        $result = str_replace("/", "", $campo);
        $result = str_replace("-", "", $campo);
        
        return $result;
        
    }

    
}