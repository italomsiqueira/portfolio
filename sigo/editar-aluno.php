<?php
require('includes/protecao.php');
require('includes/conexao.php');

$id = intval($_GET['id']);
$sql = "SELECT * FROM alunos WHERE id = $id LIMIT 1";
$result = mysqli_query($conn, $sql);
$al = mysqli_fetch_assoc($result);

if (!$al) {
    header("Location: listar-alunos.php?msg=erro");
    exit;
}

$titulo = "Editar Aluno";
include('layout/head.php');
include('layout/menu.php');
?>

<div class="container mt-4">

    <div class="card shadow-lg border-0">
        <div class="card-body p-4">

            <h3 class="mb-4">
                <i class="bi bi-pencil-square me-2"></i>Editar Aluno — <?= htmlspecialchars($al['nome']) ?>
            </h3>

            <?php if (isset($_GET['msg'])): ?>
                <div class="alert alert-<?= $_GET['msg'] == 'sucesso' ? 'success' : 'danger' ?>">
                    <strong><?= $_GET['msg'] == 'sucesso' ? 'Alterado com sucesso!' : 'Erro ao alterar!' ?></strong>
                </div>
            <?php endif; ?>

            <form action="acoes/editar-aluno.php" method="POST" class="row g-3">

                <input type="hidden" name="id" value="<?= $al['id'] ?>">

                <div class="col-md-6">
                    <label class="form-label">Nome:</label>
                    <input type="text" name="nome" class="form-control" value="<?= $al['nome'] ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">RG:</label>
                    <input type="text" name="rg" class="form-control" value="<?= $al['rg'] ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label">CPF:</label>
                    <input type="text" name="cpf" id="cpf" class="form-control" value="<?= $al['cpf'] ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Telefone:</label>
                    <input type="text" name="tel" id="tel" class="form-control" value="<?= $al['tel'] ?>">
                </div>

                <div class="col-md-12">
                    <label class="form-label">Endereço:</label>
                    <input type="text" name="endereco" class="form-control"
                        value="<?= $al['endereco'] ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Turma:</label>
                    <select name="turma" class="form-select">
                        <option value="">Selecione...</option>
                        <?php
                        $res = mysqli_query($conn, "SELECT * FROM turma ORDER BY id ASC");
                        while ($t = mysqli_fetch_assoc($res)):
                        ?>
                            <option value="<?= $t['id'] ?>" <?= $t['id'] == $al['turma'] ? 'selected' : '' ?>>
                                <?= $t['ano'] ?> - <?= $t['turma'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="col-md-12 mt-3">
                    <button class="btn btn-primary px-4">
                        <i class="bi bi-check-circle"></i> Salvar alterações
                    </button>
                    <a href="listar-alunos.php" class="btn btn-secondary px-4">Cancelar</a>
                </div>

            </form>

        </div>
    </div>

</div>

<script>
    $("#tel").mask("(00) 00000-0000");
    $("#cpf").mask("000.000.000-00");
</script>
