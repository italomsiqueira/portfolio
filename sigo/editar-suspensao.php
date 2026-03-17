<?php
require('includes/protecao.php');
require('includes/conexao.php');
$titulo = "Editar Suspensão";
include('layout/head.php');
include('layout/menu.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<div class='alert alert-danger m-4'>Suspensão não encontrada!</div>";
    exit;
}

$suspensao_id = intval($_GET['id']);
$sql = "SELECT * FROM suspensoes WHERE id = $suspensao_id";
$res = mysqli_query($conn, $sql);
$susp = mysqli_fetch_assoc($res);

if (!$susp) {
    echo "<div class='alert alert-danger m-4'>Suspensão não encontrada!</div>";
    exit;
}

// Alunos vinculados
$sql_alunos_vinc = "SELECT alunos_id FROM suspensao_aluno WHERE suspensao_id = $suspensao_id";
$res_vinc = mysqli_query($conn, $sql_alunos_vinc);
$alunos_vinc = [];
while ($a = mysqli_fetch_assoc($res_vinc))
    $alunos_vinc[] = $a['alunos_id'];
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- CARD EDITAR -->
            <div class="card shadow-lg rounded">
                <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="bi bi-pencil-square me-2"></i>
                        Editar Suspensão Nº<strong><?php echo $suspensao_id; ?></strong>
                    </h4>

                    <a href="ver-suspensao.php?id=<?= $suspensao_id ?>" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left-circle me-1"></i> Voltar
                    </a>
                </div>

                <div class="card-body">

                    <form action="acoes/atualizar-suspensao.php" method="POST">

                        <input type="hidden" name="id" value="<?= $suspensao_id ?>">

                        <div class="mb-3">
                            <label for="data_inicio" class="form-label">Data de Início</label>
                            <input type="date" name="data_inicio" id="data_inicio" class="form-control form-control-lg"
                                value="<?= $susp['data_inicio'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="data_fim" class="form-label">Data de Fim</label>
                            <input type="date" name="data_fim" id="data_fim" class="form-control form-control-lg"
                                value="<?= $susp['data_fim'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="motivo" class="form-label">Motivo da Suspensão</label>
                            <textarea name="motivo" id="motivo" class="form-control form-control-lg" rows="4"
                                required><?= htmlspecialchars($susp['motivo']) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="alunos" class="form-label">Alunos Suspensos</label>

                            <select name="alunos[]" id="alunos" class="selectpicker form-control" multiple
                                data-live-search="true" title="Selecione os alunos...">

                                <?php
                                $sql_alunos = "
                                                SELECT 
                                                a.id,
                                                a.nome,
                                                t.ano,
                                                t.turma
                                                FROM alunos a
                                                LEFT JOIN turma t ON t.id = a.turma
                                                ORDER BY t.ano, t.turma, a.nome
                                                ";

                                $res_alunos = mysqli_query($conn, $sql_alunos);

                                while ($aluno = mysqli_fetch_assoc($res_alunos)) {

                                    $selected = in_array($aluno['id'], $alunos_vinc) ? 'selected' : '';

                                    $ano = $aluno['ano'] ?? '';
                                    $turma = $aluno['turma'] ?? '';

                                    $labelTurma = ($ano || $turma) ? "{$ano}{$turma}" : "Turma não definida";

                                    $nome = htmlspecialchars($aluno['nome']);

                                    echo "<option value='{$aluno['id']}' $selected>{$labelTurma} - {$nome}</option>";
                                }
                                ?>

                            </select>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-danger btn-lg">
                                <i class="bi bi-save2 me-1"></i> Salvar Alterações
                            </button>
                        </div>

                        <a href="ver-suspensao.php?id=<?= $suspensao_id ?>" class="btn btn-secondary mt-3 col-12">
                            <i class="bi bi-x-circle me-1"></i> Cancelar
                        </a>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof $ !== 'undefined' && typeof $.fn.selectpicker !== 'undefined') {
            $('.selectpicker').selectpicker();
        }
    });
</script>