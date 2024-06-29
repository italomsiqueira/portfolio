<?php
require ('../includes/conexao.php');
$login1 = $_POST['login'];
$senha1 = $_POST['senha'];

$sqlLogin = "SELECT * FROM usuarios";
$result = mysqli_query($conn, $sqlLogin);
while ($dados = mysqli_fetch_assoc($result)) {
    $login2 = $dados['login'];
    $senha2 = $dados['senha'];

    if ($login1 == $login2) {
        if ($senha1 == $senha2) {
            echo "
    <script>
        location.href = '../login.php?msg=sucesso'
    </script>
    ";
        } else {
            echo "
    <script>
        location.href = '../login.php?msg=errosenha'
    </script>
    ";
        }
    } else {
        echo "
    <script>
        location.href = '../login.php?msg=errologin'
    </script>
    ";
    }
}

?>