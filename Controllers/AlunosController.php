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

        if ( $user->hasPermission("ALUNOS")) {

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

        if ( $user->hasPermission("PROFESSORES")) {

            if (isset($_POST['prof_nome']) && !empty($_POST['prof_nome'])) {

                $prof_nome = filter_input(INPUT_POST, 'prof_nome', FILTER_DEFAULT);
                $prof_apelido = filter_input(INPUT_POST, 'prof_apelido', FILTER_DEFAULT);
                $prof_email = filter_input(INPUT_POST, 'prof_email', FILTER_DEFAULT);
                $prof_tel = filter_input(INPUT_POST, 'prof_tel', FILTER_DEFAULT);
                $prof_cel = filter_input(INPUT_POST, 'prof_cel', FILTER_DEFAULT);
                $prof_cpf = filter_input(INPUT_POST, 'prof_cpf', FILTER_DEFAULT);
                $prof_rg = filter_input(INPUT_POST, 'prof_rg', FILTER_DEFAULT);
                $prof_end = filter_input(INPUT_POST, 'prof_end', FILTER_DEFAULT);
                $prof_num = filter_input(INPUT_POST, 'prof_num', FILTER_DEFAULT);
                $prof_compl = filter_input(INPUT_POST, 'prof_compl', FILTER_DEFAULT);
                $prof_bairro = filter_input(INPUT_POST, 'prof_bairro', FILTER_DEFAULT);
                $prof_cidade = filter_input(INPUT_POST, 'prof_cidade', FILTER_DEFAULT);
                $prof_uf = filter_input(INPUT_POST, 'prof_uf', FILTER_DEFAULT);
                $prof_cep = filter_input(INPUT_POST, 'prof_cep', FILTER_DEFAULT);
                $prof_status = filter_input(INPUT_POST, 'prof_status', FILTER_DEFAULT);
                $biografia = filter_input(INPUT_POST, 'biografia', FILTER_DEFAULT);
                $foto_prof = filter_input(INPUT_POST, 'prof_foto', FILTER_DEFAULT);

                $modalidade = $_POST['profmodalidade']; // matriz com as especializações do professor

                $professor = new ProfessorModels();
                $dataGrava = array( $prof_nome, $prof_apelido, $prof_email, $prof_tel, $prof_cel,
                                    $prof_cpf, $prof_rg, $prof_cep, $prof_end, $prof_num, $prof_compl,
                                    $prof_bairro, $prof_uf, $prof_cidade, $prof_status, $biografia, $foto_prof);
                $professor->add($dataGrava, $modalidade);

                header("Location:".BASE_URL."/professor");

            }

            $estados = new CitiesModels();
            $Data['estados'] = $estados->citiesList(0, FALSE);
            $modal = new ModalidadeModels();
            $Data['modal'] = $modal->getAllModalidades();

            $this->TemplateView("professoresAdd", $Data);

        } else {
            header("Location:".BASE_URL);
        }

    }


}

?>
