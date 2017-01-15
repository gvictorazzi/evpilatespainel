<?php

    /*
     * Site Institucional com estrutura MVC
     */

class ProfessorController extends Controller {


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

        if ( $user->hasPermission("PROFESSORES")) {

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



            $professor = new ProfessorModels();
            $Data['professor'] = $professor->getAllProfessores(); 
            $Data['totalRegistros'] = $professor->getTotalProfessores();
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

            $this->TemplateView("professores", $Data);

        } else {
            header("Location:".BASE_URL);
        }

    }

}

?>
