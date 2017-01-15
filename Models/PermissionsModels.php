<?php

class PermissionsModels extends model {

    private $group;
    private $permissions;
    
    public function __construct() {
        parent::__construct();
    }
    

    public function setGroup($idGroup) {

        $this->group = $idGroup;
        $this->permissions = array();
        
        $sqlComando = "SELECT PARAMS FROM permissiongroups WHERE ID= :idg";
        $sql = $this->dbConexao->prepare($sqlComando);
        $sql->bindValue(":idg", $idGroup);
        $sql->execute();
        
        if ( $sql->rowCount() > 0 ) {
            $row = $sql->fetch();
            if ( empty($row['PARAMS']) ) {
                $row['PARAMS'] = '0';
            }
            $params = implode(",", $row);
            $sqlComando = "SELECT NAME FROM permissionparams WHERE ID IN ($params)";
            $sql = $this->dbConexao->prepare($sqlComando);
            $sql->execute();
            
            if ( $sql->rowCount() > 0 ) {
                
                $userParams = $sql->fetchAll();
                foreach ($userParams as $item) {
                    $this->permissions[] = $item['NAME'];
                }
            }
        }
    }

    
    public function hasPermission($namePermission) {

        
        if (in_array($namePermission, $this->permissions)) {
            return TRUE;
        } else {
            return FALSE;
        }
        
    }
    
    
    
    
    public function permissionsList() {
        
        $data = array();
        $sqlComando = "SELECT * FROM permissionparams";
        
        $sql = $this->dbConexao->prepare($sqlComando);
        $sql->execute();
        
        if ( $sql->rowCount() > 0 ) {
            $data = $sql->fetchAll();
        }
        return $data;
        
    }

    public function permissionsGroup() {
        
        $data = array();
        $sqlComando = "SELECT * FROM permissiongroups";
        
        $sql = $this->dbConexao->prepare($sqlComando);
        $sql->execute();
        
        if ( $sql->rowCount() > 0 ) {
            $data = $sql->fetchAll();
        }
        return $data;
        
    }


    
    public function add($pname, $lname, $pstatus) {

        $sqlComando = "INSERT INTO permissionparams SET NAME= :param, LONGNAME= :lname, STATUS= :spermission";
        $sql = $this->dbConexao->prepare($sqlComando);
        $sql->bindValue(":param", $pname);
        $sql->bindValue(":lname", $lname);
        $sql->bindValue(":spermission", $pstatus);
        $sql->execute();
        
        $lastId = $this->dbConexao->lastInsertId();

        return $lastId;


    }

    
    public function addGroup($pname, $lname, $spermission, $status ) {

        $listParam = implode(",", $spermission);
        
        $sqlComando = "INSERT INTO permissiongroups SET NAME= :pName, LONGNAME= :lName, STATUS= :spermission, PARAMS= :lParam";
        $sql = $this->dbConexao->prepare($sqlComando);
        $sql->bindValue(":pName", $pname);
        $sql->bindValue(":lName", $lname);
        $sql->bindValue(":spermission", $status);
        $sql->bindValue(":lParam", $listParam);
        $sql->execute();
        
        $lastId = $this->dbConexao->lastInsertId();

        return $lastId;


    }
    
    
    
    public function alterar($pId, $pname, $lname, $spermission) {

        $sqlComando = "UPDATE permissionparams SET NAME= :nParam, LONGNAME= :lname, STATUS= :sParam WHERE ID= :idParam";
        $sql = $this->dbConexao->prepare($sqlComando);
        $sql->bindValue(":nParam", $pname);
        $sql->bindValue(":lname", $lname);
        $sql->bindValue(":sParam", $spermission);
        $sql->bindValue(":idParam", $pId);
        $sql->execute();


    }

    public function editGroup($idG, $pname, $lname, $spermission, $status ) {

        $listParam = implode(",", $spermission);
        
        $sqlComando = "UPDATE permissiongroups SET NAME= :pName, LONGNAME= :lName, STATUS= :spermission, PARAMS= :lParam WHERE ID= :idGroup";
        $sql = $this->dbConexao->prepare($sqlComando);
        $sql->bindValue(":pName", $pname);
        $sql->bindValue(":lName", $lname);
        $sql->bindValue(":spermission", $status);
        $sql->bindValue(":lParam", $listParam);
        $sql->bindValue(":idGroup", $idG);
        $sql->execute();

    }
    
    
    
    
    public function delete($pId) {

        $sqlComando = "DELETE FROM permissionparams WHERE ID= :param";
        $sql = $this->dbConexao->prepare($sqlComando);
        $sql->bindValue(":param", $pId);
        $sql->execute();

    }


    public function deleteGroup($pId) {

        $sqlComando = "DELETE FROM permissiongroups WHERE ID= :param";
        $sql = $this->dbConexao->prepare($sqlComando);
        $sql->bindValue(":param", $pId);
        $sql->execute();

    }
    

    

    
    public function getPermission($idPermission) {

        $data = array();
        
        $sqlComando = "SELECT * FROM permissionparams WHERE ID= :idParam";
        $sql = $this->dbConexao->prepare($sqlComando);
        $sql->bindValue(":idParam", $idPermission);
        $sql->execute();

        if ( $sql->rowCount() > 0 ) {
            $data = $sql->Fetch();
        }
        
        return $data;

    }

    public function getGroup($idGroup = 0) {

        $data = array();
        if ( $idGroup === 0 ) {
            $sqlComando = "SELECT * FROM permissiongroups";
        }
        else {
            $sqlComando = "SELECT * FROM permissiongroups WHERE ID= :idParam";
        }

        $sql = $this->dbConexao->prepare($sqlComando);
        if ( $idGroup !== 0 ) {
            $sql->bindValue(":idParam", $idGroup);
        }
        $sql->execute();

        if ( $sql->rowCount() > 0 ) {
            $data = ($idGroup !== 0 ) ? $sql->Fetch() : $sql->FetchAll();
            if ( $idGroup !== 0 ) {
                $data['PARAMS'] = explode(",", $data['PARAMS']);
            }
        }
        return $data;

    }
    
    
    
    
    public function deactivated($pId, $statusNow) {

        $recordStatus = (($statusNow === "SIM") ? "NAO" : "SIM");
        
        $sqlComando = "UPDATE permissionparams SET STATUS= :sPermission WHERE ID= :param";
        $sql = $this->dbConexao->prepare($sqlComando);
        $sql->bindValue(":param", $pId);
        $sql->bindValue(":sPermission", $recordStatus);
        $sql->execute();

    }

    
    }