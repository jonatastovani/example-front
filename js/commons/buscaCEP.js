
function buscarCEP(cep) {
    cep = cep.replace(/\D/g, '');
    const url = `https://viacep.com.br/ws/${cep}/json/`;

    const xhr = new XMLHttpRequest();
    xhr.open('GET', url, false);
    xhr.send();

    if (xhr.status === 200) {
        const data = JSON.parse(xhr.responseText);
        if (!data.erro) {
            // console.log(data);
            return data;
        } else {
            console.log('CEP não encontrado');
            return 'CEP não encontrado';
        }
    } else {
        console.error('Erro na requisição:', xhr.statusText);
        return 'Erro na requisição:', xhr.statusText;
    }
}
