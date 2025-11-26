<?php
require('../includes/conexao.php');
include('../includes/protecao.php');

if(!isset($_POST['id'], $_POST['nome'])) {
    header('Location: ../perfil.php?msg=Erro');
    exit;
}

$id = $_POST['id'];
$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$senha = $_POST['senha'] ?? '';

if($senha) {
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    $sql = "UPDATE usuarios SET nome='$nome', senha='$senhaHash' WHERE id='$id'";
} else {
    $sql = "UPDATE usuarios SET nome='$nome' WHERE id='$id'";
}

if(mysqli_query($conn, $sql)) {
    header('Location: ../perfil.php?msg=Perfil atualizado com sucesso!');
} else {
    header('Location: ../perfil.php?msg=Erro ao atualizar perfil.');
}
