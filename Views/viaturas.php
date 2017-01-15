<style type="text/css">
    li {
        width: 200px;
    }

    div .permi {
        width: 100%;
    }

    img {
        width: 25px;
        height: 25px;
    }
    
    select[name="orderViaturas"],
    select[name='campofiltro'] {
        border-radius: 5px;
        border: 1px solid #000;
        
    }

    #parafiltro {
        border-radius: 5px;
        border: 1px solid #000;
    }

    #seta {
        width: 25px;
        height: 25px;
        float: none;
        margin-bottom: 65px;
    }
    .adicionar {
        width: 50px;
        height: 40px;
    }

</style>

<h2 style="margin-left: 10px;">Cadastro de Veículos</h2>
<hr/>
<div class="container-fluid col-sm-12">

    <div class="tab-content">
        <div id="viaturas" >
            <img class="adicionar" src="<?php echo BASE_URL; ?>/assets/images/adicionar.png" alt="Ícone da Operação Adicionar"/>
            <a href="<?php echo BASE_URL; ?>/viaturas/addViatura" class="btn btn-default">Adicionar Viaturas</a>
            <form method="POST">
                <button onclick="imprimir(this)" class="btn btn-default" style="float: right; height: 30px; border-color: #000;"><img src="<?php echo BASE_URL.'/assets/images/printer.png' ;?>" style="height: 20px;" /></button>
                <button type="submit" class="btn btn-default" style="float: right; height: 30px; border-color: #000;"><img src="<?php echo BASE_URL.'/assets/images/sortby.png' ;?>" style="height: 20px;" /></button>
                <select name='orderViaturas' style='float: right; height: 30px; line-height: 30px;'>
                    <option value='viatura' <?php echo ($_SESSION['ordemfiltro']==='viatura') ? "selected='selected'" : "" ;?> >Viatura</option>
                    <option value='placa' <?php echo ($_SESSION['ordemfiltro']==='placa') ? "selected='selected'" : "" ;?> >Emplacamento</option>
                    <option value='renavam' <?php echo ($_SESSION['ordemfiltro']==='renavam') ? "selected='selected'" : "" ;?> >Renavam</option>
                </select>
                <button type="submit" class="btn btn-default" style="float: right; height: 30px; border-color: #000;"><img src="<?php echo BASE_URL.'/assets/images/filter.png' ;?>" style="height: 20px;" /></button>
                <select name='campofiltro' class='campofiltro' style='float: right; height: 30px; line-height: 30px;'>
                    <option value='todos' <?php echo ($_SESSION['campofiltro']==='todos') ? "selected='selected'" : "" ;?> >Todos</option>
                    <option value='viatura' <?php echo ($_SESSION['campofiltro']==='viatura') ? "selected='selected'" : "" ;?> >Viatura</option>
                    <option value='emplacamento' <?php echo ($_SESSION['campofiltro']==='emplacamento') ? "selected='selected'" : "" ;?> >Emplacamento</option>
                    <option value='finalplaca' <?php echo ($_SESSION['campofiltro']==='finalplaca') ? "selected='selected'" : "" ;?> >Final Emplacamento</option>
                    <option value='tipo' <?php echo ($_SESSION['campofiltro']==='tipo') ? "selected='selected'" : "" ;?> >Tipo</option>
                    <option value='rastreado' <?php echo ($_SESSION['campofiltro']==='rastreado') ? "selected='selected'" : "" ;?> >Rastreado</option>
                    <option value='servico' <?php echo ($_SESSION['campofiltro']==='servico') ? "selected='selected'" : "" ;?> >Serviço</option>
                    <option value='anomodelo' <?php echo ($_SESSION['campofiltro']==='anomodelo') ? "selected='selected'" : "" ;?> >Ano/Modelo</option>
                    <option value='empresa' <?php echo ($_SESSION['campofiltro']==='empresa') ? "selected='selected'" : "" ;?> >Empresa</option>
                </select>
                <div class='filtrotipoinput'>
                    <input type="text" id="parafiltro" value="<?php echo isset($_SESSION['parafiltro']) ? $_SESSION['parafiltro'] :'' ;?>" name="parafiltro" placeholder="filtrar..." size="50" style="float: right; height: 30px; line-height: 30px; " autocomplete="off" />
                </div>
                <div class='filtrotiposelect' style="float: right;display: none; ">
                    <select class='parafiltro' id='parafiltro' name="parafiltro"  style="height: 30px; line-height: 30px;" >
                    </select>
                </div>
            </form>
            <hr/>
            <table class="table table-bordered table-striped table-hover table-responsive table-condensed">
                <thead>
                    <tr>
                        <th>VTR</th>
                        <th>Placa</th>
                        <th>Ano/Modelo</th>
                        <th>Nome</th>
                        <th>Chassis</th>
                        <th>Renavam</th>
                        <th>Tipo</th>
                        <th>Rastreado</th>
                        <th>Serviço</th>
                        <th>Empresa</th>
                        <th>Ativa</th>
                        <th width="150">Ação</th>
                    </tr>
                </thead>
                <?php foreach ($viaturas as $item): ?>
                <tr>
                    <td><?php echo $item['cod_viatura']; ?></td>
                    <td><?php echo substr($item['pl_viatura'],0,3)."-".substr($item['pl_viatura'],3,4); ?></td>
                    <td><?php echo $item['ano_viat']."/".$item['modelo_viat']; ?></td>
                    <td><?php echo $item['nome_viat'] ?></td>
                    <td><?php echo $item['chassis'] ?></td>
                    <td><?php echo $item['renavam'] ?></td>
                    <td style='text-align: center;'>
                        <?php if ($item['idVeiculo'] === '1'): ;?>
                            <img src='<?php echo BASE_URL; ?>/assets/images/viaturas_black.png'/>
                        <?php endif; ?>
                        <?php if ($item['idVeiculo'] === '2'): ;?>
                            <img src='<?php echo BASE_URL; ?>/assets/images/moto_black.png'/>
                        <?php endif; ?>
                    </td>
                    <td style="text-align: center;"><?php echo $item['rastro'] ?></td>
                    <td><?php echo $item['departamento'] ?></td>
                    <td><?php echo $item['apelido'] ?></td>
                    <td><?php echo $item['status'] ?></td>
                    <td>
                        <a href="<?php echo BASE_URL ;?>/viaturas/editViatura/<?php echo $item['idVTR']; ?>"><img src="<?php echo BASE_URL; ?>/assets/images/alterar.png" /></a>
                        <a href="<?php echo BASE_URL ;?>/viaturas/deactivatedViatura/<?php echo $item['idVTR']; ?>"><img src="<?php echo BASE_URL; ?>/assets/images/desativar.png"/></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <table style='font-size:12px;' class='table table-bordered'>
                <tr>
                    <td>Total de Registros</td>
                    <td style='color:red; width: 100px; text-align: right;'><?php echo $totalViaturas; ?></td>
                </tr>
            </table>
            <div class="indexPaginas">
                <a href='<?php echo BASE_URL ;?>/viaturas/?p=<?php echo $paginaAtual-1; ?>'><img id='seta' src='<?php echo BASE_URL;?>/assets/images/setaesquerda_um.png' /></a>
                <a href='<?php echo BASE_URL ;?>/viaturas/?p=1'><img id='seta' src='<?php echo BASE_URL;?>/assets/images/setaesquerda.png' /></a>
                <ul class="pagination pagination-sm">
                    <?php for ($p = $paginaInicial; $p<= $limite; $p++):?>
                    <li class='<?php echo ($p==$paginaAtual) ?"active" :""; ?>'><a href='<?php echo BASE_URL ;?>/viaturas/?p=<?php echo $p; ?>'><?php echo $p; ?></a></li>
                    <?php endfor; ?>
                </ul>
                <a href='<?php echo BASE_URL ;?>/viaturas/?p=<?php echo $totalPaginas; ?>'><img id='seta' src='<?php echo BASE_URL;?>/assets/images/setadireita.png' /></a>
                <a href='<?php echo BASE_URL ;?>/viaturas/?p=<?php echo $paginaAtual+1; ?>'><img id='seta' src='<?php echo BASE_URL;?>/assets/images/setadireita_um.png' /></a>
            </div>


        </div>
    </div>

</div>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/clientsadd.js"></script>