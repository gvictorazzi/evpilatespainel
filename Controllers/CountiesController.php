<?php

    /*
     * Site Institucional com estrutura MVC
     */

class CountiesController extends Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $Data = array(
            "aviso" =>""
        );

        $user = new UsersModels();
        $userInfo = $user->getUserLogged();
        $company = new CompanyModels();
        $company = $company->getCompany();
        $Data['company_name'] = $company['NAME'];
        $Data['user_name'] = $userInfo['EMAIL'];
        $offset = 0;
        $limite = 10;
        $limiteDaBarra = 10;
        $paginaAtual = 1;
        $paginaInicial = 1;
        

        if ( $user->hasPermission("AUXTABLES")) {
            
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
            
            
            $counties = new CountiesModels();
            $Data['editPermission'] = $user->hasPermission("AUXTABLES");
            $Data['countiesList'] = $counties->countiesList($offset);
            $Data['totalCounties'] = $counties->getCountiesCount();
            $Data['totalPaginas'] = ceil($Data['totalCounties']/ 10 );
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
            
            $this->TemplateView("counties", $Data);

        } else {
            header("Location:".BASE_URL);
        }


    }
    
}

?>
