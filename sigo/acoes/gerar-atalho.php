<?php
require('../includes/protecao.php');

// 🔒 Proteção
if(!isset($_SESSION['usuario_login']) || $_SESSION['usuario_login'] !== 'italo') {
    die("Acesso negado.");
}

// Configurações
$url = "http://italosiqueira.com.br/sigo/login.php"; // 🔴 ALTERE AQUI
$icone = "http://italosiqueira.com.br/assets/img/favicon.ico"; // ícone

$conteudo = "[InternetShortcut]\n";
$conteudo .= "URL=$url\n";
$conteudo .= "IconFile=$icone\n";
$conteudo .= "IconIndex=1\n";

// Força download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="SIGO.url"');

echo $conteudo;
exit;