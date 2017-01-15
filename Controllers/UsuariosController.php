<?php

    /*
     * Site Institucional com estrutura MVC
     */

    class UsuariosController extends Controller {

        
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

            $offset = 0;
            $limite = 10;
            $limiteDaBarra = 10;
            $paginaAtual = 1;
            $paginaInicial = 1;
            
            $user = new AdminsModels();
            $userInfo = $user->getUserLogged();
            $company = new EmpresaModels();
            $company = $company->getEmpresa();
            $Data['company_name'] = $company['emp_nome'];
            $Data['company_fanta'] = $company['emp_fanta'];
            $Data['user_name'] = $userInfo['email'];
            
            if ( $user->hasPermission("USUARIOS")) {

                if ( isset($_GET['p']) && !empty($_GET['p'])) {
                    $offset = filter_input(INPUT_GET, 'p', FILTER_DEFAULT);
                    $paginaAtual = $offset;
                    $offset = ($offset - 1) * $limite;
                    if ( ($paginaAtual-1) % $limiteDaBarra === 0 ) {
                        $paginaInicial = $paginaAtual;
                    } else {
                        $paginaInicial = ( floor(($paginaAtual-1) / $limiteDaBarra ) * $limiteDaBarra ) + 1;
                    }
                }



                $usuario = new UsuariosModels();
                $Data['usuario'] = $usuario->getAllUsuarios($offset);
                $Data['totalRegistros'] = $usuario->getTotalUsuarios();
                $Data['totalPaginas'] = ceil($Data['totalRegistros']/ 10 );
                if ( $Data['totalPaginas'] < $limiteDaBarra ) {
                    $limiteDaBarra = $Data['totalPaginas'];
                }
                $Data['paginaInicial'] = $paginaInicial;
                if ( $paginaInicial <= 0 ) {
                    $paginaInicial = 1;
                } elseif ( $paginaInicial > $Data['totalPaginas']) {
                    $paginaInicial = $Data['totalPaginas']-10;
                }
                $Data['paginaAtual'] = $paginaAtual;
                $Data['limite'] = $paginaInicial+($limiteDaBarra-1);
                
                $this->TemplateView("usuarios", $Data);
                
            } else {
                header("Location:".BASE_URL);
            }
            

        }
        
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
            
            if ( $user->hasPermission("USUARIOS")) {
                
                if (isset($_POST['nomeusu']) && !empty($_POST['nomeusu'])) {
                    
                    $nomeusu = filter_input(INPUT_POST, 'nomeusu', FILTER_DEFAULT);
                    $email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);              
                    $username = filter_input(INPUT_POST, 'username', FILTER_DEFAULT);              
                    $senha = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);              
                    $grupodeacesso = filter_input(INPUT_POST, 'grupodeacesso', FILTER_DEFAULT);              
                    $status = filter_input(INPUT_POST, 'status', FILTER_DEFAULT);              

                    $usuarios = new UsuariosModels();
                    $dataGrava = array( $username, $email, $nomeusu, $senha, $grupodeacesso, $status);
                    $usuarios->add($dataGrava);
                    
                    header("Location:".BASE_URL."/usuarios");
                }
                
                $permissions = new PermissionsModels();
                $Data['gruposdeacesso'] = $permissions->getGroup();
                $this->TemplateView("usuariosAdd", $Data);
                
            } else {
                header("Location:".BASE_URL);
            }
            
        }

        public function edit($idUsuario) {

            $Data = array(
                "aviso" =>""
            );
            
            $user = new AdminsModels();
            $userInfo = $user->getUserLogged();
            $company = new EmpresaModels();
            $company = $company->getEmpresa();
            $Data['company_name'] = $company['emp_nome'];
            $Data['user_name'] = $userInfo['email'];
            
            if ( $user->hasPermission("USUARIOS")) {
                
                if (isset($_POST['nomeusu']) && !empty($_POST['nomeusu'])) {
                    
                    $nomeusu = filter_input(INPUT_POST, 'nomeusu', FILTER_DEFAULT);
                    $email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);              
                    $grupodeacesso = filter_input(INPUT_POST, 'grupodeacesso', FILTER_DEFAULT);              
                    $status = filter_input(INPUT_POST, 'status', FILTER_DEFAULT);              

                    $usuarios = new UsuariosModels();
                    $dataGrava = array( $email, $nomeusu, $grupodeacesso, $status);
                    $usuarios->edit($idUsuario, $dataGrava);
                    
                    header("Location:".BASE_URL."/usuarios");
                }
                
                $usuario = new UsuariosModels();
                $Data['usuario'] = $usuario->getUsuariosById($idUsuario);
                $permissions = new PermissionsModels();
                $Data['gruposdeacesso'] = $permissions->getGroup();
                
                $this->TemplateView("usuariosEdit", $Data);
                
            } else {
                header("Location:".BASE_URL);
            }
            
        }


        // Alterar Descfrição ou Desativar o Módulo
        // do Sistema
        
        public function deactivated($idUsuario) {

            $statusNow = '';
            
            $user = new AdminsModels();
            $userInfo = $user->getUserLogged();
            $company = new EmpresaModels();
            $company = $company->getEmpresa();
            $Data['company_name'] = $company['emp_nome'];
            $Data['user_name'] = $userInfo['email'];
            
            if ( $user->hasPermission("USUARIOS")) {
                
                    $usuario = new UsuariosModels();
                    $statusNow = $usuario->getStatus($idUsuario);
                    $usuario->deactivated($idUsuario, $statusNow);
                    header("Location:".BASE_URL."/usuarios");
                    
                
            } else {
                header("Location:".BASE_URL);
            }
            
        }


        
    }

?>
