<?php
//VIA POST
//NAMES DOS MEUS INPUTS
/*
echo "<pre>";
var_dump($_POST);
echo "</pre>";
*/


require('../includes/conexao.php');
$hora = strtoupper($_POST['hora']);
$dia1 = strtoupper($_POST['dia1']);
$dia2 = strtoupper($_POST['dia2']);

$sql = "
        INSERT INTO turma
            (hora, dia1, dia2)
        VALUES
            ('$hora', '$dia1', '$dia2')
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


