<?php
require('includes/protecao_admin.php');
require('includes/conexao.php');

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM usuarios WHERE id = $id LIMIT 1");
$user = mysqli_fetch_assoc($result);

if (!$user) {
    header('Location: usuarios-listar.php?msg=Usuário não encontrado');
    exit;
}

$titulo = "Excluir Usuário";
include('layout/head.php');
include('layout/menu.php');
?>

<div class="container mt-4">
    <div class="card border-danger">
        <div class="card-header bg-danger text-white">
            <h5><i class="bi bi-trash me-2"></i>Excluir Usuário</h5>
        </div>
        <div class="card-body">
            <p>Tem certeza que deseja excluir o usuário <strong><?= htmlspecialchars($user['nome']) ?></strong>?</p>
            <form action="acoes/usuario_excluir.php" method="POST">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                <button type="submit" class="btn btn-danger">Sim, excluir</button>
                <a href="usuarios-listar.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
