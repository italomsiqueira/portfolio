<?php
require('../includes/conexao.php');
$id = $_POST['id'];
$nome = strtoupper($_POST['nome']);
$rg = strtoupper($_POST['rg']);
$cpf = strtoupper($_POST['cpf']);
$endereco = strtoupper($_POST['endereco']);
$tel = strtoupper($_POST['tel']);
$turma = strtoupper($_POST['turma']);

$sql = "
    UPDATE alunos SET
    nome = '$nome',
    rg = '$rg',
    cpf = '$cpf',
    endereco = '$endereco',
    tel = '$tel',
    turma = '$turma'
    WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    echo "
    <script>
        alert('Dados alterados com sucesso');
        location.href='../listar-alunos.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('Ops! Tivemos um erro ao tentar realizar esta operação!');
        location.href='../listar-alunos.php';
    </script>
    ";
}
