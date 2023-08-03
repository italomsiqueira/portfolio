<?php
require('../includes/conexao.php');
$id = $_POST['id'];
$hora = strtoupper($_POST['hora']);
$dia1 = strtoupper($_POST['dia1']);
$dia2 = strtoupper($_POST['dia2']);

$sql = "
    UPDATE turma SET
    hora = '$hora',
    dia1 = '$dia1',
    dia2 = '$dia2'
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