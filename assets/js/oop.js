function verCpf(objeto) {
    
    this.primeiroDigito = 0;
    this.segundoDigito = 0;
    this.result ="";
    this.tempo = "";
    this.primeiro = false;
    this.segundo = false;
    this.numcpf = objeto.value;
    this.digDigitado = this.numcpf.substr(12,2).toString();

    
    this.cpf = function() {

        for ( var i = 0; i < this.numcpf.length; i++ ) {
            if ( this.numcpf.substr(i,1) !== "." && this.numcpf.substr(i,1) !== "-" ) {
                this.tempo = this.tempo.concat(this.numcpf.substr(i,1));
            }
        }

        this.numcpf = this.tempo;

        if ( this.numcpf.length < 11 ) {
            return false;
        }

        this.numcpf = this.numcpf.substr(0,9);
        var n = this.numcpf.length;
        this.peso = 1;
        this.calculo = 0;

        while ( this.segundo === false ) {

            for (var i = 0; i < n; i++) {
                this.calculo += parseInt( this.numcpf.substr(i, 1)) * this.peso++;
            }
            if ( this.primeiro === false) {
                this.primeiroDigito = ( this.calculo % 11) === 10 ? 0 : ( this.calculo % 11);
                this.calculo = 0;
                i = 0;
                this.numcpf = this.numcpf.concat( this.primeiroDigito.toString());
                n++;
                this.peso = 0;
                this.primeiro = true;
            } else {
                this.segundoDigito = ( this.calculo % 11) === 10 ? 0 : ( this.calculo % 11);
                this.segundo = true;
            }

        }


        this.result = (this.primeiroDigito.toString()).concat(this.segundoDigito.toString());
        
        
        if ( this.digDigitado === this.result ) { // se Documento válido
            return true;
        } else {
            return false;
        }
        
    };

}


function verCnpj(objeto) {
    this.primeiroDigito = 0;
    this.segundoDigito = 0;
    this.result ="";
    this.tempo = "";
    this.primeiro = false;
    this.segundo = false;
    this.numcpf = objeto.value;
    this.digDigitado = this.numcpf.substr(16,2).toString();

    
    this.cpf = function() {

        for ( var i = 0; i < this.numcpf.length; i++ ) {
            if ( this.numcpf.substr(i,1) !== "." && this.numcpf.substr(i,1) !== "-" && this.numcpf.substr(i,1) !== "/" ) {
                this.tempo = this.tempo.concat(this.numcpf.substr(i,1));
            }
        }

        this.numcpf = this.tempo;
        console.log(this.numcpf);

        if ( this.numcpf.length < 14 ) {
            return false;
        }

        this.numcpf = this.numcpf.substr(0,12);
        var n = this.numcpf.length;
        this.peso = 5;
        this.calculo = 0;

        while ( this.segundo === false ) {

            for (var i = 0; i < n; i++) {
                this.calculo += parseInt( this.numcpf.substr(i, 1)) * this.peso;
                this.peso--;
                if ( this.peso < 2 ) {
                    this.peso = 9;
                }
            }
            if ( this.primeiro === false) {
                console.log(this.calculo);
                this.primeiroDigito = ( this.calculo % 11) < 2 ? 0 : ( 11 - (this.calculo % 11));
                this.calculo = 0;
                i = 0;
                this.numcpf = this.numcpf.concat( this.primeiroDigito.toString());
                n++;
                this.peso = 6;
                this.primeiro = true;
                console.log("Primeiro Digito :" + this.primeiroDigito);
            } else {
                this.segundoDigito = ( this.calculo % 11) < 2 ? 0 : (11-( this.calculo % 11));
                this.segundo = true;
                console.log("Segundo Digito :" + this.segundoDigito);
            }

        }


        this.result = (this.primeiroDigito.toString()).concat(this.segundoDigito.toString());
        
        if ( this.digDigitado === this.result ) { // se Documento válido
            return true;
        } else {
            return false;
        }
        
    };

}




function verMesAno(objeto, today ) {
    
    this.mes = "";
    this.ano = "";
    this.data = "";
    this.mesHoje = 0;
    this.anoHoje = 0;
    this.result = "";
    this.tempo = "";
    this.mesano = objeto.value;
    this.mes = this.mesano.substr(0,2).toString();
    this.ano = this.mesano.substr(3,4).toString();

    if ( today === true ) { // valida a partir da data de Hoje
        this.data = new Date();
        this.mesHoje = this.data.getMonth();
        this.anoHoje = this.data.getFullYear();
    }
    
    this.mesAno = function() {

        this.result = false;

        if ( this.mesano.length < 7 ) {
            return false;
        }

        if ( !today ) {
            if ( parseInt( this.mes ) >= 1 && parseInt( this.mes ) <= 12 ) {
                if ( parseInt(this.ano) >= 1900 && parseInt(this.ano) <= 2100 ) {
                    this.result = true;
                }
            }
        } else {
            if (parseInt(this.ano) > this.anoHoje ) {
                this.result = true;
            }
            if ( parseInt(this.ano) === this.anoHoje && parseInt(this.mes) >= this.mesHoje ) {
                this.result = true;
            }
        }

        return this.result;
    };

}





function verificaCpf(objeto) {
    
    meucpf = new verCpf(objeto);
    var result = meucpf.cpf();
    var imagem = document.getElementById("numcpf");
    
    if ( result ) { // se Documento válido
        imagem.setAttribute("style", "background-image: url('"+BASE_URL+"/assets/images/correto.png')");
        return true;
    }
    else {
        imagem.setAttribute("style", "background-image: url('"+BASE_URL+"/assets/images/errado.png')");
        document.professores.numcpf.select();
        document.professores.numcpf.focus();
        return false;
    }
    
}


function verificaCnpj(objeto) {
    
    meucpf = new verCnpj(objeto);
    var result = meucpf.cpf();
    var imagem = document.getElementById("numcpf");
    
    if ( result ) { // se Documento válido
        imagem.setAttribute("style", "background-image: url('"+BASE_URL+"/assets/images/correto.png')");
        return true;
    }
    else {
        imagem.setAttribute("style", "background-image: url('"+BASE_URL+"/assets/images/errado.png')");
        document.professores.numcpf.select();
        document.professores.numcpf.focus();
        return false;
    }
    
}


function verificaData(objeto, hoje) {
    
    minhaData = new verMesAno(objeto, hoje);
    result = minhaData.mesAno();
    var imagem = document.getElementById("mesanocorreto");
    
    if ( result ) { // se Documento válido

        objeto.setAttribute("class", "correto");
        imagem.setAttribute("src", "/imagens/correto.png");
        imagem.setAttribute("style", "display:block;");
        return true;
    }
    else {
        imagem.setAttribute("src", "/imagens/errado.png");
        imagem.setAttribute("style", "display:block;");
        document.formulario.mesano.select();
        document.formulario.mesano.focus();
        return false;
    }
    
    
}    
    
    


 