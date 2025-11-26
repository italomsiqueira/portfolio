<?php

if (isset($_GET['id'])) {
    require('../includes/conexao.php');
    $id = $_GET['id'];
    $sql = "DELETE FROM turma WHERE id = $id";

    if ($id == 1) {
        echo "
        <script>
        location.href='../listar-turmas.php?msg=deletarReserva';
        </script>
        ";
    } else {

        if (mysqli_query($conn, $sql)) {
            echo "
        <script>
        location.href='../listar-turmas.php?msg=sucesso';
        </script>
        ";
        } else {
            echo "
        <script>
        location.href='../listar-turmas.php?msg=erro';
        </script>
        ";
        }
    }
} else {
    echo "
    <script>
    alert('Ops! Algo está errado');
    location.href='../listar-turmas.php';
    </script>
    ";
}