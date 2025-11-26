<?php
require('includes/conexao.php');
session_start();

// Se já estiver logado, redireciona para o painel
if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}

// Mensagem de alerta
$msg = $_GET['msg'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/login-premium.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="login-card">
        <img src="assets/img/logo.png" class="logo" alt="Logo">

        <?php if ($msg): ?>
            <div class="alert alert-<?php
                                    switch ($msg) {
                                        case 'errologin':
                                            echo 'danger';
                                            break;
                                        case 'errosenha':
                                            echo 'danger';
                                            break;
                                        case 'logout':
                                            echo 'success';
                                            break;
                                        case 'naoautorizado':
                                            echo 'warning';
                                            break;
                                        default:
                                            echo 'info';
                                    }
                                    ?> alert-dismissible fade show" role="alert">
                <?php
                switch ($msg) {
                    case 'errologin':
                        echo "<strong>Usuário incorreto!</strong>";
                        break;
                    case 'errosenha':
                        echo "<strong>Senha incorreta!</strong>";
                        break;
                    case 'logout':
                        echo "<strong>Logout realizado com sucesso!</strong>";
                        break;
                    case 'naoautorizado':
                        echo "<strong>Faça login para acessar o sistema.</strong>";
                        break;
                    default:
                        echo htmlspecialchars($msg);
                }
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        <?php endif; ?>

        <form method="POST" action="acoes/login.php">
            <div class="mb-3 text-start">
                <label class="form-label"><i class="bi bi-person-fill me-1"></i>Login</label>
                <input type="text" class="form-control" name="login" required>
            </div>

            <div class="mb-3 text-start">
                <label class="form-label"><i class="bi bi-key-fill me-1"></i>Senha</label>
                <input type="password" class="form-control" name="senha" required>
            </div>

            <button type="submit" class="btn btn-success mb-2"><i class="bi bi-box-arrow-in-right me-1"></i>Entrar no sistema</button>
        </form>

        <div class="login-footer">
            &copy; <?= date('Y') ?> Sistema SIGO
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>