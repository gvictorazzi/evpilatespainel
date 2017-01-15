<style>
    .container {
    .container {
        width: 100%;
        float: left;
        border-bottom: 2px solid #000;
        border-top: 2px solid #000;
        padding: 5px;
    }

    form {
        padding-top: 40px;
    }

    input[type="text"] {
        padding: 5px;
        border-radius: 2px;
        border: 1px solid black;
    }

    label {
        font-size: 15px;
    }

</style>
<h2>Cadastro de Grupos Permissões</h2>
<hr/>
<div class="container">
    <form method="POST">

        <label for="pname">Nome do Grupo</label><br>
        <input type="text" name="pname" size="40" maxlength="50" />
        <br><br>
        <label for="lname">Descrição do Grupo</label><br>
        <input type="text" name="lname" size="80" maxlength="200" />
        <br><br>
        <label>Acesso aos Módulos</label><br>
        <table class="table table-striped">
            <thead style="background-color: black; color: white;">
                <tr>
                    <th>Módulo</th>
                    <th>Descrição do Módulo</th>
                    <th>Status</th>
                    <th>Liberar</th>
                </tr>
            </thead>
            <?php foreach ($permissionsList as $item) : ?>
                <tr>
                    <td><?php echo $item['NAME']; ?></td>
                    <td><?php echo $item['LONGNAME']; ?></td>
                    <td><?php echo $item['STATUS']; ?></td>
                    <td><input type="checkbox" name="permiGroup[]" value="<?php echo $item['ID'] ?>" /></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <br><br>
        <label for="pstatus">Status do Grupo</label>
        <select name="pstatus">
            <option value="SIM">Ativado</option>
            <option value="NAO">Desativado</option>
        </select>
        <br><br>
        <input type="submit" class="btn btn-default" value="Gravar"/>


    </form>

</div>
