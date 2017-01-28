<style>
    thead {
        background-color: #23527c;
        color: white;
    }
    
    #seta {
        width: 25px;
        height: 25px;
        float: none;
        margin-bottom: 65px;
    }

</style>
<h2>Cadastro de Tipo de Contato</h2>

<br>
    <img src="<?php echo BASE_URL; ?>/assets/images/adicionar.png" width="30" height="30" />
    <a href="<?php echo BASE_URL; ?>/contatos/add" class="btn btn-default" >Adicionar Contatos</a>
<hr/>
<table class="table table-bordered table-striped table-hover table-responsive table-condensed">
    <thead>
        <tr>
            <th>Nome do Contato/th>
            <th>ID</th>
            <th>Icone</th>
            <th>Ações</th>
        </tr>
    </thead>
    <?php foreach ($contatos as $item): ?>
    <tr>
        <td><?php echo $item['contato_tipo']; ?></td>
        <td><?php echo $item['id']; ?></td>
        <td><img src="<?php echo BASE_URL;?>/assets/images/cadastros/<?php echo $item['link_icone']; ?>" style="width:30px; height: 30px;" /></td>
        <td></td>
    </tr>
    <?php endforeach; ?>
</table>


<div class="indexPaginas">
    <a href='<?php echo BASE_URL ;?>/contatos/?p=<?php echo $paginaAtual-1; ?>'><img id='seta' src='<?php echo BASE_URL;?>/assets/images/setaesquerda_um.png' /></a>
    <a href='<?php echo BASE_URL ;?>/contatos/?p=1'><img id='seta' src='<?php echo BASE_URL;?>/assets/images/setaesquerda.png' /></a>
    <ul class="pagination pagination-sm">
        <?php for ($p = $paginaInicial; $p<= $limite; $p++):?>
        <li class='<?php echo ($p==$paginaAtual) ?"active" :""; ?>'><a href='<?php echo BASE_URL ;?>/contatos/?p=<?php echo $p; ?>'><?php echo $p; ?></a></li>
        <?php endfor; ?>
    </ul>
    <a href='<?php echo BASE_URL ;?>/contatos/?p=<?php echo $totalPaginas; ?>'><img id='seta' src='<?php echo BASE_URL;?>/assets/images/setadireita.png' /></a>
    <a href='<?php echo BASE_URL ;?>/contatos/?p=<?php echo $paginaAtual+1; ?>'><img id='seta' src='<?php echo BASE_URL;?>/assets/images/setadireita_um.png' /></a>
</div>

<div style="clear: both"></div>
