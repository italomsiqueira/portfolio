<?php
//VIA POST
//NAMES DOS MEUS INPUTS
/*
echo "<pre>";
var_dump($_POST);
echo "</pre>";
*/


require('../includes/conexao.php');
$ano = strtoupper($_POST['ano']);
$turma = strtoupper($_POST['turma']);

$sql = "
        INSERT INTO turma
            (ano, turma)
        VALUES
            ('$ano', '$turma')
";

if(mysqli_query($conn, $sql)){    
    echo "
    <script>
        location.href = '../cadastrar-turma.php?msg=sucesso'
    </script>
    ";
}else{
    echo "
    <script>
        location.href = '../cadastrar-turma.php?msg=erro'
    </script>
    ";
}


