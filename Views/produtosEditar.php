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
        <h1>Produtos - Editar</h1>
        
        <div class="col-sm-6">
            
        
        <form method="POST" enctype="multipart/form-data">
            
            <label>Nome do Produto</label><br>
            <input type="text" name="produto" value="<?php echo $produto['nome'];?>" placeholder="Nome do produto..." size="200" class="form-control"/>
            <br>
            <label>Descrição do Produto</label>
            <textarea name="descricao" rows="5" cols="80" class="form-control"  placeholder="Descrição do Produto"><?php echo $produto['descricao'] ?></textarea><br>
            <select name="categoria" class="form-control">
                <?php foreach ($categorias as $item): ?>
                <option <?php echo ($item['id']===$produto['id_categoria']) ? "selected='selected'":""; ?> value="<?php echo $item['id'] ;?>"><?php echo utf8_encode( $item['titulo']) ?></option>
                <?php endforeach;?>
            </select> <br>
            <input type="text" name="preco" class="form-control" value="<?php echo $produto['preco'] ?>" placeholder="Preço" /><br>
            <input type="text" name="quantidade" class="form-control" value="<?php echo $produto['quantidade'] ?>" placeholder="Qtdade em Estoque" /><br>
            <input type="file" name="imagem" />
            <br>
            
            <input type="submit" value="Gravar" class="btn btn-default">
            
        </form>
        </div>
        <div class="col-sm-6">
            <img src="/../assets/images/galeria/<?php echo $produto['imagem'] ?>" />
            
        </div>
        
    </body>
</html>
