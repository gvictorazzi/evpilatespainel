$( function() {
    
   
    $('#numcpf').mask("000.000.000-00");
    $('#numrg').mask("000.000.000-0", {reverse:true});
    $('#prof_cep').mask("00000-000");

    $('#prof_cep').bind("blur", function(e){
        
       e.preventDefault();

//       var txt = $(this).serialize();
        var txt = document.getElementById("prof_cep").value;

        if ( txt.length > 0 ) {
            avisaWait();
            var myUrl = "http://api.postmon.com.br/v1/cep/"+txt;

            $.ajax({

                type:"GET",
                url:myUrl,
                dataType:"json",
                success: function(retorno) {

                    if ( typeof retorno.logradouro !== "undefined") {
                        $('input[name=prof_end]').val(retorno.logradouro);
                        $('input[name=prof_bairro]').val(retorno.bairro);
                        $('input[name=prof_cidade]').val(retorno.cidade);
                        $('input[name=prof_uf]').val(retorno.estado);
                        $('input[name=prof_num]').focus();
                    }
                },
               error: function(retorno) {
                    console.log(retorno);
                   //alert("Ocorreu um erro na Busca de CEP");
               }

           
       });
            
        }
        
    });
    
    $("#fotomodalidade").on('change', function () {
 
        if (typeof (FileReader) != "undefined") {

            var image_holder = $("#foto");
            image_holder.empty();

            var reader = new FileReader();

            reader.onload = function (e) {
                $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image",
                    "width": "200",
                    "height": "200"
                }).appendTo(image_holder);
            };
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        } else{
            alert("Este navegador nao suporta FileReader.");
        }
    });

    
    $("#foto_prof").on('change', function () {
 
        if (typeof (FileReader) != "undefined") {

            var image_holder = $("#fotoprof");
            image_holder.empty();

            var reader = new FileReader();

            reader.onload = function (e) {
                $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image",
                    "width": "272",
                    "height": "340"
                }).appendTo(image_holder);
            };
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        } else{
            alert("Este navegador nao suporta FileReader.");
        }
    });

    
});

function avisaWait() {
    
    $('input[name=prof_end]').val('...');
    $('input[name=prof_bairro]').val('...');
    $('input[name=prof_cidade]').val('...');
    $('input[name=prof_uf]').val('...');

    
}


function clientsByState(obj) {

    var estado = $(obj).val();

    $.ajax ({

        url:BASE_URL+"/ajax/countiesListByState",
        type:'GET',
        data:{estado:estado},
        dataType:'json',
        success: function(json) {
            var html = '';
            for ( var i in json.counties) {
                html += "<option value='"+json.counties[i].ID+"'>"+json.counties[i].MUN_NOME+"</options>";
            }
            $('select[name=prof_cidade]').html(html);          
        },
        error: function(json) {
            console.log(json);
        }
    });
}    

function clientsByStateEdit(estadoVem, cidadeVem) {

    var estado = estadoVem;

    $.ajax ({

        url:BASE_URL+"/ajax/countiesListByState",
        type:'GET',
        data:{estado:estado},
        dataType:'json',
        success: function(json) {
            var html = '';
            for ( var i in json.counties) {
                if ( json.counties[i].ID == cidadeVem ) {
                    html += "<option value='"+json.counties[i].ID+"' selected='selected' >"+json.counties[i].MUN_NOME+"</options>";
                } else {
                    html += "<option value='"+json.counties[i].MUN_CODIGO+"' >"+json.counties[i].MUN_NOME+"</options>";
                }
            }
            $('select[name=prof_cidade]').html(html);   
            console.log(html);
        },
        error: function(json) {
            console.log(json);
        }
    });
}    

function adicionarcontato(obj) {
    
    var sequencia = $(obj).attr('data-controle');
    var html='';
    
    $.ajax({
        url:BASE_URL+'/ajax/contatosList',
        dataType:'json',
        success: function(json) {
            var seleciona='';
            seleciona += '<select name="tipocontato['+sequencia+']" class="form-control" onchange="funcaoteste(this)">';
            for ( var i in json.contato ) {
                seleciona += "<option value='"+json.contato[i].id+"'>"+json.contato[i].contato_tipo+"</option>";
            }
            seleciona += '</select>';
            
            html += '<tr>';
            html += '<td>'+sequencia+'</td>';
            html += '<td>'+seleciona + '</td>';
            html += '<td><input type="text" name="nomecontato['+sequencia+']" maxlength="200" class="form-control" /></td>';
            html += "<td style='text-align:center;'><a onclick='removecontato(this)'><img src='"+BASE_URL+"/assets/images/remover.png "+"' style='width: 25px; height: 25px;'/></a></td>";
            html += '</tr>';

            
            $('#tipocontato').append(html);
            sequencia++;
            $(obj).attr('data-controle', sequencia);
        },
        error: function( json ) {
            console.log(json);
        }
        
    });
    
}

function removecontato(obj) {
    $(obj).closest('tr').remove();
}

function funcaoteste(obj) {
    console.log(obj);
}