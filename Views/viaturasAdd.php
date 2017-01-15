<style>
    .container {
        background-color: #e3e3e3;
        width: 100%;
        float: left;
    }

    form {
        padding-top: 20px;
    }

    input[type="text"],
    input[type="date"],
    input[type="time"],
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
    
    .identidade {
        margin: auto;
        border-bottom: 1px solid #000;
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



</style>
<h2>Cadastro de Viaturas - Adição</h2>
    <div class="warn alert-info">
        <?php echo ((isset($aviso) && !empty($aviso)) ? $aviso : ""); ?>
    </div>
<hr/>
<form method="POST">
    <div class="container">
        <div class='row' style="margin-top:10px;">
            <div class='col-sm-1 prompt'>Código Viatura</div>
            <div class='col-sm-4'><input type="text" id='codviatura' name="codviatura" size='10' maxlength="3" required autofocus/></div>
        </div>    
        <div class='row'>
            <div class='col-sm-1 prompt'>Placa</div>
            <div class='col-sm-4'><input type="text" id="plviatura" name="plviatura" size="20" maxlength="7" required  /></div>
            <div class='col-sm-1 prompt'>Tipo Veiculo</div>
            <div class='col-sm-4'>
                <select id='tpveiculo' name='tpveiculo'>
                    <?php foreach ($tipoveic as $item) :?>
                        <option value='<?php echo $item['id'] ;?>'><?php echo $item['tpveiculo'] ;?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
        </div>    
        <hr/>
        <div class='row'>
            <div class='col-sm-1 prompt'>Ano Fabricação</div>
            <div class='col-sm-4'><input type="text" name="anoviatura" size="10" maxlength="4" /></div>
            <div class='col-sm-1 prompt'>Modêlo/Ano Fabricação</div>
            <div class='col-sm-4'><input type="text" name="anomodviatura" size="10" maxlength="4" /></div>
        </div>    
        <div class='row'>
            <div class='col-sm-1 prompt'>Cor</div>
            <div class='col-sm-4'><input type="text" name="corviatura" size="40" maxlength="20" /></div>
            <div class='col-sm-1 prompt'>Nome/Marca</div>
            <div class='col-sm-4'><input type="text" name="nomeviatura" size="60" maxlength="50"  /></div>
        </div>
        <hr/>
        <div class='row'>
            <div class='col-sm-1 prompt'>Chassis</div>
            <div class='col-sm-4'><input type="text" name="chassis" size="40" maxlength="20" required /></div>
            <div class='col-sm-1 prompt'>Renavam</div>
            <div class='col-sm-4'><input type="text" name="renavam" size="20" maxlength="10" required /></div>
        </div>    
        <hr/>
        <div class='row'>
            <div class='col-sm-1 prompt'>Departamento</div>
            <div class='col-sm-4'>
                <select id='departamento' name='departamento'>
                    <?php foreach ($depart as $item) :?>
                        <option value='<?php echo $item['id'] ;?>'><?php echo $item['departamento'] ;?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class='col-sm-1 prompt'>Empresa</div>
            <div class='col-sm-4'>
                <select id='empresa' name='empresa'>
                    <?php foreach ($empresas as $item) :?>
                        <option value='<?php echo $item['idEmpresa'] ;?>'><?php echo $item['base'].'--'.$item['empresa']."/".$item['apelido'] ;?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <hr/>
        <div class='row'>
            <div class='col-sm-1 prompt'>Empresa Rastreador</div>
            <div class='col-sm-4'>
                <select id='rastreador' name='rastreador'>
                    <?php foreach ($rastro as $item) :?>
                        <option value='<?php echo $item['id'] ;?>'><?php echo $item['rastreador'] ;?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class='col-sm-1 prompt'>Código MCT</div>
            <div class='col-sm-4'>
                <input type="text" name="codmct" size="40" maxlength="20"  />
            </div>
        </div>
        <div class='row'>
            <div class='col-sm-1 prompt'>Rastreador Ativo</div>
            <div class='col-sm-4'>
                <select id='rastroativo' name='rastroativo'>
                    <option value='SIM'>Ativado</option>
                    <option value='NAO'>Desativado</option>
                </select>
            </div>
            <div class='col-sm-1 prompt'>Viatura Ativa</div>
            <div class='col-sm-4'>
                <select id='vtrativo' name='vtrativo'>
                    <option value='SIM'>Ativada</option>
                    <option value='NAO'>Desativada</option>
                </select>
            </div>
        </div>
        <br><br>
        <div class="gravar">
            <a class='btn btn-danger' href='<?php echo BASE_URL."/viaturas" ?>'>Voltar  <img src='<?php echo BASE_URL."/assets/images/botao_remover.png" ;?>' style='height: 20px; width: 20px;' /></a>
            <button type="submit" class="btn btn-success">Gravar Registro <img src="<?php echo BASE_URL.'/assets/images/botao_ok.png' ;?>" style="height: 20px; width: 20px;" /></button>
        </div>
    </div>
</form>
