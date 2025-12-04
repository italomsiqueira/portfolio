<?php
function compactarImagem($origem, $destino, $qualidade = 70) {
    $info = getimagesize($origem);
    $tipo = $info['mime'];

    switch ($tipo) {
        case 'image/jpeg':
            $imagem = imagecreatefromjpeg($origem);
            imagejpeg($imagem, $destino, $qualidade);
            break;

        case 'image/png':
            $imagem = imagecreatefrompng($origem);
            $compressao = 9 - round(($qualidade / 100) * 9);
            imagepng($imagem, $destino, $compressao);
            break;

        case 'image/webp':
            $imagem = imagecreatefromwebp($origem);
            imagewebp($imagem, $destino, $qualidade);
            break;

        default:
            move_uploaded_file($origem, $destino);
            return;
    }

    imagedestroy($imagem);
}


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
    // Compacta 👇
    compactarImagem($_FILES['foto']['tmp_name'], $fotoCaminho, 70);
    move_uploaded_file($_FILES['foto']['tmp_name'], $fotoCaminho);
    $foto = "uploads/" . $fotoNome;
}

$sql = "INSERT INTO usuarios (nome, login, senha, nivel, foto) VALUES ('$nome', '$login', '$senha', '$nivel', '$foto')";
mysqli_query($conn, $sql);

header("Location: ../usuarios-listar.php?msg=Usuário cadastrado com sucesso!");
exit;

