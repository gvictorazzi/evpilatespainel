<?php

    /*
     * Site Institucional com estrutura MVC
     */

    class SairController extends Controller {
        
        public function __construct() {
            parent::__construct();
        }
        
        public function index() {
            if ( isset($_SESSION['adminLogin']) && !empty($_SESSION['adminLogin'])) {
                unset($_SESSION['adminLogin']);
                header("Location:".BASE_URL."/login");
            }

        }

        
        
    }

?>
