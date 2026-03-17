<?php
require('../includes/conexao.php');

if (!$conn) {
    die("ERRO DE CONEXÃO: Verifique 'conexao.php'");
}

if (!isset($_POST['data_inicio'], $_POST['data_fim'], $_POST['motivo'])) {
    header('Location: ../cadastrar-suspensao.php?msg=erro');
    exit;
}

if (!isset($_POST['alunos']) || !is_array($_POST['alunos']) || count($_POST['alunos']) === 0) {
    header('Location: ../cadastrar-suspensao.php?msg=no_alunos');
    exit;
}

$data_inicio = $_POST['data_inicio'];
$data_fim = $_POST['data_fim'];
$motivo = mb_strtoupper(trim($_POST['motivo']), 'UTF-8');
$alunos = $_POST['alunos'];

mysqli_begin_transaction($conn);

try {

    // inserir suspensão
    $stmt = mysqli_prepare($conn,
        "INSERT INTO suspensoes (data_inicio, data_fim, motivo) VALUES (?, ?, ?)"
    );

    if (!$stmt) {
        throw new Exception("Erro prepare suspensão: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "sss", $data_inicio, $data_fim, $motivo);

    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Erro execute suspensão: " . mysqli_stmt_error($stmt));
    }

    $suspensao_id = mysqli_insert_id($conn);

    mysqli_stmt_close($stmt);

    // inserir relação com alunos
    $stmt2 = mysqli_prepare($conn,
        "INSERT INTO suspensao_aluno (suspensao_id, alunos_id) VALUES (?, ?)"
    );

    if (!$stmt2) {
        throw new Exception("Erro prepare relação: " . mysqli_error($conn));
    }

    foreach ($alunos as $aluno_id_raw) {

        $aluno_id = intval($aluno_id_raw);

        if ($aluno_id <= 0) continue;

        mysqli_stmt_bind_param($stmt2, "ii", $suspensao_id, $aluno_id);

        if (!mysqli_stmt_execute($stmt2)) {
            throw new Exception("Erro execute relação: " . mysqli_stmt_error($stmt2));
        }
    }

    mysqli_stmt_close($stmt2);

    mysqli_commit($conn);

    header("Location: ../ver-suspensao.php?id=$suspensao_id");
    exit;

} catch (Exception $e) {

    mysqli_rollback($conn);

    error_log("Erro salvar-suspensao: " . $e->getMessage());

    header("Location: ../cadastrar-suspensao.php?msg=erro");
    exit;
}