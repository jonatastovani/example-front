// import { EnumAction } from '../commons/enumsAction.js';

$(document).ready(function(){

    let action = 'POST';
    let idClient = null;
    const urlApiClients = "http://localhost:8080/api/v1/clients";

    const tableClients = $('#table-clients').find('tbody');

    function Reset() {

        $('#form1')[0].reset();
        $('#save').val('Salvar Cadastro');
        $('#name')[0].focus();
        action = 'POST';
        idClient = null;
    }
    
    function getDataClientsAll() {
         $.ajax({
            url: urlApiClients,
            method:"GET",
            dataType:"json",
            success: function(response) {

                let strHTML = '';
                response.forEach(client => {
                    strHTML += '<tr><td>'+client.name+'</td>';
                    strHTML += '<td>'+client.tel+'</td>';
                    strHTML += '<td>'+client.zipcode+'</td>';
                    strHTML += '<td>'+client.address+'</td>';
                    strHTML += '<td><button class="btn btn-primary edit" type=button data-id="'+client.id+'" title="Editar este cadastro">Editar</button></td>';
                    strHTML += '<td><button class="btn btn-danger delete" type=button data-id="'+client.id+'" title="Deletar este cadastro">Deletar</button></td></tr>';
                });

                tableClients.html(strHTML);
            },
            error: function(xhr, status, error) {
                console.error('Erro na solicitação AJAX:', status, error);
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    console.error('Erro da API:', xhr.responseJSON.error.description);
                }
            }
        });	
    }

    $(document).on('click', '#cancel', function(){
        
        Reset();

    });
    
    $('#form1').on('submit', function(event){
        event.preventDefault();			
        
        saveClients({id:idClient});		
        
    });
    
    $(document).on('click', '.edit', function(){

        // Reset();

        var id = $(this).data('id');			

        $('#save').val('Atualizar cadastro');
        
        $.ajax({
            url: urlApiClients + '/'+id,
            method: "GET",
            dataType: "json",
            success: function(response) {

                $('#name').val(response.name);
                $('#tel').val(response.tel).trigger('blur');
                $('#address').val(response.address);
                $('#zipcode').val(response.zipcode).trigger('change');
                
                idClient = response.id;
                action = 'PUT';

                $('#name').focus();
                executeMask();
            },
            error: function(xhr, status, error) {
                // Reset();
                console.error('Erro na solicitação AJAX:', status, error);
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    console.error('Erro da API:', xhr.responseJSON.error.description);
                }
            }
        });
    });
    
    function saveClients(arrData) {
 
        let data = {
            name: $('#name').val(),
            tel: $('#tel').val(),
            zipcode: $('#zipcode').val(),
            address: $('#address').val()
        }

        let param = arrData.id!=null?'/'+arrData.id:'';

        $.ajax({
            url: urlApiClients + param,
            method: action,
            data: JSON.stringify(data),
            contentType: "application/json",
            success: function() {
                getDataClientsAll();
                Reset();
            },
            error: function(xhr, status, error) {
                console.error('Erro na solicitação AJAX:', status, error);
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    console.error('Erro da API:', xhr.responseJSON.error.description);
                }
            }
        });	

    }
    
    $(document).on('click', '.delete', function(){
        
        var id = $(this).data('id');
                
        if (confirm("Confirma a exclusão do cadastro deste cliente?")) 
        {
            
            $.ajax({
                url: urlApiClients + '/' + id,
                method:"DELETE",
                success: function(response) {
                    getDataClientsAll();
                    Reset();
                },
                error: function(xhr, status, error) {
                    console.error('Erro na solicitação AJAX:', status, error);
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        console.error('Erro da API:', xhr.responseJSON.error.description);
                    }
                }
            });
            
        }
            
    });		

    $('#zipcode').on('change', function() {
        if (this.value.length==10) {
            buscandoCEP(this.value);
        } else {
            buscandoCEP(null);
        }
    });

    function buscandoCEP (cep=null) {
        if (cep==null || cep.length!=10){
            // habilitaCamposSeletor(true,'.grupoCEP');
            return;
        }
        
        let consulta = buscarCEP(cep);
        // console.log(consulta);
        if (typeof consulta === 'object' && !Array.isArray(consulta)) {
            // let elementoFoco = $('#logradouro').val().length==0 || 
                // $('#logradouro').val()!=consulta.logradouro?'#numero':'#cpf';

            $('#address').val(consulta.logradouro);
            // $('#bairro').val(consulta.bairro);
            // $('#cidade').val(consulta.localidade);
            // $('#uf').val(consulta.uf);

            // habilitaCamposSeletor(false,'.grupoCEP');
            // $(elementoFoco).focus();
        } else {
            // habilitaCamposSeletor(true,'.grupoCEP');
            // $('#action').val()=='insert'?$('#logradouro').focus():$('#cpf').focus();
        }
    }

    function executeMask() {
        $('#zipcode').mask('00.000-000');
    }
    
    $('.clstelefone').on('blur', function(){
        mascaraTelefone($(this).val(),'#'+this.id);
    })

    executeMask();
    getDataClientsAll();

});