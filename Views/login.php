<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>EVPilates - Login Painel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo BASE_URL.'/assets/css/bootstrap.min.css';?>" rel="stylesheet">
        <script type="text/javascript" src="<?php echo BASE_URL.'/assets/js/jquery-3.1.1.min.js';?>"></script>
        <script type="text/javascript" src="<?php echo BASE_URL.'/assets/js/bootstrap.min.js' ;?>"></script>
        
        <style type="text/css">
            body {
                background-image: url('<?php echo BASE_IMAGENS."/assets/images/iconeevpilates_back.png" ;?>');
            }
            
            input[type='text'],
            input[type='password'] {
                padding: 10px;
                border-radius: 5px;
                background-color:#EFEFEF;
            }
        </style>
    </head>
    <body>
        <div class="col-sm-4"></div>
        <div class="container col-sm-3 alert" style="background-color: #F9F9F9; margin-top: 10px;" >
            <h1 align="center"><img  src="<?php echo BASE_IMAGENS.'/assets/images/iconeevpilates.png' ;?>" width="80px" height="80px;" /></h1>
   
            <div class="alert-danger"><?php if (!empty($aviso)) { echo $aviso; }; ?></div>
            <form method="POST" autocomplete="off">
                <strong></strong><br>
                <input type="text" name="usuario" class="form-control" autofocus="true" required placeholder="Usuario..."/><br><br>
                <strong></strong><br>
                <input type="password" name="senha" class="form-control" placeholder="Senha..."/><br><br>
                <input type="submit" value="Acessar Sistema" class="btn btn-default center-block"/>
                
            </form>
        </div>
        <div class="col-sm-4"></div>
    </body>
</html>
