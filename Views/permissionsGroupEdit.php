<style>
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

    input[type="text"],
    select {
        padding: 5px;
        border-radius: 2px;
        border: 1px solid black;
    }

    .col-sm-2 {
        font-weight: bold;
    }

    .row {
        margin-top: 5px;
    }
    
    .prompt {
        line-height:30px; 
        height: 30px;
        background-color: #d5d5d5;
        margin-left: 15px;        
    }

    .gravar {

        float: right;
        margin-top: 10px;
        padding: 10px;

    }


    label {
        font-size: 15px;
    }

</style>
<h2>Cadastro de Grupos Permissões</h2>
<hr/>
<div class="container">
    <form method="POST">

        <div class="row">
            <div class="col-sm-2 prompt">Nome do Grupo</div>
            <div class="col-sm-4">
                <input type="text" name="pname" value="<?php echo $groupInfo['NAME']; ?>" size="40" maxlength="50" class="form-control" />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 prompt">Descrição do Grupo</div>
            <div class="col-sm-4">
                <input type="text" name="lname" value= "<?php echo $groupInfo['LONGNAME']; ?>" size="80" maxlength="200" class="form-control" />
            </div>
            <div class="col-sm-2 prompt">Status do Grupo</div>
            <div class="col-sm-2">
                <select name="pstatus" value="<?php echo $groupInfo['STATUS']; ?>">
                    <option value="SIM">Ativado</option>
                    <option value="NAO">Desativado</option>
                </select>
            </div>
        </div>
        <hr/>
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
                    <td><input type="checkbox" name="permiGroup[]" value="<?php echo $item['ID'] ?>" <?php echo (in_array($item['ID'], $groupInfo['PARAMS'])) ? "checked='checked'":""; ?> /></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <div class="gravar">
            <a href="<?php echo BASE_URL; ?>/permissions" class="btn btn-danger">Voltar   <img src='<?php echo BASE_URL."/assets/images/remover_botao.png" ;?>' style='width: 20px; height: 20px;'></a>
            <button class='btn btn-success' type="submit" >Gravar  <img src='<?php echo BASE_URL."/assets/images/ok_botao.png" ;?>' style='width: 20px; height: 20px;'></button>
        </div>


    </form>

</div>
