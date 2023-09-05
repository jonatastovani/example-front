$(document).ready(function(){

    getData('juridicos', '?action=get_all');

    function Reset() {

        $('#form1')[0].reset();
        $('#save').val('Inserir novo Jurídico');
        $('#action').val('insert');
        $('#cnpj')[0].focus();
        visualizaSenha(false);
        habilitaSenha(true);
        $('#div-ckbsenha').attr('hidden', 'hidden');
        $('#ckb_alt_senha').prop('checked', false);
        executeMask();
    }
    
    function getData(type, param) {
        $.ajax({
            url:"../api/getdataJuridicos.php",
            data: { type:type, param:param },
            success: function(data)
            {
                $('tbody').html(data);					

            }
        })
    }

    $(document).on('click', '#cancel', function(){
        
        Reset();

    });
    
    $('#form1').on('submit', function(event){
        event.preventDefault();			
        
        let retorno = verificacoes();
        if (retorno!==true)
            return alert(retorno);

        var form1 = $(this).serialize();

        $.ajax({
            url: "../api/saveJuridicos.php",
            method:"POST",
            data:form1,
            success:function(data)
            {
                
                if (data === 'insert')
                {
                    // alert("Dados inseridos!");
                    Reset();
                    getData('juridicos', '?action=get_all');
                }
                else if (data === 'error2')
                {
                    alert("Os dados enviados já encontram-se cadastrados no nosso Banco de Dados! Revise as informações ou edite o cadastro existente.");
                }						
                else if (data === 'update') 
                {
                    // alert("Dados atualizados!");
                    Reset();
                    getData('juridicos', '?action=get_all');
                
                }
            }
        });				
        
    });
    
    function verificacoes() {
        let arrMensagens = [];

        let conteudoVerificar = $('#cnpj').val();
        if(conteudoVerificar.length==18)
            validaCNPJ(conteudoVerificar)!==true?arrMensagens.push('O CNPJ informado está incorreto.'):'';
        
        let arrData = {
            action: 'cnpjJuridico_one',
            key: 'cnpj',
            value: $('#cnpj').val(),
            id: $('#action').val()=='update'?$('#id_juridico').val():null
        }
        if (verificaDadosDuplicados(arrData)!=false)
            arrMensagens.push('O CNPJ informado já consta em nossos cadastros.')

        arrData = {
            action: 'cpfJuridico_one',
            key: 'cpf_resp',
            value: $('#cpf_resp').val(),
            id: $('#action').val()=='update'?$('#id_juridico').val():null
        }
        if (verificaDadosDuplicados(arrData)!=false)
            arrMensagens.push('O CPF informado já consta em nossos cadastros.')
            
        arrData = {
            action: 'emailJuridico_one',
            key: 'email',
            value: $('#email').val(),
            id: $('#action').val()=='update'?$('#id_juridico').val():null
        }
        if (verificaDadosDuplicados(arrData)!=false)
            arrMensagens.push('O Email informado já consta em nossos cadastros.')
            
        conteudoVerificar = $('#cpf_resp').val();
        if(conteudoVerificar.length==14)
            validaCPF(conteudoVerificar)!==true?arrMensagens.push('O CPF informado está incorreto.'):'';
        

        if(!$('#ckb_termo').prop('checked') || !$('#ckb_lgpd').prop('checked'))
            arrMensagens.push('Os Termos e Políticas da Certsimples precisam ser lidos e aceitos.');

        let elementoVerificar = $('#senha');
        if(!elementoVerificar.attr('disabled') && elementoVerificar.val().trim().length==0)
            arrMensagens.push('A Senha não pode ser vazia ou conter apenas espaços em branco.');
        
        let strMensagem='';
        if(arrMensagens.length)
            strMensagem = 'Algumas coisas precisam ser resolvidas antes de prosseguir-mos:\r';
            arrMensagens.forEach(mensagem => {
                strMensagem += `\r${mensagem}`;
            });
        
        return strMensagem!=''?strMensagem:true;
        
    }

    $(document).on('click', '.edit', function(){

        Reset();

        var id = $(this).data('id');			

        var action = 'juridico_one';
        
        $('#action').val('update');

        $('#save').val('Atualizar cadastro');
        
        $.ajax({
            url:"../api/saveJuridicos.php",
            method:"POST",
            data:{id:id,action:action},
            dataType:"json",				
            success:function(data)
            {
                
                $('#id_juridico').val(id);
                $('#cnpj').val(data.cnpj);
                $('#cpf_resp').val(data.cpf_resp);
                $('#data_nasc').val(data.data_nasc);
                $('#email').val(data.email);
                $('#senha').val('');
                
                let checks = data.checks.split(";");
                let listChecks = [
                    '#ckb_prev_fra',
                    '#ckb_val_dados',
                    '#ckb_ana_cred',
                    '#ckb_cump_obri'
                ];

                if(checks.length==4){
                    for (let i = 0; i < checks.length; i++) {
                        $(listChecks[i]).prop('checked',checks[i]==='1');
                    }
                }else{
                    console.log('Quantidade de checks no banco incompatível com os existentes.')
                }

                $('#ckb_termo').prop('checked',true);
                $('#ckb_lgpd').prop('checked',true);

                executeMask();
                $('#div-ckbsenha').removeAttr('hidden');
                habilitaSenha(false);
                $('#cnpj').focus();

            },
            error: function(result) {
                console.log(result);					
            }
        });
    });
    
    function verificaDadosDuplicados(arrParams){
        let id = null;
        if(arrParams.id){
            id = arrParams.id;
        }

        let arrdata = {
            action: arrParams.action
        }
        arrdata[arrParams.key] = arrParams.value;
        
        let retorno = true;

        $.ajax({
            url:"../api/saveJuridicos.php",
            method:"POST",
            data:arrdata,
            dataType:"json",
            async: false,
            success:function(data)
            {
                if (typeof data === 'object' && !Array.isArray(data)) {
                    if (id!=null && data.id == id){
                        retorno = false;
                    }
                }else{
                    retorno = false;
                }
            },
            error: function(result) {
                console.log(result);					
                retorno = true;
            }
        });

        return retorno;
    }
    
    $(document).on('click', '.delete', function(){
        
        var id = $(this).data('id');
        
        var action = 'delete';
        
        if (confirm("Confirma a exclusão deste Cadastro de Jurídico?")) 
        {
            
            $.ajax({
                url:"../api/saveJuridicos.php",
                method:"POST",
                data:{id:id,action:action},
                success:function(data)
                {
                    
                    Reset();
                    getData('juridicos', '?action=get_all');
                    
                    //alert("Data deleted!");
                }
            });
            
        }
            
    });		
    
    $('#ckb_mostrar').on('change', function() {
        visualizaSenha (this.checked);
    });

    function visualizaSenha (status) {
        let senhaInput = $('#senha');
        if (status) {
            senhaInput.attr('type', 'text');
        } else {
            senhaInput.attr('type', 'password');
        }
    }

    $('#ckb_alt_senha').on('change', function() {
        if ($('#action').val('update')) {
            habilitaSenha (this.checked);
        }
    })

    function habilitaSenha (status) {
        let elem_senha = $('.grupo-senha');
        if (status) {
            elem_senha.removeAttr('disabled');
            
        } else {
            elem_senha.attr('disabled','disabled');
        }
    }

    function executeMask() {
        $('#cpf_resp').mask('000.000.000-00');
        $('#cnpj').mask('00.000.000/0000-00');
    }
    
    executeMask();

});