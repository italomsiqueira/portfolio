<?php
require('../includes/protecao.php');
require('../includes/conexao.php');

if (!$conn) {
    die("Erro de conexão com o banco.");
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: ../listar-suspensoes.php?msg=erro");
    exit;
}

$suspensao_id = intval($_GET['id']);

mysqli_begin_transaction($conn);

try {

    // excluir relação com alunos
    $stmt1 = mysqli_prepare($conn, "DELETE FROM suspensao_aluno WHERE suspensao_id = ?");
    if (!$stmt1) {
        throw new Exception(mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt1, "i", $suspensao_id);
    mysqli_stmt_execute($stmt1);
    mysqli_stmt_close($stmt1);

    // excluir suspensão
    $stmt2 = mysqli_prepare($conn, "DELETE FROM suspensoes WHERE id = ?");
    if (!$stmt2) {
        throw new Exception(mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt2, "i", $suspensao_id);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt2);

    mysqli_commit($conn);

    header("Location: ../listar-suspensoes.php?msg=excluido");
    exit;

} catch (Exception $e) {

    mysqli_rollback($conn);

    error_log("Erro excluir-suspensao: " . $e->getMessage());

    header("Location: ../listar-suspensoes.php?msg=erro");
    exit;
}