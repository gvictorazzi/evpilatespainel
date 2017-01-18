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
<h2>Cadastro de Estados Brasileiros</h2>

<br>
    <?php if ($editPermission): ?>
        <img src="<?php echo BASE_URL; ?>/assets/images/adicionar.png" width="40" height="30" />
        <a href="<?php echo BASE_URL; ?>/clients/citiesAdd" class="btn btn-default" disabled>Adicionar Estado</a>
    <?php endif; ?>
<hr/>
<table class="table table-bordered table-striped table-hover table-responsive table-condensed">
    <thead>
        <tr>
            <th>Nome do Estado </th>
            <th>Sigla</th>
            <th>Código</th>
            <th>Capital</th>
            <th>Região</th>
            <th style="text-align: center;">Bandeira</th>
        </tr>
    </thead>
    <?php foreach ($citiesList as $item): ?>
    <tr>
        <td><?php echo $item['UF_NOME']; ?></td>
        <td><?php echo $item['SIGLA_UF']; ?></td>
        <td><?php echo $item['UF_CODIGO']; ?></td>
        <td><?php echo $item['UF_CAPITAL']; ?></td>
        <td><?php echo $item['UF_REGIAO']; ?></td>
        <td style="text-align: center;"><img src='<?php echo BASE_URL ?>/assets/images/bandeiras/<?php echo $item['UF_BANDEIRA'].".png"  ;?>' height="20"/></td>

    </tr>
    <?php endforeach; ?>
</table>


<div class="indexPaginas">
    <a href='<?php echo BASE_URL ;?>/cities/?p=<?php echo $paginaAtual-1; ?>'><img id='seta' src='<?php echo BASE_URL;?>/assets/images/setaesquerda_um.png' /></a>
    <a href='<?php echo BASE_URL ;?>/cities/?p=1'><img id='seta' src='<?php echo BASE_URL;?>/assets/images/setaesquerda.png' /></a>
    <ul class="pagination pagination-sm">
        <?php for ($p = $paginaInicial; $p<= $limite; $p++):?>
        <li class='<?php echo ($p==$paginaAtual) ?"active" :""; ?>'><a href='<?php echo BASE_URL ;?>/cities/?p=<?php echo $p; ?>'><?php echo $p; ?></a></li>
        <?php endfor; ?>
    </ul>
    <a href='<?php echo BASE_URL ;?>/cities/?p=<?php echo $totalPaginas; ?>'><img id='seta' src='<?php echo BASE_URL;?>/assets/images/setadireita.png' /></a>
    <a href='<?php echo BASE_URL ;?>/cities/?p=<?php echo $paginaAtual+1; ?>'><img id='seta' src='<?php echo BASE_URL;?>/assets/images/setadireita_um.png' /></a>
</div>

<div style="clear: both"></div>
