<?php

class UsuariosModels extends model {

    private $userInfo;
    private $permissions;
    
    public function __construct() {
        parent::__construct();
    }

 
    public function getAllUsuarios() {
        
        $Data = array();
        
        $sqlComando = "SELECT *, usuarios.id AS idUsuario , permissiongroups.NAME  FROM usuarios "
                . "INNER JOIN permissiongroups "
                . "ON usuarios.accessgroup=permissiongroups.ID";
        
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


    public function getUsuariosById($idUsuario) {
        
        $Data = array();
        
        $sqlComando = "SELECT *, usuarios.id AS idUsuario , permissiongroups.NAME  FROM usuarios "
                . "INNER JOIN permissiongroups "
                . "ON usuarios.accessgroup=permissiongroups.ID "
                . "WHERE usuarios.id= :idUsuario";
        
        $sql = $this->dbConexao->prepare($sqlComando);
        
        try {
            $sql->bindValue(":idUsuario", $idUsuario);
            $sql->execute();
            if ( $sql->rowCount() > 0 ) {
                $Data = $sql->fetch();
            }
            
        } catch(PDOException $e ) {
            
            echo $e->getMessage();
        }
        
        return $Data;
        
    }

    
    public function getTotalUsuarios() {
        
        $totalUsuarios = 0;
        $sqlComando = "SELECT COUNT(*) AS C FROM usuarios";
        
        $sql = $this->dbConexao->prepare($sqlComando);
        try {
            $sql->execute();
            $tempo = $sql->fetch();
            $totalUsuarios = $tempo['C'];
            
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        
        return $totalUsuarios;
    }

    
    
    public function add($campos) {
        
        $options = array(
            "cost" => 15,
        );

        $senhaHash = password_hash($campos[3], PASSWORD_BCRYPT, $options);
        
        $sqlComando = "INSERT INTO usuarios SET "
                . "username= :username,"
                . "email= :email,"
                . "nomeusu= :nomeusu,"
                . "password= :password,"
                . "accessgroup= :accessgroup,"
                . "status= :status";
        
        $sql = $this->dbConexao->prepare($sqlComando);
        
        try {
            $sql->bindValue(":username", $campos[0]);
            $sql->bindValue(":email", $campos[1]);
            $sql->bindValue(":nomeusu", $campos[2]);
            $sql->bindValue(":password", $senhaHash);
            $sql->bindValue(":accessgroup", $campos[4]);
            $sql->bindValue(":status", $campos[5]);
            
            $this->dbConexao->beginTransaction();
            $sql->execute();
            $this->dbConexao->commit();
            
        } catch(PDOException $e) {
            
            $this->dbConexao->rollBack();
            echo $e->getMessage();
            
            
        }
        
        
    }


    public function edit($idUsuario, $campos) {
        
        $sqlComando = "UPDATE usuarios SET "
                . "email= :email,"
                . "nomeusu= :nomeusu,"
                . "accessgroup= :accessgroup,"
                . "status= :status "
                . "WHERE usuarios.id= :idUsuario";
        
        $sql = $this->dbConexao->prepare($sqlComando);
        
        try {
            $sql->bindValue(":idUsuario", $idUsuario);
            $sql->bindValue(":email", $campos[0]);
            $sql->bindValue(":nomeusu", $campos[1]);
            $sql->bindValue(":accessgroup", $campos[2]);
            $sql->bindValue(":status", $campos[3]);
            
            $this->dbConexao->beginTransaction();
            $sql->execute();
            $this->dbConexao->commit();
            
        } catch(PDOException $e) {
            
            $this->dbConexao->rollBack();
            echo $e->getMessage();
            
            
        }
        
        
    }


    
    public function getStatus($idUsuario) {
        
        
        $sqlComando = "SELECT usuarios.status FROM usuarios "
                . "WHERE usuarios.id = :idUsuario";
        
        $sql = $this->dbConexao->prepare($sqlComando);
        try {
            $sql->bindValue(":idUsuario", $idUsuario);
            $sql->execute();
            
            $tempo = $sql->fetch();
            $status = $tempo['status'];
            
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        
        return $status;
    }
    
    
    public function deactivated($idUsuario, $statusNow) {
        
        $status = ( $statusNow == '1') ? '0' : '1';
        
        $sqlComando = "UPDATE usuarios SET "
                . "status= :status "
                . "WHERE usuarios.id= :idUsuario ";
        
        $sql = $this->dbConexao->prepare($sqlComando);
        
        try {
            $sql->bindValue(":idUsuario", $idUsuario);
            $sql->bindValue(":status", $status);
            
            $this->dbConexao->beginTransaction();
            $sql->execute();
            $this->dbConexao->commit();
            
        } catch(PDOException $e) {
            $this->dbConexao->rollback();
            echo $e->getMessage();
            
        }
        
        
    }
}