<?php
require('includes/protecao.php');
require('includes/conexao.php');
$titulo = "Cadastrar Ocorrência";
include('layout/head.php');
include('layout/menu.php');
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- CARD PRINCIPAL -->
            <div class="card shadow-lg rounded">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>Cadastrar Ocorrência</h4>
                    <a href="listar-ocorrencias.php" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left-circle me-1"></i> Voltar
                    </a>
                </div>

                <div class="card-body">

                    <?php
                    if (isset($_GET['msg'])) {
                        $msgs = [
                            'sucesso' => ['alert-success', 'Ocorrência salva com sucesso!'],
                            'erro' => ['alert-danger', 'Erro ao salvar ocorrência.'],
                            'no_alunos' => ['alert-warning', 'Selecione ao menos um aluno.'],
                            'debug' => ['alert-info', 'Debug: verifique payload no DevTools (Network → form data).']
                        ];
                        if (isset($msgs[$_GET['msg']])) {
                            echo "<div class='alert {$msgs[$_GET['msg']][0]}'>{$msgs[$_GET['msg']][1]}</div>";
                        }
                    }
                    ?>

                    <form action="acoes/salvar-ocorrencia.php" method="POST">
                        <div class="mb-3">
                            <label for="data" class="form-label">Data da Ocorrência</label>
                            <input type="date" name="data" id="data" class="form-control form-control-lg" value="<?= date('Y-m-d'); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição da Ocorrência</label>
                            <textarea name="descricao" id="descricao" class="form-control form-control-lg" rows="4" required autofocus></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="alunos-ocorrencia" class="form-label">Selecione os Alunos</label>
                            <select name="alunos[]" id="alunos-ocorrencia" class="selectpicker form-control" multiple data-live-search="true" title="Escolha os alunos..." required>
                                <?php
                                // Query única: traz aluno + dados da turma (ano e turma)
                                $sql = "
                                    SELECT a.id, a.nome, a.turma AS turma_id, t.ano, t.turma
                                    FROM alunos a
                                    LEFT JOIN turma t ON t.id = a.turma
                                    ORDER BY a.nome
                                ";
                                $resultado = mysqli_query($conn, $sql);

                                if ($resultado && mysqli_num_rows($resultado) > 0) {
                                    while ($row = mysqli_fetch_assoc($resultado)) {
                                        // proteger saída
                                        $aluno_id = intval($row['id']);
                                        $aluno_nome = htmlspecialchars($row['nome']);
                                        $ano = isset($row['ano']) ? htmlspecialchars($row['ano']) : '';
                                        $turma = isset($row['turma']) ? htmlspecialchars($row['turma']) : '';

                                        // Formato exibido: Ano/Turma - Nome (ex: 2024/A - João Silva)
                                        $labelTurma = ($ano !== '' || $turma !== '') ? trim("$ano$turma") : 'Turma não definida';

                                        echo "<option value=\"{$aluno_id}\">{$labelTurma} - {$aluno_nome}</option>";
                                    }
                                } else {
                                    echo "<option disabled>Nenhum aluno encontrado</option>";
                                }
                                ?>
                            </select>
                        </div>  

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-dark btn-lg">
                                <i class="bi bi-save2 me-1"></i> Salvar Ocorrência
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap-select -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof $ !== 'undefined' && typeof $.fn.selectpicker !== 'undefined') {
            $('.selectpicker').selectpicker();
        }
    });
</script>