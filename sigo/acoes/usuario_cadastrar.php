<?php
require('../includes/conexao.php');
session_start();

// Função para compactar/redimensionar imagem
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
            // Se não for imagem suportada, apenas move o arquivo
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

    // Para PNG e WebP com transparência
    imagealphablending($novaImagem, false);
    imagesavealpha($novaImagem, true);

    imagecopyresampled($novaImagem, $imagem, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);

    // Salva como JPG (mesmo PNG/WebP)
    imagejpeg($novaImagem, $destino, $qualidade);

    imagedestroy($imagem);
    imagedestroy($novaImagem);
}

// Recebendo dados do formulário
$nome  = $_POST['nome'];
$login = $_POST['login'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$nivel = $_POST['nivel'];
$foto  = null;

// Upload e compactação
if (!empty($_FILES['foto']['name'])) {
    $pasta = "../uploads/";
    if (!is_dir($pasta)) mkdir($pasta, 0777, true);

    $fotoNome = uniqid() . ".jpg"; // padroniza JPG
    $fotoCaminho = $pasta . $fotoNome;

    // Compacta a imagem
    compactarImagem($_FILES['foto']['tmp_name'], $fotoCaminho, 70);

    $foto = "uploads/" . $fotoNome;

    // DEBUG (descomente se quiser ver tamanho)
    // echo "Antes: " . filesize($_FILES['foto']['tmp_name']) . " bytes<br>";
    // echo "Depois: " . filesize($fotoCaminho) . " bytes<br>";
}

// Inserindo no banco
$sql = "INSERT INTO usuarios (nome, login, senha, nivel, foto) VALUES ('$nome', '$login', '$senha', '$nivel', '$foto')";
mysqli_query($conn, $sql);

header("Location: ../usuarios-listar.php?msg=Usuário cadastrado com sucesso!");
exit;
?>
