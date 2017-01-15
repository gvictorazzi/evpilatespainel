<?php

    /*
     * Site Institucional com estrutura MVC
     */

    class ProdutosController extends Controller {
        
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
            
            $produto = new ProdutoModels();
            $dados['limiteProdutos'] = $limite;
            $dados['totalProdutos'] = $produto->getTotalProdutos();
            $dados['produtos'] = $produto->getProdutos($offset, $limite); 
            
            $this->TemplateView("produtos", $dados);

        }
    
        public function addProdutos() {
            $tiposdeImagem = ["image/jpg", "image/jpeg", "mage/png"];
            $dados = array(
                "categorias" => array()
            );
            
            $cat = new CategoriasModels();
            $dados['categorias'] = $cat->getCategorias();
            
            if (isset($_POST['produto']) && !empty($_POST['produto'])) {
                
                if ( isset($_FILES['imagem']) && !empty($_FILES['imagem']['tmp_name'])) {
                    
                    $produto = addslashes($_POST['produto']);
                    $descricao = addslashes($_POST['descricao']);
                    $categoria = addslashes($_POST['categoria']);
                    $preco = addslashes($_POST['preco']);
                    $quantidade = addslashes($_POST['quantidade']);
                    $imagem = $_FILES['imagem'];

                    if ( in_array($imagem['type'], $tiposdeImagem )) {
                        if ( $imagem['type'] === "image/png") {
                            $extensao = "png";
                        }
                        else {
                            $extensao = "jpg";
                        }
                        $md5Imagem = md5(time().rand(0,9999)).".".$extensao;
                        move_uploaded_file($imagem['tmp_name'],"../assets/images/galeria/".$md5Imagem );

                        $produtoNovo = new ProdutoModels();
                        $produtoNovo->inserirProdutos($produto, $descricao, $categoria, $preco, $quantidade, $md5Imagem);
                        
                        header("Location: /painel/produtos");
                    }

                }
            }
            
            $this->TemplateView("produtosAdd", $dados);

        }


        public function alteraProdutos($idProduto) {
            $tiposdeImagem = ["image/jpg", "image/jpeg", "mage/png"];
            $dados = array(
                "produto" => array(),
                "categorias" => array()
            );

            
            $cat = new CategoriasModels();
            $dados['categorias'] = $cat->getCategorias();

            $produtoNovo = new ProdutoModels();
            $dados['produto'] = $produtoNovo->getProdutosById($idProduto);
            
            if ( isset($_POST['produto']) && !empty($_POST['produto'])) {
                    
                $produto = $_POST['produto'];
                $descricao = $_POST['descricao'];
                $categoria = addslashes($_POST['categoria']);
                $preco = addslashes($_POST['preco']);
                $quantidade = addslashes($_POST['quantidade']);
                
                $produtoNovo->AtualizaProdutos($idProduto, $produto, $descricao, $categoria, $preco, $quantidade);
                
                if ( isset($_FILES['imagem']) && !empty($_FILES['imagem']['tmp_name'])) {
                    $imagem = $_FILES['imagem'];

                    if ( in_array($imagem['type'], $tiposdeImagem )) {
                        if ( $imagem['type'] === "image/png") {
                            $extensao = "png";
                        }
                        else {
                            $extensao = "jpg";
                        }
                        $md5Imagem = md5(time().rand(0,9999)).".".$extensao;
                        move_uploaded_file($imagem['tmp_name'],"../assets/images/galeria/".$md5Imagem );

                        $produtoNovo->atualizaImagem($idProduto, $md5Imagem);
                        
                    }

                }
                header("Location: /painel/produtos");

            }
 
            
            $this->TemplateView("produtosEditar", $dados);

        }

        
        
        
        
        
        
    }  
    
?>
