<style type="text/css">
    thead {
        background-color: #23527c;
        color: white;
    }

    img {
        width: 25px;
        height: 25px;
    }
    
    #seta {
        width: 25px;
        height: 25px;
        float: none;
        margin-bottom: 65px;
    }
    .adicionar {
        width: 50px;
        height: 40px;
    }

</style>

<h2 style="margin-left: 10px;">Cadastro de Usuários Sistemas</h2>
<hr/>
<div class="container-fluid col-sm-12">

    <div id="viaturas" >
        <img class="adicionar" src="<?php echo BASE_URL; ?>/assets/images/adicionar.png" alt="Ícone da Operação Adicionar"/>
        <a href="<?php echo BASE_URL; ?>/usuarios/add" class="btn btn-default">Adicionar Usuários</a>
        <hr/>
        <table class="table table-bordered table-striped table-hover table-responsive table-condensed">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Username</th>
                    <th>E-mail</th>
                    <th>Grupo de Acesso</th>
                    <th>Ativo</th>
                    <th width="150">Ação</th>
                </tr>
            </thead>
            <?php foreach ($usuario as $item): ?>
            <tr>
                <td><?php echo $item['nomeusu']; ?></td>
                <td><?php echo $item['username']; ?></td>
                <td><?php echo $item['email'] ?></td>
                <td><?php echo $item['NAME'] ?></td>
                <td><?php echo ($item['status']) == '1' ? "SIM" : "NÃO" ;?></td>
                <td>
                    <a href="<?php echo BASE_URL ;?>/usuarios/edit/<?php echo $item['idUsuario']; ?>"><img src="<?php echo BASE_URL; ?>/assets/images/alterar.png" /></a>
                    <a href="<?php echo BASE_URL ;?>/usuarios/deactivated/<?php echo $item['idUsuario']; ?>"><img src="<?php echo BASE_URL; ?>/assets/images/desativar.png"/></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <table style='font-size:12px;' class='table table-bordered'>
            <tr>
                <td>Total de Registros</td>
                <td style='color:red; width: 100px; text-align: right;'><?php echo $totalRegistros; ?></td>
            </tr>
        </table>
        <div class="indexPaginas">
            <a href='<?php echo BASE_URL ;?>/usuarios/?p=<?php echo $paginaAtual-1; ?>'><img id='seta' src='<?php echo BASE_URL;?>/assets/images/setaesquerda_um.png' /></a>
            <a href='<?php echo BASE_URL ;?>/usuarios/?p=1'><img id='seta' src='<?php echo BASE_URL;?>/assets/images/setaesquerda.png' /></a>
            <ul class="pagination pagination-sm">
                <?php for ($p = $paginaInicial; $p<= $limite; $p++):?>
                <li class='<?php echo ($p==$paginaAtual) ?"active" :""; ?>'><a href='<?php echo BASE_URL ;?>/usuarios/?p=<?php echo $p; ?>'><?php echo $p; ?></a></li>
                <?php endfor; ?>
            </ul>
            <a href='<?php echo BASE_URL ;?>/usuarios/?p=<?php echo $totalPaginas; ?>'><img id='seta' src='<?php echo BASE_URL;?>/assets/images/setadireita.png' /></a>
            <a href='<?php echo BASE_URL ;?>/usuarios/?p=<?php echo $paginaAtual+1; ?>'><img id='seta' src='<?php echo BASE_URL;?>/assets/images/setadireita_um.png' /></a>
        </div>


    </div>

</div>
