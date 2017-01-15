<?php

    /*
     * Site Institucional com estrutura MVC
     */

    class ParametrosController extends Controller {
        
        public function __construct() {
            parent::__construct();
            $admin = new AdminsModels();
            if ( $admin->adminIsLog() === FALSE ) {
                header("Location:".BASE_URL."/login");
            }
            
        }
        
        public function index() {
            
            $user = new AdminsModels();
            $userInfo = $user->getUserLogged();
            $company = new EmpresaModels();
            $company = $company->getEmpresa();
            $Data['company_name'] = $company['emp_nome'];
            $Data['company_fanta'] = $company['emp_fanta'];
            $Data['user_name'] = $userInfo['email'];

            if ( $user->hasPermission("EMPRESA")) {
                $Data['editPermission'] = TRUE;
                $Data['empresa'] = $company;
                
                $this->TemplateView("empresas", $Data);
                
            } else {
                header("Location:".BASE_URL);
            }
            

        }
        
        
        public function empresaAdd() {
            
            $dados = array();
            
            
            
            
            $this->TemplateView("empresasAdd", $dados);
            
        }
        
    }

?>
