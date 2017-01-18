<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo BASE_URL; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo BASE_URL;?>/assets/css/navbarpadrao.css" rel="stylesheet">
        <link href="<?php echo BASE_URL;?>/assets/css/template.css" rel="stylesheet">
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
                            <li><a href='<?php echo BASE_URL."/permissions";?>'><img src="<?php echo BASE_URL.'/assets/images/key.png' ;?>" width="20" height="20" style="margin-right: 20px;" />Controle de Acesso</a></li>
                            <li><a href='<?php echo BASE_URL."/usuarios";?>'><img src="<?php echo BASE_URL.'/assets/images/usuarios.png' ;?>" width="20" height="20" style="margin-right: 20px;" />Usuários Sistema</a></li>
                        </ul>
                    </li>
                    <li class='dropdown'>
                        <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                            <?php echo 'Cadastros';?>
                           <span class='caret'></span>
                        </a>
                        <ul class='dropdown-menu'>
                            <li><a href='<?php echo BASE_URL."/professor";?>'><img src="<?php echo BASE_URL.'/assets/images/professores.png' ;?>" width="20" height="20" style="margin-right: 20px;" />Professores</a></li>
                            <li><a href='<?php echo BASE_URL."/Modalidade";?>'><img src="<?php echo BASE_URL.'/assets/images/modalidade.png' ;?>" width="20" height="20" style="margin-right: 20px;" />Modalidades</a></li>
                            <li><a href='<?php echo BASE_URL."/Eventos";?>'><img src="<?php echo BASE_URL.'/assets/images/eventos.png' ;?>" width="20" height="20" style="margin-right: 20px;" />Eventos</a></li>
                            <li><a href='<?php echo BASE_URL."/Salas";?>'><img src="<?php echo BASE_URL.'/assets/images/sala.png' ;?>" width="20" height="20" style="margin-right: 20px;" />Salas/Setores</a></li>
                        </ul>
                    </li>
                    <li><a href='<?php echo BASE_URL."/alunos";?>'>Alunos</a></li>
                    <li><a href='<?php echo BASE_URL."/agendas";?>'>Agendas</a></li>
                    <li><a href='<?php echo BASE_URL."/tabelas";?>'>Relatórios</a></li>
                    <li class='dropdown'>
                        <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                            <?php echo 'Tabelas';?>
                           <span class='caret'></span>
                        </a>
                        <ul class='dropdown-menu'>
                            <li><a href='<?php echo BASE_URL."/precoscursos";?>'>Preços Modalidades</a></li>
                        </ul>
                    </li>
                    
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class='dropdown'>
                        <a class='dropdown-toggle' data-toggle='dropdown' href='#'>

                            <?php echo $viewData['user_name'];?>
                           <span class='caret'></span>
                        </a>
                        <ul class='dropdown-menu'>
                            <li><a href='<?php echo BASE_URL."/perfil" ;?>'><img src="<?php echo BASE_URL.'/assets/images/perfil.png' ;?>" width="20" height="20" style="margin-right: 20px;" />Editar Perfil</a></li>
                            <li><a href='<?php echo BASE_URL."/sair" ;?>'><img src="<?php echo BASE_URL.'/assets/images/sair.png' ;?>" width="20" height="20" style="margin-right: 20px;" />Sair</a></li>
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
