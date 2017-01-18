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
    textarea,
    select,
    input[type="file"] {
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
    
    textarea {
        min-height: 100px;
    }
    
    #foto {
        float: right;
    }

</style>
<h2>Cadastro de Modalidades - Adicionar</h2>

<div class="container">
    <form method="POST" class="form-group" enctype="multipart/form-data">
        <div class="col-sm-9">
            
        <div class="row">
            <div class="col-sm-3 prompt">Nome da Modalidade</div>
            <div class="col-sm-7">
                <input type="text" name="modalidade" value="<?php echo $modalidade['modalidade'] ;?>" size="40" maxlength="50" class="form-control" required autofocus />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 prompt">Descrição</div>
            <div class="col-sm-7">
                <textarea name="modal_descri" class="form-control" required ><?php echo $modalidade['modal_descri'] ;?></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 prompt">Caracter ID</div>
            <div class="col-sm-1">
                <input type="text" name="modal_letraid" value="<?php echo $modalidade['modal_letraid'] ;?>" size="5" maxlength="1" class="form-control" required />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 prompt">Foto Modalidade</div>
            <div class="col-sm-7">
                <input type="file" id="fotomodalidade" name="modal_foto" class="form-control" />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 prompt">Status da Modalidade</div>
            <div class="col-sm-3">
                <select name="modal_status">
                    <option value="1" <?php echo ($modalidade['modal_status']=='1') ? 'selected="selected"' :"" ;?> >Ativado</option>
                    <option value="0" <?php echo ($modalidade['modal_status']=='0') ? 'selected="selected"' :"" ;?> >Desativado</option>
                </select>
           </div>
        </div>

        </div>
        <div class="col-sm-3" id="foto"><img src='<?php echo BASE_IMAGENS.'/galeria/'.$modalidade['modal_foto'] ;?>' width="200" height="200" /></div>
        <div style="clear: both"></div>
        <div class="gravar">
            <a href="<?php echo BASE_URL; ?>/modalidade" class="btn btn-danger">Voltar   <img src='<?php echo BASE_URL."/assets/images/remover_botao.png" ;?>' style='width: 20px; height: 20px;'></a>
            <button class='btn btn-success' type="submit" >Gravar  <img src='<?php echo BASE_URL."/assets/images/ok_botao.png" ;?>' style='width: 20px; height: 20px;'></button>
        </div>


    </form>

</div>
<script type="text/javascript" src="<?php echo BASE_URL ;?>/assets/js/painel.js"></script>
