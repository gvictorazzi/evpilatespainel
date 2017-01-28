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

    
    public function getProfessorById($idProfessor) {
        $Data = array();
        
        $sqlComando = "SELECT *, professores.id AS idProfessor, city.UF_CODIGO AS idCity FROM professores "
                . "INNER JOIN counties "
                . "INNER JOIN CITY "
                . "ON professores.prof_cidade = counties.ID AND counties.UF_CODIGO = city.UF_CODIGO "
                . " WHERE professores.id= :idProfessor";


        $sql = $this->dbConexao->prepare($sqlComando);
        
        try {
            $sql->bindValue(":idProfessor", $idProfessor);
            $sql->execute();
            if ( $sql->rowCount() > 0 ) {
                $Data = $sql->fetch();
            }
            
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        
        return $Data;
    }
    
    public function add($dataGrava, $modalidades, $contatos, $qualcontato) {
        
        $modalidadeList = implode(",", $modalidades);
        $modalidadeList = addslashes($modalidadeList);
        $numcpf = $this->limparCampo($dataGrava[5]);
        $numrg = $this->limparCampo($dataGrava[6]);
        $numcep = $this->limparCampo($dataGrava[7]);
        
        $extensao = ".png";

        if ( isset($_FILES['foto_prof']['tmp_name'])) {
            if (( $_FILES['foto_prof']['type'] == 'image/jpeg' ) || ($_FILES['foto_prof']['type'] == 'image/jpg')) {
                $extensao = '.jpg';
             }
            $nomeArquivo = md5(time().rand(0,999)).$extensao;
            move_uploaded_file($_FILES['foto_prof']['tmp_name'], 'assets/images/professores/'.$nomeArquivo);
            
        } else {
            $nomeArquivo = '';
        }
        
        
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
                . "prof_cep= :prof_cep,"
                . "prof_foto= :prof_foto,"
                . "prof_modalidade= :prof_modalidade,"
                . "prof_bio= :prof_bio,"
                . "prof_status= :prof_status,"
                . "prof_dtnasc= :prof_dtnasc,"
                . "prof_idade= :prof_idade,"
                . "prof_genero= :prof_genero";
        
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
            $sql->BindValue(":prof_cep", $numcep);
            $sql->BindValue(":prof_foto", $nomeArquivo);
            $sql->bindValue(":prof_modalidade", $modalidadeList);
            $sql->BindValue(":prof_bio", $dataGrava[15]);
            $sql->BindValue(":prof_status", $dataGrava[14]);
            $sql->BindValue(":prof_dtnasc", $dataGrava[17]);
            $sql->BindValue(":prof_idade", $dataGrava[18]);
            $sql->BindValue(":prof_genero", $dataGrava[19]);
            
            $this->dbConexao->beginTransaction();
            $sql->execute();
            $chaveProfessor = $this->dbConexao->lastInsertId();            
            
            $this->dbConexao->commit();
            
            $this->saveContatos($chaveProfessor, $contatos, $qualcontato);
            
        } catch(PDOException $e) {
            $this->dbConexao->rollBack();
            echo $e->getMessage();
            
        }
        
        
    }
    
    
    function saveContatos($chave, $contatos, $qualcontato ) {
        
        $status = '1'; // por padrão o contato está ativo
        
        $sqlComando = "INSERT INTO contatosprofessor SET "
                . "id_professor= :chave,"
                . "id_contato= :contato,"
                . "contato_des= :contato_des,"
                . "tp_status= :status";
        
        $this->dbConexao->beginTransaction();
        $sql = $this->dbConexao->prepare($sqlComando);
        
        try {
            foreach ($contatos as $idContato => $item) {
                
                $sql->bindValue(":chave", $chave);
                $sql->bindValue(":contato", $item);
                $sql->bindValue(":contato_des", $qualcontato[$idContato]);
                $sql->bindValue(":status", $status);
                
                $sql->execute();
            }
            $this->dbConexao->commit();
            
        } catch(PDOException $e) {
            $this->dbConexao->rollBack();
            echo $e->getMessage();
        }
        
    }
    
    
    function limparCampo($campo) {
        $result = $campo;

        $result = str_replace(".", "", $result);
        $result = str_replace("/", "", $result);
        $result = str_replace("-", "", $result);
        
        
        return $result;
        
    }

    
}