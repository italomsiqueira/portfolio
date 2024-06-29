/*Validação de turma*/
function validarTurma(){
    let hora = document.getElementById('hora').value;
    let dia1 = document.getElementById('dia1').value;
    let dia2 = document.getElementById('dia2').value;
    
    if(hora == ""){
        document.getElementById('erro').innerHTML = "<strong>Ops! Informe a hora.</strong>";
        document.getElementById('erro').removeAttribute('hidden');
        document.getElementById('hora').focus();
    }else if(dia1 == ""){
        document.getElementById('erro').innerHTML = "<strong>Ops! Selecione o dia 1!</strong>";
        document.getElementById('erro').removeAttribute('hidden');
        document.getElementById('dia1').focus();
    }else if(dia2 == ""){
        document.getElementById('erro').innerHTML = "<strong>Ops! Selecione o dia 2!</strong>";
        document.getElementById('erro').removeAttribute('hidden');
        document.getElementById('dia2').focus();
    }else{
        document.getElementById('form-cadastro').removeAttribute('onsubmit');
    }
}
/*--------------------------------*/

/*Validação de Aluno*/
function validarAluno(){
    let nome = document.getElementById('nome').value;
    let rg = document.getElementById('rg').value;
    let cpf = document.getElementById('cpf').value;
    let endereco = document.getElementById('endereco').value;
    let tel = document.getElementById('tel').value;
    let escolaridade = document.getElementById('escolaridade').value;
    let turma = document.getElementById('turma').value;
    
    if(nome == ""){
        document.getElementById('erro').innerHTML = "<strong>Ops! Informe o nome completo.</strong>";
        document.getElementById('erro').removeAttribute('hidden');
        document.getElementById('nome').focus();
    }else if(rg == ""){
        document.getElementById('erro').innerHTML = "<strong>Ops! Informe o RG!</strong>";
        document.getElementById('erro').removeAttribute('hidden');
        document.getElementById('rg').focus();
    }else if(cpf == ""){
        document.getElementById('erro').innerHTML = "<strong>Ops! Informe o CPF!</strong>";
        document.getElementById('erro').removeAttribute('hidden');
        document.getElementById('cpf').focus();
    }else if(endereco == ""){
        document.getElementById('erro').innerHTML = "<strong>Ops! Informe o endereço!</strong>";
        document.getElementById('erro').removeAttribute('hidden');
        document.getElementById('endereco').focus();
    }else if(tel == ""){
        document.getElementById('erro').innerHTML = "<strong>Ops! Informe o telefone corretamente!</strong>";
        document.getElementById('erro').removeAttribute('hidden');
        document.getElementById('tel').focus();
    }else if(escolaridade == ""){
        document.getElementById('erro').innerHTML = "<strong>Ops! Selecione a escolaridade!</strong>";
        document.getElementById('erro').removeAttribute('hidden');
        document.getElementById('escolaridade').focus();
    }else if(turma == ""){
        document.getElementById('erro').innerHTML = "<strong>Ops! Selecione a turma!</strong>";
        document.getElementById('erro').removeAttribute('hidden');
        document.getElementById('turma').focus();
    }else{
        document.getElementById('form-cadastro').removeAttribute('onsubmit');
    }
}
/*--------------------------------*/

function validarEdicaoAluno(){
    let nome = document.getElementById('nome').value;
    let rg = document.getElementById('rg').value;
    let cpf = document.getElementById('cpf').value;
    let endereco = document.getElementById('endereco').value;
    let tel = document.getElementById('tel').value;
    let turma = document.getElementById('turma').value;
    
    if(nome == ""){
        document.getElementById('erro').innerHTML = "<strong>Ops! Informe o nome completo.</strong>";
        document.getElementById('erro').removeAttribute('hidden');
        document.getElementById('nome').focus();
    }else if(rg == ""){
        document.getElementById('erro').innerHTML = "<strong>Ops! Informe o RG!</strong>";
        document.getElementById('erro').removeAttribute('hidden');
        document.getElementById('rg').focus();
    }else if(cpf == ""){
        document.getElementById('erro').innerHTML = "<strong>Ops! Informe o CPF!</strong>";
        document.getElementById('erro').removeAttribute('hidden');
        document.getElementById('cpf').focus();
    }else if(endereco == ""){
        document.getElementById('erro').innerHTML = "<strong>Ops! Informe o endereço!</strong>";
        document.getElementById('erro').removeAttribute('hidden');
        document.getElementById('endereco').focus();
    }else if(tel == ""){
        document.getElementById('erro').innerHTML = "<strong>Ops! Informe o telefone corretamente!</strong>";
        document.getElementById('erro').removeAttribute('hidden');
        document.getElementById('tel').focus();
    }else if(turma == ""){
        document.getElementById('erro').innerHTML = "<strong>Ops! Selecione a turma!</strong>";
        document.getElementById('erro').removeAttribute('hidden');
        document.getElementById('turma').focus();
    }else{
        document.getElementById('form-cadastro').removeAttribute('onsubmit');
    }
}


function validarEdicaoTurma(){
    let hora = document.getElementById('hora').value;
    let dia1 = document.getElementById('dia1').value;
    let dia2 = document.getElementById('dia2').value;
    
    if(hora == ""){
        document.getElementById('erro').innerHTML = "<strong>Ops! Informe a hora.</strong>";
        document.getElementById('erro').removeAttribute('hidden');
        document.getElementById('hora').focus();
    }else if(dia1 == ""){
        document.getElementById('erro').innerHTML = "<strong>Ops! Selecione o dia 1!</strong>";
        document.getElementById('erro').removeAttribute('hidden');
        document.getElementById('dia1').focus();
    }else if(dia2 == ""){
        document.getElementById('erro').innerHTML = "<strong>Ops! Selecione o dia 2!</strong>";
        document.getElementById('erro').removeAttribute('hidden');
        document.getElementById('dia2').focus();
    }else{
        document.getElementById('form-cadastro').removeAttribute('onsubmit');
    }
}

function validarBusca(){
    let nome = document.getElementById('nomeBusca').value;
    console.log(nome);
    if(nome == ""){
        document.getElementById('erro').innerHTML = "<strong>Ops! Informe algum nome para busca.</strong>";
        document.getElementById('erro').removeAttribute('hidden');
        document.getElementById('nomeBusca').focus();
    }else{
        document.getElementById('form-cadastro').removeAttribute('onsubmit');
    }
    
}

function validarLogin(){
    let login = document.getElementById('login').value;
    let senha = document.getElementById('senha').value;

    if(login == ""){
        document.getElementById('erro').innerHTML = "<strong>Ops! Informe o login.</strong>";
        document.getElementById('erro').removeAttribute('hidden');
        document.getElementById('login').focus();
    }else if(senha ==""){
        document.getElementById('erro').innerHTML = "<strong>Ops! Informe a senha.</strong>";
        document.getElementById('erro').removeAttribute('hidden');
        document.getElementById('senha').focus();
    }else{
        document.getElementById('form-login').removeAttribute('onsubmit');
    }
}