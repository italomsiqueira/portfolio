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
$rg = strtoupper($_POST['rg']);
$cpf = strtoupper($_POST['cpf']);
$endereco = strtoupper($_POST['endereco']);
$tel = strtoupper($_POST['tel']);
$turma = strtoupper($_POST['turma']);

$sql = "
        INSERT INTO alunos
            (nome, rg, cpf, endereco, tel, turma)
        VALUES
            ('$nome', '$rg', '$cpf', '$endereco', '$tel', '$turma')
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


