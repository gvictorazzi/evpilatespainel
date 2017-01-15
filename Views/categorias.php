<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Painel Administrativo</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="../assets/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    </head>
    <body>
        <h1>Categorias</h1>
        <a href="/painel/categorias/addCategorias" class="btn btn-default">Adicionar Categorias</a>
        
        <table class="table table-striped" >
            <thead>
                <tr>
                    <th>Nome da Categoria</th>
                    <th width='150px'>Ações</th>
                </tr>
                <hr/>
            </thead>
                <?php foreach ($categoria as $item): ?>
                <tr>
                    <td><?php echo utf8_encode( $item['titulo']) ; ?></td>
                    <td>
                        <a href='/painel/categorias/alteraCategorias/<?php echo $item['id']; ?>' class='btn btn-default' style="width: 60px; height: 30px;" >Editar</a>
                        <a href='/painel/categorias/apagarCategorias/<?php echo $item['id']; ?>' class='btn btn-danger' style="width: 60px; height: 30px;" >Excluir</a>
                    </td>
                </tr>
                <?php endforeach;?>
            
            
        </table>
        
        
        
    </body>
</html>
