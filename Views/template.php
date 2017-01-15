<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo BASE_URL; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo BASE_URL;?>/assets/css/navbarpadrao.css" rel="stylesheet">
        <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.min.js"></script>        
        <title>EVPilates - Painel de Controle</title>
        <script type="text/javascript">
            var BASE_URL = '<?php echo BASE_URL; ?>';
        </script>
        <title>Painel Administrativo</title>
    </head>
    <body>
        <div class="navbar navbar-default">
            <div class="container-fluid" >
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo BASE_URL.'/home';?>">Home</a></li>
                    <li class='dropdown'>
                        <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                            <?php echo 'Parâmetros';?>
                           <span class='caret'></span>
                        </a>
                        <ul class='dropdown-menu'>
                            <li><a href='<?php echo BASE_URL."/parametros";?>'>Empresa</a></li>
                            <li><a href='<?php echo BASE_URL."/permissions";?>'>Controle de Acesso</a></li>
                            <li><a href='<?php echo BASE_URL."/login/logout";?>'>Sair</a></li>
                        </ul>
                    </li>
                    <li class='dropdown'>
                        <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                            <?php echo 'Cadastros';?>
                           <span class='caret'></span>
                        </a>
                        <ul class='dropdown-menu'>
                            <li><a href='<?php echo BASE_URL."/professores";?>'>Professores</a></li>
                            <li><a href='<?php echo BASE_URL."/Modalidade";?>'>Modalidades</a></li>
                            <li><a href='<?php echo BASE_URL."/Salas";?>'>Salas/Setores</a></li>
                        </ul>
                    </li>
                    <li><a href='<?php echo BASE_URL."/agendas";?>'>Agendas</a></li>
                    <li><a href='<?php echo BASE_URL."/Tabelas";?>'>Relatórios</a></li>
                    
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class='dropdown'>
                        <a class='dropdown-toggle' data-toggle='dropdown' href='#'>

                            <?php echo $viewData['user_name'];?>
                           <span class='caret'></span>
                        </a>
                        <ul class='dropdown-menu'>
                            <li><a href='<?php echo BASE_URL."/perfil" ;?>'>Editar Perfil</a></li>
                            <li><a href='<?php echo BASE_URL."/sair" ;?>'>Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container-fluid">
           <?php $this->loadViewInTemplate($viewName,$viewData ); ?>        
        </div>        

    </body>
</html>
