$( function() {
    
   
    $('#numcpf').mask("000.000.000-00");
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

    
});

function avisaWait() {
    
    $('input[name=prof_end]').val('...');
    $('input[name=prof_bairro]').val('...');
    $('input[name=prof_cidade]').val('...');
    $('input[name=prof_uf]').val('...');

    
}