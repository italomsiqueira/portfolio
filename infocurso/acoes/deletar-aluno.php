<?php 

if(isset($_GET['id'])){
    require('../includes/conexao.php');
    $id = $_GET['id'];
    $sql = "DELETE FROM alunos WHERE id = $id";

    if(mysqli_query($conn, $sql)){
        echo "
        <script>
        location.href='../listar-alunos.php?msg=sucesso';
        </script>
        ";
    }else{
        echo "
        <script>
        location.href='../listar-alunos.php?msg=erro';
        </script>
        ";
    }
}else{
    echo "
    <script>
    alert('Ops! Algo está errado');
    location.href='../listar-alunos.php';
    </script>
    ";
}
