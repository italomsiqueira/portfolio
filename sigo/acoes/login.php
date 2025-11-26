<?php
session_start();
require('../includes/conexao.php');

if (!isset($_POST['login'], $_POST['senha'])) {
    header('Location: ../login.php?msg=camposvazios');
    exit;
}

$login = mysqli_real_escape_string($conn, $_POST['login']);
$senha = $_POST['senha'];

// Busca o usuário
$sql = "SELECT * FROM usuarios WHERE login = '$login' LIMIT 1";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);

    if (password_verify($senha, $user['senha'])) {
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario_nome'] = $user['nome'];
        $_SESSION['usuario_nivel'] = $user['nivel'];
        $_SESSION['usuario_login'] = $user['login'];
        $_SESSION['usuario_foto'] = $user['foto'] ?? 'assets/img/user-placeholder.png';

        header('Location: ../index.php');
        exit;
    } else {
        header('Location: ../login.php?msg=errosenha');
        exit;
    }
} else {
    header('Location: ../login.php?msg=errologin');
    exit;
}
?>
