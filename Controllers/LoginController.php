<?php

    /*
     * Site Institucional com estrutura MVC
     */

    class LoginController extends Controller {
        
        public function __construct() {
            parent::__construct();
            
        }
        
        public function index() {
            $dados = array(
                "logado" => 0,
                "aviso" => ""
            );
            
            if (isset($_POST['usuario']) && !empty($_POST['usuario'])) {
                $usuario = filter_input(INPUT_POST, 'usuario', FILTER_DEFAULT);
                $senha = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);
                
                $admin = new AdminsModels();
                $dados['logado'] = $admin->getUsuarioAdmin($usuario, $senha);
                if ($dados['logado'] > 0 ) {
                    $_SESSION['adminLogin'] = $dados['logado'];
                    header("Location:".BASE_URL."/Painel");
                }
                else {
                    //$admin->criarUsuarioAdmin($usuario, $senha);
                    $dados['aviso'] = "Usuario e/ou Senha não conferem !!";
                }
                
            }
            
            $this->loadViewInTemplate("login", $dados);

        }

        
        
    }

?>
