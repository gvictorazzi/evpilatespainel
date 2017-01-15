<?php
session_start();

require 'config.php';

spl_autoload_register(function($class) {

    global $config;
    if (strpos($class, "Controller") > 0)  
    {
        if (file_exists($config['Controller'].$class.".php")) 
        {
            require_once($config['Controller'].$class.'.php');
        }
    } elseif ( strpos($class, "Models") > -1 ) 
    {
        if (file_exists($config['Models'].$class.".php")) 
        {
            require_once($config['Models'].$class.'.php');
        }
    } elseif (file_exists($config['Core'].$class.".php")) 
    {
        require_once($config['Core'].$class.'.php');
    }
           
});
    
$core = new Core();
$core->process();


?>
