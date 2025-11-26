<?php
require('includes/protecao_admin.php');
require('includes/conexao.php');

$titulo = "Gerenciar Usuários";
include('layout/head.php');
include('layout/menu.php');

// Consulta
$result = mysqli_query($conn, "SELECT * FROM usuarios ORDER BY id DESC");
?>

<div class="container py-4">

    <!-- Título + Botão -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="m-0">
                <i class="bi bi-people-fill me-2 text-primary"></i> Gerenciar Usuários
            </h3>
            <a href="usuarios-cadastrar.php" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Novo Usuário
            </a>
        </div>
    </div>

    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-info shadow-sm"><?= htmlspecialchars($_GET['msg']) ?></div>
    <?php endif; ?>

    <!-- Tabela Premium -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary text-dark">
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>Nome</th>
                            <th>Login</th>
                            <th>Nível</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($u = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= $u['id'] ?></td>

                                <td>
                                    <img src="<?= $u['foto'] ?: 'assets/img/user-placeholder.png' ?>" 
                                         width="45" height="45" 
                                         class="rounded-circle border shadow-sm">
                                </td>

                                <td class="fw-semibold"><?= htmlspecialchars($u['nome']) ?></td>
                                <td><?= htmlspecialchars($u['login']) ?></td>

                                <td>
                                    <span class="badge 
                                        <?= $u['nivel'] === 'admin' ? 'bg-danger' : 'bg-secondary' ?>">
                                        <?= ucfirst($u['nivel']) ?>
                                    </span>
                                </td>

                                <td class="text-center">
                                    <a href="usuarios-editar.php?id=<?= $u['id'] ?>" 
                                       class="btn btn-sm btn-outline-primary me-1">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <a href="usuarios-excluir.php?id=<?= $u['id'] ?>" 
                                       class="btn btn-sm btn-outline-danger"
                                       onclick="return confirm('Tem certeza que deseja excluir este usuário?');">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>
