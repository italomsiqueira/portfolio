<?php
require('includes/protecao.php');
require('includes/conexao.php');
$titulo = "Cadastrar Suspensão";
include('layout/head.php');
include('layout/menu.php');
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg rounded">

                <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>Cadastrar Suspensão
                    </h4>

                    <a href="listar-ocorrencias.php" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left-circle me-1"></i> Voltar
                    </a>
                </div>

                <div class="card-body">

                    <?php
                    if (isset($_GET['msg'])) {

                        $msgs = [
                            'sucesso' => ['alert-success', 'Suspensão cadastrada com sucesso!'],
                            'erro' => ['alert-danger', 'Erro ao cadastrar suspensão.'],
                            'no_alunos' => ['alert-warning', 'Selecione ao menos um aluno.']
                        ];

                        if (isset($msgs[$_GET['msg']])) {
                            echo "<div class='alert {$msgs[$_GET['msg']][0]}'>{$msgs[$_GET['msg']][1]}</div>";
                        }

                    }
                    ?>

                    <form action="acoes/salvar-suspensao.php" method="POST">

                        <div class="mb-3">
                            <label class="form-label">Data de Início</label>
                            <input type="date" name="data_inicio" class="form-control form-control-lg"
                                value="<?= date('Y-m-d') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Data de Fim</label>
                            <input type="date" name="data_fim" class="form-control form-control-lg" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Motivo da Suspensão</label>
                            <textarea name="motivo" class="form-control form-control-lg" rows="4" required></textarea>
                        </div>

                        <div class="mb-3">

                            <label class="form-label">Selecione os Alunos</label>

                            <select name="alunos[]" class="selectpicker form-control" multiple data-live-search="true"
                                title="Escolha os alunos..." required>

                                <?php

                                $sql = "
SELECT a.id,a.nome,a.turma AS turma_id,t.ano,t.turma
FROM alunos a
LEFT JOIN turma t ON t.id=a.turma
ORDER BY a.nome
";

                                $resultado = mysqli_query($conn, $sql);

                                if ($resultado && mysqli_num_rows($resultado) > 0) {

                                    while ($row = mysqli_fetch_assoc($resultado)) {

                                        $aluno_id = intval($row['id']);
                                        $aluno_nome = htmlspecialchars($row['nome']);
                                        $ano = $row['ano'] ?? '';
                                        $turma = $row['turma'] ?? '';

                                        $labelTurma = ($ano != '' || $turma != '') ? "$ano$turma" : 'Turma não definida';

                                        echo "<option value='{$aluno_id}'>{$labelTurma} - {$aluno_nome}</option>";

                                    }

                                } else {

                                    echo "<option disabled>Nenhum aluno encontrado</option>";

                                }

                                ?>

                            </select>

                        </div>

                        <div class="d-grid mt-4">

                            <button type="submit" class="btn btn-danger btn-lg">
                                <i class="bi bi-save2 me-1"></i> Salvar Suspensão
                            </button>

                        </div>

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