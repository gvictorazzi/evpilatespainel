<?php
// Arquivo de configuração de Banco de Dados
require 'environment.php';
global $config;

$config = array();

define("BASE_URL", "http://localhost/evpilates/painel");
define("BASE_IMAGENS", "http://localhost/evpilates/painel/assets/images");

if ( ENVIRONMENT == "development") {
    // ambiente de desenvolvimento
    $config['dbname'] = "evpilates";
    $config['host'] = "127.0.0.1";
    $config['dbuser'] = "root";
    $config['dbpass'] = "";
} else {
    // ambiente de produção
    $config['dbname'] = "evpilates";
    $config['host'] = "localhost";
    $config['dbuser'] = "root";
    $config['dbpass'] = "";
    
}

$config['Controller'] = "../painel/Controllers/";
$config['Models'] = "../painel/Models/";
$config['Core'] = "../painel/Core/";




?>
