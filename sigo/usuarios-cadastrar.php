<?php
require('includes/protecao_admin.php');
$titulo = "Cadastrar Usuário";
include('layout/head.php');
include('layout/menu.php');
?>

<div class="container py-4">

    <div class="card shadow-sm border-0 col-lg-6 mx-auto">
        <div class="card-body">

            <h3 class="mb-4">
                <i class="bi bi-person-plus-fill text-primary me-2"></i>
                Novo Usuário
            </h3>

            <form action="acoes/usuario_cadastrar.php" method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nome</label>
                    <input type="text" name="nome" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Login</label>
                    <input type="text" name="login" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Senha</label>
                    <input type="password" name="senha" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nível</label>
                    <select name="nivel" class="form-select">
                        <option value="usuario">Usuário</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Foto (opcional)</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="usuarios-listar.php" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left-circle me-1"></i> Cancelar
                    </a>

                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-check-circle me-1"></i> Salvar
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
