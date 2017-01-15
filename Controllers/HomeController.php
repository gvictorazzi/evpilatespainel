<?php

    /*
     * Site Institucional com estrutura MVC
     */

    class HomeController extends Controller {
        
        public function __construct() {
            parent::__construct();
            $admin = new AdminsModels();
            if ( $admin->adminIsLog() === FALSE ) {
                header("Location:".BASE_URL."/login");
            }
            
        }
        
        public function index() {
            $Data = array();
            $user = new AdminsModels();
            $user = $user->getUserLogged();
            $company = new EmpresaModels();
            $company = $company->getEmpresa();
            
            $Data['company_name'] = $company['emp_nome'];
            $Data['user_name'] = $user['email'];
            
            $this->TemplateView("home", $Data);
        }
        
        
    }

?>
