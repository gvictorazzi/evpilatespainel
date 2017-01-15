<style>
    .nav-tabs li {
        width: 200px;
    }

    div .permi {
        width: 100%;
    }
    thead {
        background-color: #23527c;
        color: white;
    }


</style>
<h2>Controle de Acesso ao Sistema
<img src="<?php echo BASE_URL; ?>/assets/images/ACCESS.png" width="60" height="60" />
</h2>
<hr/>
<div class="container-fluid col-sm-12">

    <ul class="nav nav-tabs">

        <li class="active"><a href="#grupo" data-toggle="tab">Grupo de Permissões</a></li>
        <li><a href="#permi" data-toggle="tab">Permissões</a></li>
    </ul>
    <div class="tab-content">
        <div id="grupo" class="tab-pane active in">
            <br>
            <img src="<?php echo BASE_URL; ?>/assets/images/adicionar.png" width="40" height="30" />
            <a href="<?php echo BASE_URL; ?>/permissions/addGroup" class="btn btn-default">Adicionar Grupo</a>
            <hr/>
            <table class="table table-bordered table-striped table-hover table-responsive table-condensed">
                <thead>
                    <tr>
                        <th>Grupo</th>
                        <th>Descrição do Grupo</th>
                        <th>Permissões</th>
                        <th>Ativo</th>
                        <th width="110">Ação</th>
                    </tr>
                </thead>
                <?php foreach ($permissionsGroup as $item): ?>
                <tr>
                    <td><?php echo $item['NAME']; ?></td>
                    <td><?php echo $item['LONGNAME']; ?></td>
                    <td><?php echo $item['PARAMS']; ?></td>
                    <td><?php echo $item['STATUS'] ?></td>
                    <td>
                        <a href="<?php echo BASE_URL ;?>/permissions/alterarGroup/<?php echo $item['ID']; ?>"><img src="<?php echo BASE_URL; ?>/assets/images/alterar.png" width="30" height="30" /></a>
                        <a href="<?php echo BASE_URL ;?>/permissions/deactivatedGroup/<?php echo $item['ID']; ?>"><img src="<?php echo BASE_URL; ?>/assets/images/desativar.png" width="30" height="30" /></a>
                        <a href="<?php echo BASE_URL ;?>/permissions/deleteGroup/<?php echo $item['ID']; ?>" onclick="return confirm('Deseja Cancelar esta Permissão ?');"><img src="<?php echo BASE_URL; ?>/assets/images/remover.png" width="30" height="30" /></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div id="permi" class="tab-pane">
            <br>
            <img src="<?php echo BASE_URL; ?>/assets/images/adicionar.png" width="40" height="30" />
            <a href="<?php echo BASE_URL; ?>/permissions/add" class="btn btn-default">Adicionar Permissão</a>
            <hr/>
            <table class="table table-bordered table-striped table-hover table-responsive table-condensed">
                <thead>
                    <tr>
                        <th>Permissão</th>
                        <th>Descrição do Módulo</th>
                        <th>Ativa</th>
                        <th width="110">Ação</th>
                    </tr>
                </thead>
                <?php foreach ($permissionsList as $item): ?>
                <tr>
                    <td><?php echo $item['NAME']; ?></td>
                    <td><?php echo $item['LONGNAME']; ?></td>
                    <td><?php echo $item['STATUS']; ?></td>
                    <td>
                        <a href="<?php echo BASE_URL ;?>/permissions/alterar/<?php echo $item['ID']; ?>"><img src="<?php echo BASE_URL; ?>/assets/images/alterar.png" width="30" height="30" /></a>
                        <a href="<?php echo BASE_URL ;?>/permissions/deactivated/<?php echo $item['ID']; ?>"><img src="<?php echo BASE_URL; ?>/assets/images/desativar.png" width="30" height="30" /></a>
                        <a href="<?php echo BASE_URL ;?>/permissions/delete/<?php echo $item['ID']; ?>" onclick="return confirm('Deseja Cancelar esta Permissão ?');"><img src="<?php echo BASE_URL; ?>/assets/images/remover.png" width="30" height="30" /></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>

</div>
