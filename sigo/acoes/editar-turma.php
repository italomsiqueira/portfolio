<?php
require('../includes/conexao.php');
$id = $_POST['id'];
$ano = strtoupper($_POST['ano']);
$turma = strtoupper($_POST['turma']);

$sql = "
    UPDATE turma SET
    ano = '$ano',
    turma = '$turma'
    WHERE id = $id";

if ($id == 1) {
    echo "
    <script>
    location.href='../listar-turmas.php?msg=editarReserva';
    </script>
    ";
} else {

    if (mysqli_query($conn, $sql) && $id !== 1) {
        echo "
    <script>
    location.href='../listar-turmas.php?msg=editar';
    </script>
    ";
    } else {
        echo "
    <script>
    location.href='../listar-turmas.php?msg=erroEditar';
    </script>
    ";
    }
}