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

<h2 style="margin-left: 10px;">Cadastro de Professores</h2>
<hr/>
<div class="container-fluid col-sm-12">

    <div id="viaturas" >
        <img class="adicionar" src="<?php echo BASE_URL; ?>/assets/images/adicionar.png" alt="Ícone da Operação Adicionar" style='width: 30px; height: 30px;'/>
        <a href="<?php echo BASE_URL; ?>/professor/add" class="btn btn-default">Adicionar Professores</a>
        <hr/>
        <table class="table table-bordered table-striped table-hover table-responsive table-condensed">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone/Celular</th>
                    <th>Modalidades</th>
                    <th>Ativo</th>
                    <th width="150">Ação</th>
                </tr>
            </thead>
            <?php foreach ($professor as $item): ?>
            <tr>
                <td><?php echo $item['prof_nome']; ?></td>
                <td><?php echo $item['prof_email']; ?></td>
                <td><?php echo $item['prof_tel']." / ".$item['prof_cel'] ?></td>
                <td><?php echo $item['prof_modalidade'] ?></td>
                <td><?php echo ($item['prof_status']) == '1' ? "SIM" : "NÃO" ;?></td>
                <td>
                    <a href="<?php echo BASE_URL ;?>/professor/edit/<?php echo $item['idProf']; ?>"><img src="<?php echo BASE_URL; ?>/assets/images/alterar.png" /></a>
                    <a href="<?php echo BASE_URL ;?>/professor/deactivated/<?php echo $item['idProf']; ?>"><img src="<?php echo BASE_URL; ?>/assets/images/desativar.png"/></a>
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
