<?php
//VIA POST
//NAMES DOS MEUS INPUTS
/*
echo "<pre>";
var_dump($_POST);
echo "</pre>";
*/


require('../includes/conexao.php');
$nome = strtoupper($_POST['nome']);
$data_nascimento = $_POST['data_nascimento'];
$rg = strtoupper($_POST['rg']);
$cpf = strtoupper($_POST['cpf']);
$endereco = strtoupper($_POST['endereco']);
$tel = strtoupper($_POST['tel']);
$responsavel = strtoupper($_POST['responsavel']);
$turma = strtoupper($_POST['turma']);

$sql = "
        INSERT INTO alunos
            (nome, data_nascimento, rg, cpf, endereco, tel, responsavel, turma)
        VALUES
            ('$nome', '$data_nascimento', '$rg', '$cpf', '$endereco', '$tel', '$responsavel', '$turma')
";

if(mysqli_query($conn, $sql)){    
    echo "
    <script>
        location.href = '../cadastrar-aluno.php?msg=sucesso'
    </script>
    ";
}else{
    echo "
    <script>
        location.href = '../cadastrar-aluno.php?msg=erro'
    </script>
    ";
}


