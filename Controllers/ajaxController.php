<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ajaxController extends Controller {
    
        
    public function __construct() {
        parent::__construct();

        $admin = new AdminsModels();
        if ( $admin->adminIsLog() === FALSE ) {
            header("Location:".BASE_URL."/login");
        }

    }
    
    public function index() {}
 
    
    public function searchClient() {
        
        
        $Data = array();

        $user = new UsersModels();
        $userInfo = $user->getUserLogged();
        $company = new CompanyModels();
        $company = $company->getCompany();
        $Data['company_name'] = $company['NAME'];
        $Data['user_name'] = $userInfo['EMAIL'];
        
        $clients = new ClientsModels();
        
        if ( isset($_GET['q']) && !empty($_GET['q'])) {
            
            $campoBusca = filter_input(INPUT_GET, 'q', FILTER_DEFAULT);
            $tempoClient = $clients->clientByName($campoBusca);
            $dataSearch = array();
            
            foreach ( $tempoClient as $item ) {
                $dataSearch[] = array(
                    "NAME" => $item['NAME'],
                    "link" => BASE_URL.'/clients/clientsEdit/'.$item['ID'],
                    "ID" => $item['ID']
                );
                
            }
            
        }
       
        
        echo json_encode($dataSearch); // retorno para o Ajax
        
        
        
    }
    

    public function clientAdd() {
        
        
        $Data = array();

        $user = new UsersModels();
        $userInfo = $user->getUserLogged();
        
        $clients = new ClientsModels();
        
        if ( isset($_POST['name']) && !empty($_POST['name'])) {
            
            $campoBusca = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
            $Data['id'] = $clients->clientAdd($campoBusca);
            
        }
       
        
        echo json_encode($Data); // retorno para o Ajax
        
        
        
    }
    

    public function searchProduct() {
        
        
        $Data = array();
        $dataSearch = array();

        $user = new UsersModels();
        $userInfo = $user->getUserLogged();
        $company = new CompanyModels();
        $company = $company->getCompany();
        $Data['company_name'] = $company['NAME'];
        $Data['user_name'] = $userInfo['EMAIL'];
        
        $product = new InventoryModels();
        
        if ( isset($_GET['q']) && !empty($_GET['q'])) {
            
            $campoBusca = filter_input(INPUT_GET, 'q', FILTER_DEFAULT);
            $dataSearch = $product->inventoryProductByName($campoBusca);
            
        }
       
        
        echo json_encode($dataSearch); // retorno para o Ajax
        
        
        
    }
    
    public function countiesListByState() {

        $countiesList = array();
        $counties = new CountiesModels();
        if ( isset($_GET['estado']) && !empty($_GET['estado'])) {
            
            $campoBusca = filter_input(INPUT_GET, 'estado', FILTER_DEFAULT);
            $countiesList['counties'] = $counties->countiesListByState($campoBusca);
            
            
        }
        echo json_encode($countiesList); // retorno para o Ajax

    }

    public function contatosList() {
        
        $contatos= array();
        $contato = new ContatosModels();
        $contatos['contato'] = $contato->contatosList();
        
        echo json_encode($contatos);
        
    }

    
    
}
