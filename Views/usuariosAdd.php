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
    input[type="email"],
    input[type="password"],
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
<h2>Cadastro de Usuários - Adicionar</h2>

<div class="container">
    <form method="POST" class="form-group">
        <div class="row">
            <div class="col-sm-3 prompt">Nome do Usuário</div>
            <div class="col-sm-4">
                <input type="text" name="nomeusu" size="40" maxlength="50" class="form-control" required autofocus />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 prompt">E-mail</div>
            <div class="col-sm-4">
                <input type="email" name="email" size="80" maxlength="100" class="form-control" require'd />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 prompt">Nome para Acesso ao Sistema</div>
            <div class="col-sm-4">
                <input type="text" name="username" size="25" maxlength="30" class="form-control" required />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 prompt">Senha (8 a 15 caracteres )</div>
            <div class="col-sm-4">
                <input type="password" name="senha" size="20" minlength="8" maxlength="15" class="form-control" required />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 prompt">Grupo de Acesso</div>
            <div class="col-sm-4">
                <select name='grupodeacesso'>
                    <?php foreach ($gruposdeacesso as $item) : ?>
                        <option value="<?php echo $item['ID'] ;?>"><?php echo $item['NAME'] ;?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 prompt">Status do Usuário</div>
            <div class="col-sm-4">
                <select name="status">
                    <option value="1">Ativado</option>
                    <option value="0">Desativado</option>
                </select>
           </div>
        </div>
        <div class="gravar">
            <a href="<?php echo BASE_URL; ?>/usuarios" class="btn btn-danger">Voltar   <img src='<?php echo BASE_URL."/assets/images/remover_botao.png" ;?>' style='width: 20px; height: 20px;'></a>
            <button class='btn btn-success' type="submit" >Gravar  <img src='<?php echo BASE_URL."/assets/images/ok_botao.png" ;?>' style='width: 20px; height: 20px;'></button>
        </div>


    </form>

</div>

