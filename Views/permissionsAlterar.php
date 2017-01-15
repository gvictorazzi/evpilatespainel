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
        border-radius: 5px;
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
<h2>Módulo Permissões - Manutenção - Alterar</h2>
<hr/>
<div class="container">

    <form method="POST" class="form-group">
        <div class="row">
            <div class="col-sm-2 prompt">Nome da Permissão</div>
            <div class="col-sm-4">
                <input type="text" name="pname" value="<?php echo $permission['NAME']; ?>" size="40" maxlength="50" />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 prompt">Descrição do Módulo</div>
            <div class="col-sm-4">
                <input type="text" name="lname" value="<?php echo $permission['LONGNAME']; ?>" size="80" maxlength="200" />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 prompt">Status do Módulo</div>
            <div class="col-sm-4">
                <select name="pstatus">
                    <option value="SIM" <?php echo ($permission['STATUS']=='SIM') ? 'selected="selected':"" ;?>>Ativado</option>
                    <option value="NAO" <?php echo ($permission['STATUS']=='NAO') ? 'selected="selected':"" ;?> >Desativado</option>
                </select>
           </div>
        </div>
        <div class="gravar">
            <a href="<?php echo BASE_URL; ?>/permissions" class="btn btn-danger">Voltar   <img src='<?php echo BASE_URL."/assets/images/remover_botao.png" ;?>' style='width: 20px; height: 20px;'></a>
            <button class='btn btn-success' type="submit" >Atualizar  <img src='<?php echo BASE_URL."/assets/images/ok_botao.png" ;?>' style='width: 20px; height: 20px;'></button>
        </div>


    </form>

</div>

