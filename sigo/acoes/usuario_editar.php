<?php
require('../includes/conexao.php');
session_start();

$id = intval($_POST['id']);
$nome = $_POST['nome'];
$login = $_POST['login'];
$nivel = $_POST['nivel'];
$senha = $_POST['senha'];

$sqlFoto = "";

// Função de compactação
function compactarImagem($origem, $destino, $qualidade = 70, $maxWidth = 1024, $maxHeight = 1024)
{
    $info = getimagesize($origem);
    $tipo = $info['mime'];

    switch ($tipo) {
        case 'image/jpeg':
            $imagem = imagecreatefromjpeg($origem);
            break;
        case 'image/png':
            $imagem = imagecreatefrompng($origem);
            break;
        case 'image/webp':
            $imagem = imagecreatefromwebp($origem);
            break;
        default:
            // Caso não seja imagem suportada, apenas move
            move_uploaded_file($origem, $destino);
            return;
    }

    // Redimensionar se maior que o limite
    $largura = imagesx($imagem);
    $altura  = imagesy($imagem);

    $scale = min($maxWidth / $largura, $maxHeight / $altura, 1);
    $novaLargura = floor($largura * $scale);
    $novaAltura  = floor($altura * $scale);

    $novaImagem = imagecreatetruecolor($novaLargura, $novaAltura);
    imagecopyresampled($novaImagem, $imagem, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);

    // Salva como JPG compactado
    imagejpeg($novaImagem, $destino, $qualidade);

    imagedestroy($imagem);
    imagedestroy($novaImagem);
}

// Upload e compactação
if (!empty($_FILES['foto']['name'])) {
    $pasta = "../uploads/";
    if (!is_dir($pasta)) mkdir($pasta, 0777, true);

    $fotoNome = uniqid() . ".jpg"; // converte tudo para JPG
    $fotoCaminho = $pasta . $fotoNome;

    compactarImagem($_FILES['foto']['tmp_name'], $fotoCaminho, 70);

    $fotoRel = "uploads/" . $fotoNome;
    $sqlFoto = ", foto = '$fotoRel'";

    echo "Tamanho antes: " . filesize($_FILES['foto']['tmp_name']) . " bytes<br>";
    echo "Tamanho depois: " . filesize($fotoCaminho) . " bytes<br>";
}

// Atualiza usuário
if (!empty($senha)) {
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    $sql = "UPDATE usuarios SET nome='$nome', login='$login', senha='$senhaHash', nivel='$nivel' $sqlFoto WHERE id=$id";
} else {
    $sql = "UPDATE usuarios SET nome='$nome', login='$login', nivel='$nivel' $sqlFoto WHERE id=$id";
}

mysqli_query($conn, $sql);
header("Location: ../usuarios-listar.php?msg=Usuário atualizado com sucesso!");
exit;
?>
