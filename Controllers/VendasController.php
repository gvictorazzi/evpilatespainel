<?php

    /*
     * Site Institucional com estrutura MVC
     */

    class VendasController extends Controller {
        
        public function __construct() {
            parent::__construct();
        }
        
        
        public function index() {
            $dados = array();
            $offset = 0;
            $limite = 5;
            
            if ( isset($_GET['p']) && !empty($_GET['p'])) {
                $offset = addslashes($_GET['p']);
                $offset = ($limite * $offset )- $limite; 
                
            }
            
            $vendas = new VendasModels();
            
            
            $dados['limiteProdutos'] = $limite;
            $dados['totalVendas'] = $vendas->getTotalVendas();
            $dados['vendas'] = $vendas->getVendas($offset, $limite); 
            
            $this->TemplateView("vendas", $dados);

        }

        public function ver($idVenda) {
            
            if ( !empty($idVenda)) {
                
                $dados = array(
                    "vendas" => array()
                );
                
                $venda = new VendasModels();
                $dados['vendas'] = $venda->getVendasById($idVenda);
                
                $this->TemplateView("vendasDetalhe", $dados);
                
                
            }
            

        }
        
        
    }  
    
    
    
?>
