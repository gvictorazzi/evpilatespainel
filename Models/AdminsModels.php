<?php

class AdminsModels extends model {

    private $userInfo;
    private $permissions;
    
    public function __construct() {
        parent::__construct();
    }

   
    public function criarUsuarioAdmin($username, $senha) {

        $options = array(
            "cost" => 15,
        );
        $status = 1; // ativo por default
        $email = "gvictorazzi@gmail.com";

        $senhaHash = password_hash($senha, PASSWORD_BCRYPT, $options);
        
        
        $sqlComando = "INSERT INTO usuarios SET "
                . "username= :username,"
                . "email= :email,"
                . "password= :password,"
                . "accessgroup= :accessgroup,"
                . "status= :status";
        
        
        
        $sql = $this->dbConexao->prepare($sqlComando);
        
        try {

            $sql->bindValue(":username", $username);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":password", $senhaHash);
            $sql->bindValue(":accessgroup", 999);
            $sql->bindValue(":status", $status);
            
            $this->dbConexao->beginTransaction();
            $sql->execute();
            
                $idCriado = $this->dbConexao->lastInsertId();
                $_SESSION['adminLogin'] = $idCriado;

            $this->dbConexao->commit();
            
        } catch(PDOException $e ) {
            $this->dbConexao->rollBack();
            echo $e->getMessage();
        }
    
        return $idCriado;

    }


    public function adminIsLog() {
        
        $logado = FALSE;
        
        if (isset($_SESSION['adminLogin']) && !empty($_SESSION['adminLogin'])) {
            $logado = TRUE;
        }

        RETURN $logado;
        
        
    } 

    public function logout() {
        unset($_SESSION['adminLogin']);
    }
    
    public function hasPermission($name) {

        return $this->permissions->hasPermission($name);
    
    }

    public function getUserLogged() {
        if (isset($_SESSION['adminLogin']) && !empty($_SESSION['adminLogin'])) {
            $idUser = $_SESSION['adminLogin'];
            
            $sqlComando = "SELECT * FROM usuarios WHERE id= :id";
            $sql = $this->dbConexao->prepare($sqlComando);
            $sql->bindValue(":id", $idUser );
            $sql->execute();
            
            if ( $sql->rowCount() > 0 ) {
                $this->userInfo = $sql->fetch();
                $this->permissions = new PermissionsModels();
                $this->permissions->setGroup($this->userInfo['accessgroup']);
            }
        
        }
        return $this->userInfo;
        
    }
    
    
    public function getUsuarioAdmin($nomeUsuario, $senha) {
        
        $usuario = 0;
        $senhaInterna = md5($senha);
        $options = array(

            "cost" => 15,

        );
        
        $sqlComando = "SELECT * FROM usuarios WHERE username= :nomeUsuario";
        
        $sql = $this->dbConexao->prepare($sqlComando);
        try {
            $sql->bindValue(":nomeUsuario", $nomeUsuario);
            $sql->execute();
            
            if ( $sql->rowCount() > 0 ) {
                $sqlComando = $sql->fetch();
                $usuario = $sqlComando['id'];

                if (password_verify($senha, $sqlComando['password'])) {
                    return $usuario;
                }
                else {
                    return 0;
                }
            }
            
        } catch(PDOException $e ) {
            echo $e->getMessage();
        }
        
    }
    
}

   function getLogin($email, $senha) {
        
        $usuario = FALSE;

        $sqlComando = "SELECT * FROM users WHERE EMAIL= :email";
        
        $sql = $this->dbConexao->prepare($sqlComando);
        $sql->bindValue(":email", $email);
        $sql->execute();
        
        if ( $sql->rowCount() > 0 ) {
        }
        
        return $usuario;
        
    }