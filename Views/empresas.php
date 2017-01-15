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

<h2>Cadastro da Empresa</h2>

<br>
    <?php if ($editPermission): ?>
        <img src="<?php echo BASE_URL; ?>/assets/images/adicionar.png" width="40" height="30" />
        <a href="<?php echo BASE_URL; ?>/parametros" class="btn btn-default" disabled >Adicionar Empresa</a>
    <?php endif; ?>

<hr/>
<div class="container-fluid col-sm-12">

    <table class="table table-bordered table-striped table-hover table-responsive table-condensed" >
        <thead>
            <tr>
                <th>Nome</th>
                <th>Fantasia</th>
                <th>Cidade</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tr>
            <td><?php echo $empresa['emp_nome']; ?></td>
            <td><?php echo $empresa['emp_fanta']; ?></td>
            <td><?php echo $empresa['emp_cidade']; ?></td>
            <td><?php echo $empresa['emp_fone']." / ".$empresa['emp_celular']; ?></td>
            <td><?php echo $empresa['emp_email'] ;?></td>
            <td>
                <a href="<?php echo BASE_URL ;?>/permissions/alterarEmpresa/<?php echo $empresa['id']; ?>"><img src="<?php echo BASE_URL; ?>/assets/images/alterar.png" width="30" height="30" /></a>
                <a href="<?php echo BASE_URL ;?>/permissions/desativaEmpresa/<?php echo $empresa['id']; ?>"><img src="<?php echo BASE_URL; ?>/assets/images/desativar.png" width="30" height="30" /></a>
            </td>
        </tr>
    </table>
</div>
