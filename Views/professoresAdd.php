<style>
    .container {
        width: 100%;
        float: left;

        border-top: 2px solid #000;
        padding: 5px;
    }

    .formulariomesmo {
        min-height: 500px;
        border-bottom: 2px solid #000;
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

    textarea {
        min-height: 300px;
    }
    
    
</style>
<h2>Cadastro de Professores - Adicionar</h2>

<div class="container">
    <form method="POST" class="form-group" autocomplete="off" name="professores" enctype="multipart/form-data">
        <div class="formulariomesmo">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#dados" data-toggle="tab">Dados/Endereço</a></li>
            <li><a href="#biografia" data-toggle="tab">Biografia</a></li>
            <li><a href="#modalidade" data-toggle="tab">Modalidade</a></li>
            <li><a href="#fotografia" data-toggle="tab">Pessoais</a></li>
            <li><a href="#contatos" data-toggle="tab">Outros Contatos</a></li>
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
                        <input type="text" name="prof_cel" size="20" maxlength="20" class="form-control" />
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
                        <input type="text" id="numrg" name="prof_rg" size="20" maxlength="20" class="form-control" />
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
                    <div class="col-sm-2 prompt">Estado</div>
                    <div class='col-sm-2'>
                        <select name="prof_uf" onchange="clientsByState(this)">
                            <?php foreach ($estados as $item) :?>
                            <option value="<?php echo $item['UF_CODIGO'] ;?>"><?php echo $item['UF_NOME']."-".$item['SIGLA_UF'] ;?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-sm-2 prompt">Cidade</div>
                    <div class='col-sm-4'>
                        <select name="prof_cidade">
                            
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2 prompt">Status</div>
                    <div class='col-sm-2'>
                        <select name="prof_status" >
                            <option value="1" selected="selected">Ativo</option>
                            <option value="0">Não Ativo</option>
                        </select>
                    </div>
                </div>
            </div>
            <div id="biografia" class="tab-pane">
                <div class="row">
                    <div class="col-sm-2 prompt">Biografia</div>
                </div>
                <div class="row">
                    <div class="col-sm-10">
                        <textarea name="biografia" class="form-control" required ></textarea>
                    </div>
                </div>
            </div>
            <div id="modalidade" class="tab-pane">
                <table class="table table-bordered table-striped table-hover table-responsive table-condensed">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Letra ID</th>
                            <th>Foto</th>
                            <th>Ativo</th>
                            <th>Prof</th>
                        </tr>
                    </thead>
                    <?php foreach ($modal as $item): ?>
                    <tr>
                        <td><?php echo $item['modalidade']; ?></td>
                        <td><?php echo $item['modal_descri']; ?></td>
                        <td><?php echo $item['modal_letraid'] ?></td>
                        <td><img src="<?php echo BASE_IMAGENS.'/galeria/'.$item["modal_foto"] ;?>" width="50" height="50" /></td>
                        <td><?php echo ($item['modal_status']) == '1' ? "SIM" : "NÃO" ;?></td>
                        <td><input type="checkbox" name="profmodalidade[]" value="<?php echo $item['id'] ?>" /></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                
            </div>
            <div id="fotografia" class="tab-pane">
                <div class="row">
                    <div class="col-sm-2 prompt">Data Nascimento</div>
                    <div class='col-sm-2'>
                        <input type='date' name='prof_dtnasc' class='form-control' />
                    </div>
                    <div class="col-sm-2 prompt">Idade</div>
                    <div class='col-sm-2'>
                        <input type='text' name='prof_idade' class='form-control' />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2 prompt">Gênero</div>
                    <div class='col-sm-2'>
                        <select name='prof_genero' class='form-control'>
                            <option value='Feminino'>Feminino</option>
                            <option value='Masculino'>Masculino</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2 prompt">Foto</div>
                    <div class="col-sm-3">
                        <input type="file" id="foto_prof" name="foto_prof" class="form-control" />
                    </div>
                    <div class="col-sm-3" id="fotoprof"></div>
                    <div style="clear: both"></div>
                </div>
            </div>
            <div id="contatos" class="tab-pane">
                
            </div>
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