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

$titulo = "Editar Usuário";
include('layout/head.php');
include('layout/menu.php');
?>

<div class="container py-4">

    <div class="card shadow-sm border-0 col-lg-6 mx-auto">
        <div class="card-body">

            <h3 class="mb-4">
                <i class="bi bi-pencil-square text-primary me-2"></i>
                Editar Usuário
            </h3>

            <form action="acoes/usuario_editar.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nome</label>
                    <input type="text" name="nome" class="form-control" 
                           value="<?= htmlspecialchars($user['nome']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Login</label>
                    <input type="text" name="login" class="form-control" 
                           value="<?= htmlspecialchars($user['login']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Senha (opcional)</label>
                    <input type="password" name="senha" class="form-control"
                           placeholder="Deixe em branco para manter">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nível</label>
                    <select name="nivel" class="form-select">
                        <option value="usuario" <?= $user['nivel'] === 'usuario' ? 'selected' : '' ?>>
                            Usuário
                        </option>
                        <option value="admin" <?= $user['nivel'] === 'admin' ? 'selected' : '' ?>>
                            Administrador
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Foto atual</label><br>

                    <img src="<?= $user['foto'] ?: 'assets/img/user-placeholder.png' ?>" 
                         width="80" height="80" 
                         class="rounded-circle shadow-sm mb-2 border">

                    <input type="file" name="foto" class="form-control mt-2" accept="image/*">
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="usuarios-listar.php" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left-circle me-1"></i> Cancelar
                    </a>

                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-check-circle me-1"></i> Salvar alterações
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
