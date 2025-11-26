<?php
require('../includes/conexao.php');

if (!$conn) {
    die("ERRO DE CONEXÃO: Verifique 'conexao.php'");
}

// Validação básica de existência dos campos
if (!isset($_POST['data'], $_POST['descricao'])) {
    header('Location: ../cadastrar-ocorrencia.php?msg=erro');
    exit;
}

// Verifica se o array alunos[] foi enviado
if (!isset($_POST['alunos']) || !is_array($_POST['alunos']) || count($_POST['alunos']) === 0) {
    header('Location: ../cadastrar-ocorrencia.php?msg=no_alunos');
    exit;
}

$data = $_POST['data'];
$descricao = mb_strtoupper(trim($_POST['descricao']), 'UTF-8');
$alunos = $_POST['alunos']; // array de ids

// Começa transação (para garantir atomicidade)
mysqli_begin_transaction($conn);

try {
    // Prepared statement para inserir ocorrência
    $stmt = mysqli_prepare($conn, "INSERT INTO ocorrencia (`data`, descricao) VALUES (?, ?)");
    if (!$stmt) throw new Exception('Prepare failed (ocorrencia): ' . mysqli_error($conn));

    mysqli_stmt_bind_param($stmt, "ss", $data, $descricao);
    if (!mysqli_stmt_execute($stmt)) throw new Exception('Execute failed (ocorrencia): ' . mysqli_stmt_error($stmt));
    $ocorrencia_id = mysqli_insert_id($conn);
    mysqli_stmt_close($stmt);

    // Prepared statement para inserir relação ocorrencia_aluno
    $stmt2 = mysqli_prepare($conn, "INSERT INTO ocorrencia_aluno (ocorrencia_id, alunos_id) VALUES (?, ?)");
    if (!$stmt2) throw new Exception('Prepare failed (rel): ' . mysqli_error($conn));

    foreach ($alunos as $aluno_id_raw) {
        // sanitiza/casta id para inteiro (proteção)
        $aluno_id = intval($aluno_id_raw);
        if ($aluno_id <= 0) continue; // pula ids inválidos

        mysqli_stmt_bind_param($stmt2, "ii", $ocorrencia_id, $aluno_id);
        if (!mysqli_stmt_execute($stmt2)) {
            throw new Exception('Execute failed (rel): ' . mysqli_stmt_error($stmt2));
        }
    }

    mysqli_stmt_close($stmt2);

    // Commit se tudo OK
    mysqli_commit($conn);
    header("Location: ../ver-ocorrencia.php?id=$ocorrencia_id");
    exit;
} catch (Exception $e) {
    // Rollback em caso de erro
    mysqli_rollback($conn);

    // Opcional: log do erro em arquivo para debug (remova em produção)
    error_log("Erro salvar-ocorrencia.php: " . $e->getMessage());

    // Redireciona com erro
    header('Location: ../cadastrar-ocorrencia.php?msg=erro');
    exit;
}
