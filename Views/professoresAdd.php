<style>
    .container {
        width: 100%;
        float: left;
        border-bottom: 2px solid #000;
        border-top: 2px solid #000;
        padding: 5px;
    }

    form {
        padding-top: 10px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    select {
        padding: 5px;
        border-radius: 5px;
        border: 1px solid black;
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
<h2>Cadastro de Professores - Adicionar</h2>

<div class="container">
    <form method="POST" class="form-group" autocomplete="off" name="professores">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#dados" data-toggle="tab">Dados/Endereço</a></li>
            <li><a href="#biografia" data-toggle="tab">Foto/Biografia</a></li>
            <li><a href="#modalidade" data-toggle="tab">Modalidade</a></li>
        </ul>
        <div class="tab-content" style="margin-top: 15px;">
            <div id="dados" class="tab-pane active in">
        
                <div class="row">
                    <div class="col-sm-2 prompt">Nome do Professor</div>
                    <div class="col-sm-4">
                        <input type="text" name="prof_nome" size="40" maxlength="50" class="form-control" required autofocus />
                    </div>
                    <div class="col-sm-1 prompt">Apelido</div>
                    <div class="col-sm-2">
                        <input type="text" name="prof_apelido" size="20" maxlength="20" class="form-control" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2 prompt">E-mail</div>
                    <div class="col-sm-4">
                        <input type="email" name="prof_email" size="100" maxlength="100" class="form-control" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2 prompt">Telefone Fixo</div>
                    <div class="col-sm-3">
                        <input type="text" name="prof_tel" size="20" maxlength="20" class="form-control" />
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-1 prompt">Celular</div>
                    <div class="col-sm-3">
                        <input type="text" name="prof_cle" size="20" maxlength="20" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2 prompt">CPF</div>
                    <div class="col-sm-3">
                        <input class='docpri' id="numcpf" type="text" name="prof_cpf" size="30" maxlength="14" onblur="verificaCpf(this)" /><br/>
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-1 prompt">RG</div>
                    <div class="col-sm-3">
                        <input type="text" name="prof_rg" size="20" maxlength="20" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2 prompt">Cep</div>
                    <div class="col-sm-2">
                        <input type="text" name="prof_cep" id="prof_cep" size='10' maxlength="8" class="form-control" />
                    </div>
                </div>
                <div class='row'>
                    <div class="col-sm-2 prompt">Logradouro</div>
                    <div class="col-sm-5">
                        <input type="text" name="prof_end" id="prof_cep" size='100' maxlength="100" class="form-control" placeholder="endereço..." />
                    </div>
                    <div class='col-sm-1'>
                        <input type="text" name="prof_num" id="prof_cep" size='10' maxlength="10" class="form-control" placeholder="número..." />
                    </div>
                    <div class='col-sm-2'>
                        <input type="text" name="prof_compl" id="prof_cep" size='20' maxlength="20" class="form-control" placeholder="complemento..." />
                    </div>
                </div>
                <div class='row'>
                    <div class="col-sm-2 prompt">Bairro</div>
                    <div class="col-sm-4">
                        <input type="text" name="prof_bairro" id="prof_cep" size='50' maxlength="50" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2 prompt">Cidade</div>
                    <div class='col-sm-4'>
                        <input type="text" name="prof_cidade" id="prof_cep" size='10' maxlength="10" class="form-control" />
                    </div>
                    <div class='col-sm-1'>
                        <input type="text" name="prof_uf" id="prof_cep" size='6' maxlength="2" class="form-control" placeholder="uf..." />
                    </div>
                </div>
            </div>
            <div id="biografia" class="tab-pane">
            </div>
            <div id="modalidade" class="tab-pane">
            </div>
        </div>
        <div class="gravar">
            <a href="<?php echo BASE_URL; ?>/professor" class="btn btn-danger">Voltar   <img src='<?php echo BASE_URL."/assets/images/remover_botao.png" ;?>' style='width: 20px; height: 20px;'></a>
            <button class='btn btn-success' type="submit" >Gravar  <img src='<?php echo BASE_URL."/assets/images/ok_botao.png" ;?>' style='width: 20px; height: 20px;'></button>
        </div>


    </form>

</div>
<script type="text/javascript" src="<?php echo BASE_URL ;?>/assets/js/painel.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/oop.js"></script>