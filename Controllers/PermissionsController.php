<?php

    /*
     * Site Institucional com estrutura MVC
     */

    class PermissionsController extends Controller {

        
        public function __construct() {
            parent::__construct();
            
            $admin = new AdminsModels();
            if ( $admin->adminIsLog() === FALSE ) {
                header("Location:".BASE_URL."/login");
            }
            
        }


        
        public function index() {
            $Data = array(
                "aviso" =>""
            );
            
            $user = new AdminsModels();
            $userInfo = $user->getUserLogged();
            $company = new EmpresaModels();
            $company = $company->getEmpresa();
            $Data['company_name'] = $company['emp_nome'];
            $Data['company_fanta'] = $company['emp_fanta'];
            $Data['user_name'] = $userInfo['email'];
            
            if ( $user->hasPermission("permissions")) {
                
                $permissions = new PermissionsModels();
                $Data['permissionsList'] = $permissions->permissionsList();
                $Data['permissionsGroup'] = $permissions->permissionsGroup();

                $this->TemplateView("permissions", $Data);
                
            } else {
                header("Location:".BASE_URL);
            }
            

        }
        
        // Adicionar Permissões ao Usuário
        public function add() {

            $Data = array(
                "aviso" =>""
            );
            
            $user = new AdminsModels();
            $userInfo = $user->getUserLogged();
            $company = new EmpresaModels();
            $company = $company->getEmpresa();
            $Data['company_name'] = $company['emp_nome'];
            $Data['user_name'] = $userInfo['email'];
            
            if ( $user->hasPermission("permissions")) {
                
                if (isset($_POST['pname']) && !empty($_POST['pname'])) {
                    
                    $pname = filter_input(INPUT_POST, 'pname', FILTER_DEFAULT);
                    $lname = filter_input(INPUT_POST, 'lname', FILTER_DEFAULT);              
                    $spermission = filter_input(INPUT_POST, 'pstatus', FILTER_DEFAULT);              
                    $addPname = new PermissionsModels();
                    $addPname->add($pname, $lname, $spermission);
                    header("Location:".BASE_URL."/permissions");
                }
                
                $permissions = new PermissionsModels();
                $this->TemplateView("permissionsAdd", $Data);
                
            } else {
                header("Location:".BASE_URL);
            }
            
        }

        // Adicionar Permissões ao Usuário
        public function addGroup() {

            $Data = array(
                "aviso" =>""
            );
            
            $user = new AdminsModels();
            $userInfo = $user->getUserLogged();
            $company = new EmpresaModels();
            $company = $company->getEmpresa();
            $Data['company_name'] = $company['emp_nome'];
            $Data['user_name'] = $userInfo['email'];
            
            if ( $user->hasPermission("permissions")) {
                
                if (isset($_POST['pname']) && !empty($_POST['pname'])) {
                    
                    $pname = filter_input(INPUT_POST, 'pname', FILTER_DEFAULT);
                    $lname = filter_input(INPUT_POST, 'lname', FILTER_DEFAULT);              
                    $spermission = $_POST['permiGroup'];              
                    $status = filter_input(INPUT_POST, 'pstatus', FILTER_DEFAULT);              
                    
                    $addPname = new PermissionsModels();
                    
                    $addPname->addGroup($pname, $lname, $spermission, $status );
                    header("Location:".BASE_URL."/permissions");
                }
                
                $permissions = new PermissionsModels();
                $Data['permissionsList'] = $permissions->permissionsList();
                
                
                
                $this->TemplateView("permissionsGroupAdd", $Data);
                
            } else {
                header("Location:".BASE_URL);
            }
            
        }
        
        // Deletar Grupo de Permissões
        
        public function deleteGroup($pId) {

            // primeiro verifica se não tem Usuários utilizando o Grupo
            $usersGroupActivated = new UsersModels();
            $qUserGA = $usersGroupActivated->usersByGroup($pId);

            // devolve Falso de não houver problemas para cancelar o grupo
            if (($qUserGA['userActivated']) === "FALSE") {
                
                $delGroup = new PermissionsModels();
                $delGroup->deleteGroup($pId);
                
            }
                
            header("Location:".BASE_URL."/permissions");
            
            
        }
    
        
        
        // Alterar Descfrição ou Desativar o Módulo
        // do Sistema
        
        public function alterar($pId) {

            $Data = array(
                "aviso" =>""
            );
            
            $user = new AdminsModels();
            $userInfo = $user->getUserLogged();
            $company = new EmpresaModels();
            $company = $company->getEmpresa();
            $Data['company_name'] = $company['emp_nome'];
            $Data['user_name'] = $userInfo['email'];
            
            if ( $user->hasPermission("permissions")) {
                
                if (isset($_POST['pname']) && !empty($_POST['pname'])) {

                    $pname = filter_input(INPUT_POST, 'pname', FILTER_DEFAULT);
                    $lname = filter_input(INPUT_POST, 'lname', FILTER_DEFAULT);              
                    $spermission = filter_input(INPUT_POST, 'pstatus', FILTER_DEFAULT);              
                    $addPname = new PermissionsModels();
                    $addPname->alterar($pId, $pname, $lname, $spermission);
                    header("Location:".BASE_URL."/permissions");
                    
                } else {
                    $permissions = new PermissionsModels();
                    $Data['permission'] = $permissions->getPermission($pId);
                    $this->TemplateView("permissionsAlterar", $Data);                   
                }
                
                
            } else {
                header("Location:".BASE_URL);
            }
            
        }

        // Adicionar Permissões ao Usuário
        public function alterarGroup($idGroup) {

            $Data = array(
                "aviso" =>""
            );
            
            $user = new AdminsModels();
            $userInfo = $user->getUserLogged();
            $company = new EmpresaModels();
            $company = $company->getEmpresa();
            $Data['company_name'] = $company['emp_nome'];
            $Data['user_name'] = $userInfo['email'];
            
            if ( $user->hasPermission("permissions")) {
                
                if (isset($_POST['pname']) && !empty($_POST['pname'])) {
                    
                    $pname = filter_input(INPUT_POST, 'pname', FILTER_DEFAULT);
                    $lname = filter_input(INPUT_POST, 'lname', FILTER_DEFAULT);              
                    $spermission = $_POST['permiGroup'];              
                    $status = filter_input(INPUT_POST, 'pstatus', FILTER_DEFAULT);              
                    
                    $addPname = new PermissionsModels();
                    
                    $addPname->editGroup($idGroup, $pname, $lname, $spermission, $status );
                    header("Location:".BASE_URL."/permissions");
                }
                
                $permissions = new PermissionsModels();
                $Data['permissionsList'] = $permissions->permissionsList();
                $Data['groupInfo'] = $permissions->getGroup($idGroup);
                $this->TemplateView("permissionsGroupEdit", $Data);
                
            } else {
                header("Location:".BASE_URL);
            }
            
        }
        

        
        // Alterar Descfrição ou Desativar o Módulo
        // do Sistema
        
        public function deactivatedGroup($pId) {

            $Data = array(
                "aviso" =>""
            );
            $statusNow = '';
            
            $user = new AdminsModels();
            $userInfo = $user->getUserLogged();
            $company = new EmpresaModels();
            $company = $company->getEmpresa();
            $Data['company_name'] = $company['emp_nome'];
            $Data['user_name'] = $userInfo['email'];
            
            if ( $user->hasPermission("permissions")) {
                
                    $addPname = new PermissionsModels();
                    $Data = $addPname->getPermissionGroup($pId);
                    $statusNow = $Data['STATUS'];
                    $addPname->deactivatedGroup($pId, $statusNow);
                    header("Location:".BASE_URL."/permissions");
                    
                
            } else {
                header("Location:".BASE_URL);
            }
            
        }

        public function deactivated($pId) {

            $Data = array(
                "aviso" =>""
            );
            $statusNow = '';
            
            $user = new AdminsModels();
            $userInfo = $user->getUserLogged();
            $company = new EmpresaModels();
            $company = $company->getEmpresa();
            $Data['company_name'] = $company['emp_nome'];
            $Data['user_name'] = $userInfo['email'];
            
            if ( $user->hasPermission("permissions")) {
                
                    $addPname = new PermissionsModels();
                    $Data = $addPname->getPermission($pId);
                    $statusNow = $Data['STATUS'];
                    $addPname->deactivated($pId, $statusNow);
                    header("Location:".BASE_URL."/permissions");
                    
                
            } else {
                header("Location:".BASE_URL);
            }
            
        }

        
    }

?>
