<?php
require('../includes/conexao.php');
session_start();

$id = intval($_POST['id']);
$nome = $_POST['nome'];
$login = $_POST['login'];
$nivel = $_POST['nivel'];
$senha = $_POST['senha'];

$sqlFoto = "";
if (!empty($_FILES['foto']['name'])) {
    $pasta = "../uploads/";
    if (!is_dir($pasta)) mkdir($pasta);
    $fotoNome = uniqid() . "-" . basename($_FILES['foto']['name']);
    $fotoCaminho = $pasta . $fotoNome;
    move_uploaded_file($_FILES['foto']['tmp_name'], $fotoCaminho);
    $fotoRel = "uploads/" . $fotoNome;
    $sqlFoto = ", foto = '$fotoRel'";
}

if (!empty($senha)) {
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    $sql = "UPDATE usuarios SET nome='$nome', login='$login', senha='$senhaHash', nivel='$nivel' $sqlFoto WHERE id=$id";
} else {
    $sql = "UPDATE usuarios SET nome='$nome', login='$login', nivel='$nivel' $sqlFoto WHERE id=$id";
}

mysqli_query($conn, $sql);
header("Location: ../usuarios-listar.php?msg=Usuário atualizado com sucesso!");
exit;
