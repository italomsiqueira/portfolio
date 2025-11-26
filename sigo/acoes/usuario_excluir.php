<?php
require('../includes/conexao.php');
session_start();

$id = intval($_POST['id']);

// Busca para remover a foto do servidor
$q = mysqli_query($conn, "SELECT foto FROM usuarios WHERE id=$id");
if ($q && $r = mysqli_fetch_assoc($q)) {
    if (!empty($r['foto']) && file_exists("../" . $r['foto'])) {
        unlink("../" . $r['foto']);
    }
}

// Exclui o usuário
mysqli_query($conn, "DELETE FROM usuarios WHERE id=$id");

header("Location: ../usuarios-listar.php?msg=Usuário excluído com sucesso!");
exit;
