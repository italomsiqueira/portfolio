<?php
require('../includes/protecao.php');

// 🔒 BLOQUEIO DE ACESSO
if (!isset($_SESSION['usuario_login']) || $_SESSION['usuario_login'] !== 'italo') {
    die("Acesso negado.");
}

// Lista de arquivos permitidos
$arquivosPermitidos = [
    'favicon.ico',
    'favicon.png',
    'logo.png',
    'logo-cinza.png',
    'logo-cinza-simples.png',
    'italo-a4.jpg',
    'italo-quadrado.jpg'
];

// Validação do parâmetro
if (!isset($_GET['file']) || !in_array($_GET['file'], $arquivosPermitidos)) {
    die("Arquivo inválido.");
}

$arquivo = $_GET['file'];
$caminho = "../assets/img/" . $arquivo;

// Verifica se o arquivo existe
if (!file_exists($caminho)) {
    die("Arquivo não encontrado.");
}

// Limpa buffer (evita problemas no download)
if (ob_get_level()) {
    ob_end_clean();
}

// Headers para download
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($arquivo) . '"');
header('Content-Length: ' . filesize($caminho));
header('Pragma: public');
header('Cache-Control: must-revalidate');

// Envia arquivo
readfile($caminho);
exit;