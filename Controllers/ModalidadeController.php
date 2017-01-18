<?php

    /*
     * Site Institucional com estrutura MVC
     */

class ModalidadeController extends Controller {


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

        if ( $user->hasPermission("MODALIDADE")) {

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



            $modalidade = new ModalidadeModels();
            $Data['modalidade'] = $modalidade->getAllModalidades();  
            $Data['totalRegistros'] = $modalidade->getTotalModalidades();
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

            $this->TemplateView("modalidade", $Data);

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
            
            if ( $user->hasPermission("MODALIDADE")) {
                
                if (isset($_POST['modalidade']) && !empty($_POST['modalidade'])) {
                    
                    $modalidade = filter_input(INPUT_POST, 'modalidade', FILTER_DEFAULT);
                    $modal_descri = filter_input(INPUT_POST, 'modal_descri', FILTER_DEFAULT);
                    $modal_letraid = filter_input(INPUT_POST, 'modal_letraid', FILTER_DEFAULT);
                    $fotomodalidade = filter_input(INPUT_POST, 'fotomodalidade', FILTER_DEFAULT);
                    $modal_status = filter_input(INPUT_POST, 'modal_status', FILTER_DEFAULT);
                    

                    $modal = new ModalidadeModels();
                    $dataGrava = array( $modalidade, $modal_descri, $modal_letraid, $fotomodalidade, $modal_status);
                    $modal->addModalidade($dataGrava);
                    
                    header("Location:".BASE_URL."/modalidade");
                    
                }
                
                $estados = new CitiesModels();
                $Data['estados'] = $estados->citiesList(0, FALSE);
                
                $this->TemplateView("modalidadeAdd", $Data);
                
            } else {
                header("Location:".BASE_URL);
            }
            
        }
    

        
        
        public function edit($idModalidade) {

            $Data = array(
                "aviso" =>""
            );
            
            $user = new AdminsModels();
            $userInfo = $user->getUserLogged();
            $company = new EmpresaModels();
            $company = $company->getEmpresa();
            $Data['company_name'] = $company['emp_nome'];
            $Data['user_name'] = $userInfo['email'];
            
            if ( $user->hasPermission("MODALIDADE")) {
                
                if (isset($_POST['modalidade']) && !empty($_POST['modalidade'])) {
                    
                    $modalidade = filter_input(INPUT_POST, 'modalidade', FILTER_DEFAULT);
                    $modal_descri = filter_input(INPUT_POST, 'modal_descri', FILTER_DEFAULT);
                    $modal_letraid = filter_input(INPUT_POST, 'modal_letraid', FILTER_DEFAULT);
                    $fotomodalidade = filter_input(INPUT_POST, 'fotomodalidade', FILTER_DEFAULT);
                    $modal_status = filter_input(INPUT_POST, 'modal_status', FILTER_DEFAULT);
                    

                    $modal = new ModalidadeModels();
                    $dataGrava = array( $modalidade, $modal_descri, $modal_letraid, $fotomodalidade, $modal_status);
                    $modal->updateModalidade($idModalidade, $dataGrava);
                    
                    header("Location:".BASE_URL."/modalidade");
                    
                }
                
                $estados = new CitiesModels();
                $modal = new ModalidadeModels();
                $Data['estados'] = $estados->citiesList(0, FALSE);
                $Data['modalidade'] = $modal->getModalidadeById($idModalidade);
                
                $this->TemplateView("modalidadeEdit", $Data);
                
            } else {
                header("Location:".BASE_URL);
            }
            
        }
    
        
        
}

?>
