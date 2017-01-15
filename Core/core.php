<?php


class Core {

    public function process() {
        //$url = $_SERVER['REQUEST_URI'];
        $parametros = array();
        $url = explode("index.php", filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_DEFAULT ));

        $url = end($url);
        if(!empty($url) && $url != '/') {        
            $url = explode("/", $url);
            array_shift($url);
            $currentController = $url[0]."Controller";
            array_shift($url);
            
            if ( isset($url[0]) && !empty($url[0]) ) {
                $currentAction = $url[0];
                array_shift($url);
            } else {
                $currentAction = "index";
            }
            // sobra um array apenas com os parâmetros
            if (count($url) > 0 ) {
                $parametros = $url;
            }
            
        } else {
            $currentController = "HomeController";
            $currentAction = "index";
        }

        $c = new $currentController();
        call_user_func_array(array($c, $currentAction), $parametros);
        
    }
    
}

