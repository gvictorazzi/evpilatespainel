<?php

class CategoriasModels extends model {
    
    public function __construct() {
        parent::__construct();
    }

    public function getCategorias($idCategoria = 0 ) {
        $dados = array();
        
        $idCategoria = addslashes($idCategoria);
        if ( $idCategoria == 0 ) {
            $sqlComando = "SELECT * FROM categorias";
            $sqlComando = $this->dbConexao->query($sqlComando);
            if ( $sqlComando->rowCount() > 0 ) {
                $dados = $sqlComando->fetchAll();
            }
            
        } else {
            $sqlComando = "SELECT * FROM categorias WHERE id = '$idCategoria'";
            $sqlComando = $this->dbConexao->query($sqlComando);
            if ( $sqlComando->rowCount() > 0 ) {
                $dados = $sqlComando->fetch();
            }
            
        }
        return $dados;
        
    }
    
    public function addCategorias($titulo) {
        
        $ultId = 0;
        
        if (!empty($titulo)) {
            
            $titulo = addslashes($titulo);
            $sqlComando = "INSERT INTO categorias SET titulo='$titulo'";
            $sqlComando = $this->dbConexao->query($sqlComando);

            $ultId = $this->dbConexao->lastInsertId();
        }

        return $ultId;
        
    }
    
    
    public function alterarCategorias($idCategoria, $titulo) {
        
        $ultId = 0;
        $idCategoria = addslashes($idCategoria);
        $titulo = addslashes($titulo);
        
        if (!empty($idCategoria) && !empty($titulo)) {
            
            $sqlComando = "UPDATE categorias SET titulo='$titulo' WHERE id = '$idCategoria'";
            $sqlComando = $this->dbConexao->query($sqlComando);
        }

        
    }
    
    
    public function apagarCategorias($idCategoria) {
        
        $idCategoria = addslashes($idCategoria);
        If (!empty($idCategoria)) {

            $sqlComando = "DELETE FROM categorias WHERE id='$idCategoria'";
            $sqlComando = $this->dbConexao->query($sqlComando);
            
        }
        
    }
    
    
}