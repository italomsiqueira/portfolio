<?php
require('includes/protecao.php');
require('includes/conexao.php');

// Determina se é listagem normal, por turma ou por nome
$pagina = 'listar'; // default
$turmaInfo = '';
$nomeBusca = '';

if(isset($_GET['id']) && isset($_GET['ano']) && isset($_GET['turma'])) {
    // Listagem por turma
    $pagina = 'turma';
    $idTurma = $_GET['id'];
    $anoTurma = $_GET['ano'];
    $turmaTurma = $_GET['turma'];
    $sql = "SELECT * FROM alunos WHERE turma = $idTurma ORDER BY nome ASC";
    $turmaInfo = "Turma: $anoTurma - $turmaTurma";
} elseif(isset($_GET['nomeBusca'])) {
    // Listagem por nome
    $pagina = 'nome';
    $nomeBusca = strtoupper($_GET['nomeBusca']);
    $sql = "SELECT * FROM alunos WHERE nome LIKE '$nomeBusca%' ORDER BY nome ASC";
} else {
    // Listagem geral
    $sql = "SELECT * FROM alunos ORDER BY nome ASC";
}

$titulo = "Lista de Alunos";
include('layout/head.php');
include('layout/menu.php');
?>

<div class="container mt-4">

    <!-- CARD DE BUSCA (apenas para busca por nome) -->
    <?php if($pagina == 'listar' || $pagina == 'nome'): ?>
    <div class="card shadow border-0 mb-4">
        <div class="card-body">
            <h4 class="mb-3"><i class="bi bi-search me-2"></i>Buscar Aluno</h4>
            <form action="aluno-nome.php" method="GET" class="row g-3">
                <div class="col-md-9">
                    <input type="text" name="nomeBusca" id="nomeBusca"
                           class="form-control form-control-lg"
                           placeholder="Digite o nome do aluno..." value="<?= htmlspecialchars($nomeBusca) ?>" />
                </div>
                <div class="col-md-3">
                    <button class="btn btn-dark btn-lg w-100"><i class="bi bi-search"></i> Buscar</button>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <!-- CARD DA TABELA -->
    <div class="card shadow-lg border-0">
        <div class="card-body p-4">
            
            <?php if($turmaInfo): ?>
                <h4 class="mb-4"><i class="bi bi-people-fill me-2"></i><?= $turmaInfo ?></h4>
            <?php else: ?>
                <h4 class="mb-4"><i class="bi bi-people-fill me-2"></i>Alunos Cadastrados</h4>
            <?php endif; ?>

            <!-- Mensagens de alerta -->
            <?php if(isset($_GET['msg'])): ?>
                <div class="alert alert-<?= $_GET['msg']=='sucesso' ? 'success' : 'danger' ?>">
                    <strong><?= $_GET['msg']=='sucesso' ? 'Deletado com sucesso!' : 'Erro ao deletar!' ?></strong>
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
                        while($al = mysqli_fetch_assoc($result)):
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
                                    <a href="editar-aluno.php?id=<?= $al['id'] ?>" class="btn btn-primary btn-sm rounded-circle p-2" title="Editar">
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

            <?php if($pagina == 'nome' || $pagina == 'turma'): ?>
                <div class="text-center mt-3">
                    <a href="listar-alunos.php" class="btn btn-info btn-lg px-4">
                        <i class="bi bi-arrow-left-circle me-2"></i>Voltar
                    </a>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>
