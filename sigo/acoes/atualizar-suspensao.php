<?php
require('../includes/protecao.php');
require('../includes/conexao.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../listar-suspensoes.php");
    exit;
}

$id = intval($_POST['id']);
$data_inicio = $_POST['data_inicio'];
$data_fim = $_POST['data_fim'];
$motivo = mb_strtoupper(trim($_POST['motivo']), 'UTF-8');
$alunos = $_POST['alunos'] ?? [];

mysqli_begin_transaction($conn);

try {

    // atualizar suspensão
    $stmt = mysqli_prepare(
        $conn,
        "UPDATE suspensoes
SET data_inicio=?, data_fim=?, motivo=?
WHERE id=?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "sssi",
        $data_inicio,
        $data_fim,
        $motivo,
        $id
    );

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    // apagar alunos antigos
    $stmt = mysqli_prepare(
        $conn,
        "DELETE FROM suspensao_aluno WHERE suspensao_id=?"
    );

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // inserir novamente
    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO suspensao_aluno (suspensao_id, alunos_id)
VALUES (?,?)"
    );

    foreach ($alunos as $aluno) {

        $aluno = intval($aluno);

        mysqli_stmt_bind_param($stmt, "ii", $id, $aluno);
        mysqli_stmt_execute($stmt);

    }

    mysqli_stmt_close($stmt);

    mysqli_commit($conn);

    header("Location: ../ver-suspensao.php?id=$id");

} catch (Exception $e) {

    mysqli_rollback($conn);

    header("Location: ../editar-suspensao.php?id=$id&msg=erro");

}