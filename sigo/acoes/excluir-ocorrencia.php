<?php
require('../includes/conexao.php');

if (!isset($_GET['id'])) {
    header('Location: listar-ocorrencias.php?msg=erro');
    exit;
}

$id = intval($_GET['id']);

// Transação
mysqli_begin_transaction($conn);

try {
    // Apaga vínculos primeiro
    mysqli_query($conn, "DELETE FROM ocorrencia_aluno WHERE ocorrencia_id = $id");

    // Apaga a ocorrência
    mysqli_query($conn, "DELETE FROM ocorrencia WHERE id = $id");

    mysqli_commit($conn);
    header('Location: ../listar-ocorrencias.php?msg=sucesso');
    exit;
} catch (Exception $e) {
    mysqli_rollback($conn);
    error_log("Erro ao excluir ocorrência: " . $e->getMessage());
    header('Location: ../listar-ocorrencias.php?msg=erro');
    exit;
}
?>
