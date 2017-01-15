<?php

    /*
     * Site Institucional com estrutura MVC
     */

    class CategoriasController extends Controller {
        
        public function __construct() {
            parent::__construct();
        }
        
        
        public function index() {
            $dados = array();
            
            $categoria = new CategoriasModels();
            $dados['categoria'] = $categoria->getCategorias();
            
            $this->TemplateView("categorias", $dados);

        }
       
        public function apagarCategorias($idCategoria) {

            $idCategoria = addslashes($idCategoria);
            $totalProduto = 0;

            if (!empty($idCategoria)) {

                $qtProdutos = new ProdutoModels();
                $totalProduto = $qtProdutos->getProdutosByIdCategoria($idCategoria, TRUE);
                IF ( $totalProduto > 0 ) {
                   // EXISTEM PRODUTOS VINCULADOS A ESTA CATEGORIA
                ?>
                    <script type="text/javascript">
                        var cf= confirm("Categoria não pode ser cancelada !!") ;
                        if(cf) {

                        }
                    </script> 
                <?php
                }
                else {

                    $cancelar = new CategoriasModels();
                    $cancelar = $cancelar->apagarCategorias($idCategoria);

                }

            }
            header("Location: /painel/categorias");

        }

        public function addCategorias() {
            
            $dados = array();
            
            if ( isset($_POST['titulo']) && !empty($_POST['titulo'])) {
                $categoria = new CategoriasModels();
                $idAdicionado = $categoria->addCategorias($_POST['titulo']);

                header("Location: /painel/categorias");
                
            }
            
            $this->TemplateView("categoriaAdd", $dados);

        }
        
        public function alteraCategorias($idCategoria) {
        
            $dados = array();
            $categoria = new CategoriasModels();
            
            if ( isset($_POST['titulo']) && !empty($_POST['titulo'])) {
                $idAdicionado = $categoria->alterarCategorias($idCategoria, $_POST['titulo']);

                header("Location: /painel/categorias");
                
            }
            $dados['categoria'] = $categoria->getCategorias($idCategoria);
            
            $this->TemplateView("categoriaEditar", $dados);

        }
        
        
        
    }

    
?>
