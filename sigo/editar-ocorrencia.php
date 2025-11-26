<?php
require('includes/protecao.php');
require('includes/conexao.php');
$titulo = "Editar Ocorrência";
include('layout/head.php');
include('layout/menu.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<div class='alert alert-danger m-4'>Ocorrência não encontrada!</div>";
    exit;
}

$ocorrencia_id = intval($_GET['id']);
$sql = "SELECT * FROM ocorrencia WHERE id = $ocorrencia_id";
$res = mysqli_query($conn, $sql);
$oc = mysqli_fetch_assoc($res);

if (!$oc) {
    echo "<div class='alert alert-danger m-4'>Ocorrência não encontrada!</div>";
    exit;
}

// Alunos vinculados
$sql_alunos_vinc = "SELECT alunos_id FROM ocorrencia_aluno WHERE ocorrencia_id = $ocorrencia_id";
$res_vinc = mysqli_query($conn, $sql_alunos_vinc);
$alunos_vinc = [];
while ($a = mysqli_fetch_assoc($res_vinc)) $alunos_vinc[] = $a['alunos_id'];
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- CARD EDITAR -->
            <div class="card shadow-lg rounded">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Editar Ocorrência Nº<strong><?php echo $ocorrencia_id; ?></strong></h4>
                    <a href="ver-ocorrencia.php?id=<?= $ocorrencia_id ?>" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left-circle me-1"></i> Voltar
                    </a>
                </div>

                <div class="card-body">
                    <form action="acoes/atualizar-ocorrencia.php" method="POST">
                        <input type="hidden" name="id" value="<?= $ocorrencia_id ?>">

                        <div class="mb-3">
                            <label for="data" class="form-label">Data da Ocorrência</label>
                            <input type="date" name="data" id="data" class="form-control form-control-lg" value="<?= $oc['data'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição</label>
                            <textarea name="descricao" id="descricao" class="form-control form-control-lg" rows="4" required><?= htmlspecialchars($oc['descricao']) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="alunos" class="form-label">Alunos Envolvidos</label>
                            <select name="alunos[]" id="alunos" class="selectpicker form-control" multiple data-live-search="true" title="Selecione os alunos...">
                                <?php
                                $sql_alunos = "SELECT id, nome FROM alunos ORDER BY nome";
                                $res_alunos = mysqli_query($conn, $sql_alunos);
                                while ($aluno = mysqli_fetch_assoc($res_alunos)) {
                                    $selected = in_array($aluno['id'], $alunos_vinc) ? 'selected' : '';
                                    echo "<option value='{$aluno['id']}' $selected>{$aluno['nome']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="bi bi-save2 me-1"></i> Salvar Alterações
                            </button>
                        </div>

                        <a href="ver-ocorrencia.php?id=<?= $ocorrencia_id ?>" class="btn btn-secondary mt-3 col-12">
                            <i class="bi bi-x-circle me-1"></i> Cancelar
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    if(typeof $ !== 'undefined' && typeof $.fn.selectpicker !== 'undefined') {
        $('.selectpicker').selectpicker();
    }
});
</script>
