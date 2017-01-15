<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
global $config;
?>
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
        <h1>Venda - Detalhe Pedido No.:<?php echo $vendas['id_venda']; ?></h1>
        
        <table class="table table-striped table-responsive table-hover" >
            <thead>
                <tr>
                    <th width="50">Produto</th>
                    <th>Nome do Produto</th>
                    <th>Quantidade</th>
                </tr>
                <hr/>
            </thead>
                <?php foreach ($vendas as $item): ?>
                <tr>
                    <td><?php echo $item['id']?></td>
                    <td><?php echo utf8_encode($item['cliente']); ?></td>
                    <td align="right"><?php echo "R$ ".number_format($item['valor'], 2, ",", "."); ?></td>                    
                    <td><?php echo utf8_encode($item['tppagto']); ?></td>
                    <td align="center"><?php echo $config['statuspagto'][$item['statuspagto']]; ?></td>
                    <td>
                        <a href='/painel/vendas/ver/p?=<?php echo $item['id']; ?>' class='btn btn-success' style="width: 80px; height: 30px;" >Detalhar</a>
                    </td>
                </tr>
                <?php endforeach;?>
        </table>
        <ul class="pagination">
        <?php
        $paginas = ceil( $totalVendas / $limiteProdutos );// arredondar
      
        for ($q=1; $q<=$paginas; $q++): ?>
        
            <li><a href="/painel/vendas/?p=<?php echo $q ?>"><?php echo $q; ?></a></li>
        
        
        <?php endfor;
        ?>
        </ul>
        
        
        
    </body>
</html>
