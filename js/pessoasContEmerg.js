const idpessoa = parseInt($('#id_pessoaContEmerg').val());

$(document).ready(function(){

    if (typeof idpessoa === 'number' && idpessoa > 0) {
        getData('pessoasCadHeader', '?action=get_header_pessoasCad&id='+idpessoa);
        getDataContatos();
    } else {
        console.log('Não foi possível encontrar o cliente com o ID informado. Tente novamente mais tarde.');
        console.log('ID informado = '+idpessoa);
        $('#headerPessoa').html("<p>Não foi possível encontrar o cliente com o ID informado. Tente novamente mais tarde.</p>");
        $('#form1').attr('hidden', 'hidden');
    }

    function Reset() {

        $('#form1')[0].reset();
        $('#fam1')[0].focus();
    }
    
    function getData(type, param) {

        $.ajax({
            url:"../api/getdataGeral.php",
            data: { type:type, param:param },
            dataType: "json",
            success: function(response){

                if (response.status === 'success') {
                    $('#headerPessoa').html(response.data);
                } else {
                    let html = 'Erro: ' + response.message;

                    if ($('#headerPessoa').find('.card-body').length){
                        $('#headerPessoa').html(html);
                    } else {
                        $('#headerPessoa').append(html);
                    }
                    $('#form1').attr('hidden', 'hidden');
            
                }

            },
            error: function (error) {
                console.log(error)
                alert('Erro na requisição AJAX.');
            }
        })
    }

    function getDataContatos () {
        
        let id = $('#id_pessoaContEmerg').val();
        let action = 'pessoasContEmerg_one';
        
        $.ajax({
            url:"../api/savePessoasContEmerg.php",
            method:"POST",
            data:{id:id,action:action},
            dataType:"json",
            success:function(data) {
                
                $('#id_contEmerg').val(id);
                $('#fam1').val(data.fam1).focus();
                $('#telfam1').val(data.telfam1).trigger('blur');
                $('#fam2').val(data.fam2);
                $('#telfam2').val(data.telfam2).trigger('blur');
                $('#medic').val(data.medic);
                $('#telmedic').val(data.telmedic).trigger('blur');
                $('#conv').val(data.conv);
                $('#hosp').val(data.hosp);
                $('#obs').val(data.obs);

            },
            error: function(result) {
                // alert ('Erro: ' + result.error);
                console.log(result);					
            }
        });
    }

    $(document).on('click', '#cancel', function(){
        
        Reset();

    });
    
    $('#form1').on('submit', function(event){
        event.preventDefault();			
        
        let verifica = verificacoes();
        if (verifica != true) {
            return alert(verifica);
        }

        var form1 = $(this).serialize();

        $.ajax({
            url: "../api/savePessoasContEmerg.php",
            method:"POST",
            data:form1,
            success:function(data)
            {
                
                if (data === 'error2') {
                    alert("Os dados enviados já encontram-se cadastrados no nosso Banco de Dados! Revise as informações ou edite o cadastro existente.");
                } else if (data === 'update') {
                    alert("Dados atualizados!");
                }

            }
        });				
        
    });
    
    
    function verificacoes() {
        let arrMensagens = [];

        let arrRelacoes = [];

        arrRelacoes.push(
            {campoNome: '#fam1', campoTel: '#telfam1', nomeContato: 'Familiar 1'},
            {campoNome: '#fam2', campoTel: '#telfam2', nomeContato: 'Familiar 2'},
            {campoNome: '#medic', campoTel: '#telmedic', nomeContato: 'Médico'}
        );

        arrRelacoes.forEach(relacao => {
            let campoTel = $(relacao.campoTel).val().replace(/\D/g, '').trim().length;
            let campoNome = $(relacao.campoNome).val().trim().length;

            if ((campoNome>0 && campoTel==0) || (campoNome==0 && campoTel>0 || (campoNome>0 && campoTel<8))){
                arrMensagens.push('Os dados referentes ao "' + relacao.nomeContato + '" precisa ser preenchido corretamente.');
            }
        });

        if (arrMensagens.length){
            arrMensagens.push('\nAtênte-se ao mínimo de 8 dígitos do telefone e ao nome do contato.')
        }
        
        let strMensagem='';
        if(arrMensagens.length)
            strMensagem = 'Algumas coisas precisam ser resolvidas antes de prosseguir-mos:\n';
            arrMensagens.forEach(mensagem => {
                strMensagem += `\n${mensagem}`;
            });
        
        return strMensagem!=''?strMensagem:true;
        
    }

    $('.clstelefone').on('blur', function(){
        mascaraTelefone($(this).val(),'#'+this.id);
    })
   
    // $('.clstelefone').mask('(00) 0000-00009');
 
});