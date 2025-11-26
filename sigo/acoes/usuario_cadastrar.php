<?php
require('../includes/conexao.php');
session_start();

$nome  = $_POST['nome'];
$login = $_POST['login'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$nivel = $_POST['nivel'];
$foto = null;

if (!empty($_FILES['foto']['name'])) {
    $pasta = "../uploads/";
    if (!is_dir($pasta)) mkdir($pasta);
    $fotoNome = uniqid() . "-" . basename($_FILES['foto']['name']);
    $fotoCaminho = $pasta . $fotoNome;
    move_uploaded_file($_FILES['foto']['tmp_name'], $fotoCaminho);
    $foto = "uploads/" . $fotoNome;
}

$sql = "INSERT INTO usuarios (nome, login, senha, nivel, foto) VALUES ('$nome', '$login', '$senha', '$nivel', '$foto')";
mysqli_query($conn, $sql);

header("Location: ../usuarios-listar.php?msg=Usuário cadastrado com sucesso!");
exit;
