<?php

    /*
     * Site Institucional com estrutura MVC
     */

class ContatosController extends Controller {


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

        if ( $user->hasPermission("CONTATOS")) {

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



            $contato = new ContatosModels();
            $Data['contatos'] = $contato->contatosList(); 
            $Data['totalRegistros'] = $contato->getContatosCount();
            $Data['totalPaginas'] = ceil($Data['totalRegistros']/ $limite );
            if ( $Data['totalPaginas'] < $limiteDaBarra ) {
                $limiteDaBarra = $Data['totalPaginas'];
            }
            $Data['paginaInicial'] = $paginaInicial;
            if ( $paginaInicial <= 0 ) {
                $paginaInicial = 1;
            } elseif ( $paginaInicial > $Data['totalPaginas']) {
                $paginaInicial = $Data['totalPaginas'] - $limite;
            }
            $Data['paginaAtual'] = $paginaAtual;
            $Data['limite'] = $paginaInicial+($limiteDaBarra-1);

            $this->TemplateView("contatos", $Data);

        } else {
            header("Location:".BASE_URL);
        }

    }

    

    public function add() {
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

        if ( $user->hasPermission("CONTATOS")) {

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

            $contato = new ContatosModels();
            $Data['contatos'] = $contato->contatosList(); 
            $Data['totalRegistros'] = $contato->getContatosCount();
            $Data['totalPaginas'] = ceil($Data['totalRegistros']/ $limite );
            if ( $Data['totalPaginas'] < $limiteDaBarra ) {
                $limiteDaBarra = $Data['totalPaginas'];
            }
            $Data['paginaInicial'] = $paginaInicial;
            if ( $paginaInicial <= 0 ) {
                $paginaInicial = 1;
            } elseif ( $paginaInicial > $Data['totalPaginas']) {
                $paginaInicial = $Data['totalPaginas'] - $limite;
            }
            $Data['paginaAtual'] = $paginaAtual;
            $Data['limite'] = $paginaInicial+($limiteDaBarra-1);


            if ( isset($_POST['contato_tipo']) && !empty($_POST['contato_tipo'])) {
                
                $contato = filter_input(INPUT_POST, 'contato_tipo', FILTER_DEFAULT);
                $link_icone = filter_input( INPUT_POST, 'link_icone', FILTER_DEFAULT);
                $status = filter_input(INPUT_POST, 'contato_status', FILTER_DEFAULT);
                
                
                $contatos = new ContatosModels();
                $contatos->save($contato, $link_icone, $status);
                
                header("Location:".BASE_URL.'/contatos');
                
                
            }
            
            $this->TemplateView("contatosAdd", $Data);

        } else {
            header("Location:".BASE_URL);
        }

    }


}

?>
