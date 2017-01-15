<?php

    class model {
        
        protected $dbConexao;
        
        public function __construct() {
            global $config;
            $dbName = "mysql:dbname=".$config['dbname'].";host=".$config['host'];
            $dbUser = $config['dbuser'];
            $dbPass = $config['dbpass'];

            try {

                $this->dbConexao = new PDO($dbName, $dbUser, $dbPass);

            } catch (Exception $ex) {
            
                echo "Falha na conexão : ".$ex->getMessage();

            }
        }
    }
    
    
?>
