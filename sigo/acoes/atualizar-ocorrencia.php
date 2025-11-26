<?php
require('../includes/conexao.php');

if (!isset($_POST['id'], $_POST['data'], $_POST['descricao'])) {
    header('Location: ../listar-ocorrencias.php?msg=erro');
    exit;
}

$id = intval($_POST['id']);
$data = $_POST['data'];
$descricao = mb_strtoupper(trim($_POST['descricao']), 'UTF-8');
$alunos = isset($_POST['alunos']) ? $_POST['alunos'] : [];

// Transação para segurança
mysqli_begin_transaction($conn);

try {
    // Atualiza dados principais
    $sql_upd = "UPDATE ocorrencia SET data = ?, descricao = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql_upd);
    mysqli_stmt_bind_param($stmt, "ssi", $data, $descricao, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Remove vínculos antigos
    mysqli_query($conn, "DELETE FROM ocorrencia_aluno WHERE ocorrencia_id = $id");

    // Adiciona vínculos novos
    if (is_array($alunos) && count($alunos) > 0) {
        $stmt2 = mysqli_prepare($conn, "INSERT INTO ocorrencia_aluno (ocorrencia_id, alunos_id) VALUES (?, ?)");
        foreach ($alunos as $aluno_id) {
            $aluno_id = intval($aluno_id);
            mysqli_stmt_bind_param($stmt2, "ii", $id, $aluno_id);
            mysqli_stmt_execute($stmt2);
        }
        mysqli_stmt_close($stmt2);
    }

    mysqli_commit($conn);
    header("Location: ../ver-ocorrencia.php?id=$id&msg=sucesso");
    exit;

} catch (Exception $e) {
    mysqli_rollback($conn);
    error_log("Erro ao atualizar ocorrência: " . $e->getMessage());
    header("Location: ../ver-ocorrencia.php?id=$id&msg=erro");
    exit;
}
?>
