<?php
require('includes/protecao.php');
require('includes/conexao.php');

// Determina se é listagem normal, por turma ou por nome
$pagina = 'listar'; // default
$turmaInfo = '';
$nomeBusca = '';

$condicoes = [];

if(!empty($_GET['nomeBusca'])) {
    $nomeBusca = strtoupper($_GET['nomeBusca']);
    $condicoes[] = "nome LIKE '$nomeBusca%'";
}

if(!empty($_GET['id'])) {
    $idTurma = $_GET['id'];
    $condicoes[] = "turma = $idTurma";

    // Buscar info da turma (para título)
    $turmaBusca = mysqli_query($conn, "SELECT ano, turma FROM turma WHERE id = $idTurma");
    $t = mysqli_fetch_assoc($turmaBusca);
    $turmaInfo = "Turma: " . $t['ano'] . " - " . $t['turma'];
}

// Monta SQL
$sql = "SELECT * FROM alunos";

if(count($condicoes) > 0) {
    $sql .= " WHERE " . implode(" AND ", $condicoes);
}

$sql .= " ORDER BY nome ASC";

$titulo = "Lista de Alunos";
include('layout/head.php');
include('layout/menu.php');
?>

<div class="container mt-4">

    <!-- CARD DE BUSCA (apenas para busca por nome) -->
    <?php if ($pagina == 'listar' || $pagina == 'nome'): ?>
        
        <div class="card shadow border-0 mb-4">
            <div class="card-body">
                <h4 class="mb-3">
                    <i class="bi bi-funnel me-2"></i>Filtros de Busca
                </h4>

                <form method="GET" class="row g-3 align-items-end">

                    <!-- NOME -->
                    <div class="col-md-6">
                        <label class="form-label">Nome do aluno</label>
                        <input type="text" name="nomeBusca" class="form-control form-control-lg"
                            placeholder="Digite o nome..." value="<?= htmlspecialchars($nomeBusca ?? '') ?>">
                    </div>

                    <!-- TURMA -->
                    <div class="col-md-4">
                        <label class="form-label">Turma</label>
                        <select name="id" class="form-select form-select-lg">
                            <option value="">Todas as turmas</option>
                            <?php
                            $turmas = mysqli_query($conn, "SELECT id, ano, turma FROM turma ORDER BY ano, turma");
                            while ($t = mysqli_fetch_assoc($turmas)):
                                ?>
                                <option value="<?= $t['id'] ?>" <?= (isset($_GET['id']) && $_GET['id'] == $t['id']) ? 'selected' : '' ?>>
                                    <?= $t['ano'] ?> - <?= $t['turma'] ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <!-- BOTÕES -->
                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="bi bi-search"></i>
                        </button>

                        <a href="listar-alunos.php" class="btn btn-secondary btn-lg w-100">
                            <i class="bi bi-arrow-clockwise"></i>
                        </a>
                    </div>

                </form>
            </div>
        </div>

    <?php endif; ?>

    <!-- CARD DA TABELA -->
    <div class="card shadow-lg border-0">
        <div class="card-body p-4">

            <?php if ($turmaInfo): ?>
                <h4 class="mb-4"><i class="bi bi-people-fill me-2"></i><?= $turmaInfo ?></h4>
            <?php else: ?>
                <h4 class="mb-4"><i class="bi bi-people-fill me-2"></i>Alunos Cadastrados</h4>
            <?php endif; ?>

            <!-- Mensagens de alerta -->
            <?php if (isset($_GET['msg'])): ?>
                <div class="alert alert-<?= $_GET['msg'] == 'sucesso' ? 'success' : 'danger' ?>">
                    <strong><?= $_GET['msg'] == 'sucesso' ? 'Deletado com sucesso!' : 'Erro ao deletar!' ?></strong>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th style="width: 30%;">Nome</th>
                            <th>CPF</th>
                            <th style="width: 30%;">Endereço</th>
                            <th>Telefone</th>
                            <th>Turma</th>
                            <th style="width: 130px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = mysqli_query($conn, $sql);
                        while ($al = mysqli_fetch_assoc($result)):
                            $turma_id = $al['turma'];
                            $turma_sql = mysqli_query($conn, "SELECT ano, turma FROM turma WHERE id = $turma_id");
                            $turma = mysqli_fetch_assoc($turma_sql);
                            $turma_final = $turma ? $turma['ano'] . " - " . $turma['turma'] : "<span class='text-danger fw-bold'>Não cadastrado</span>";
                            ?>
                            <tr>
                                <td><?= $al['id'] ?></td>
                                <td><?= $al['nome'] ?></td>
                                <td><?= $al['cpf'] ?></td>
                                <td><?= $al['endereco'] ?></td>
                                <td><?= $al['tel'] ?></td>
                                <td><?= $turma_final ?></td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="editar-aluno.php?id=<?= $al['id'] ?>"
                                            class="btn btn-primary btn-sm rounded-circle p-2" title="Editar">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <a href="acoes/deletar-aluno.php?id=<?= $al['id'] ?>"
                                            onclick="return confirm('Deseja realmente excluir este aluno?');"
                                            class="btn btn-danger btn-sm rounded-circle p-2" title="Deletar">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-4">
                <button id="btnExport" class="btn btn-success btn-lg px-5">
                    <i class="bi bi-file-earmark-excel"></i> Exportar para Excel
                </button>
            </div>

            <?php if ($pagina == 'nome' || $pagina == 'turma'): ?>
                <div class="text-center mt-3">
                    <a href="listar-alunos.php" class="btn btn-info btn-lg px-4">
                        <i class="bi bi-arrow-left-circle me-2"></i>Voltar
                    </a>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>