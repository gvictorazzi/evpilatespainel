<?php

    /*
     * Site Institucional com estrutura MVC
     */

    class AdminsController extends Controller {
        
        public function __construct() {
            parent::__construct();
        }
        
        
        public function index() {
            $dados = array();
            
            $this->TemplateView("administrador", $dados);

        }

        
        
    }

?>
