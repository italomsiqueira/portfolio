<?php

$servidor = "localhost";
$usuario  = "root";
$senha    = "";
$banco    = "sigo";

/*
 | Detecta se está em produção (InfinityFree)
 | No InfinityFree, SERVER_NAME nunca será localhost
 */
if ($_SERVER['SERVER_NAME'] !== 'localhost') {
    $servidor = "sql100.infinityfree.com";
    $usuario  = "if0_40566558";
    $senha    = "Raquel0608";
    $banco    = "if0_40566558_sigo";
}

$conn = mysqli_connect($servidor, $usuario, $senha, $banco);

if (!$conn) {
    die("Erro ao conectar no banco: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
