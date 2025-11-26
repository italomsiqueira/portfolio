<?php
require('includes/protecao.php');
require('includes/conexao.php');

$titulo = "Ocorrências por Aluno";
$exportFilename = "Ocorrencias_por_Aluno";

// Captura filtros
$nomeBusca = isset($_GET['nomeBusca']) ? strtoupper($_GET['nomeBusca']) : '';
$turmaBusca = isset($_GET['turmaBusca']) ? intval($_GET['turmaBusca']) : '';
?>

<!DOCTYPE html>
<html lang="pt-br">
<?php include('layout/head.php'); ?>

<body>
<?php include('layout/menu.php'); ?>

<div class="container mt-4">
    <h3 class="text-center mb-4">Ocorrências por Aluno</h3>

    <!-- FILTROS -->
    <form class="row g-3 mb-4" method="GET">
        <div class="col-md-6">
            <input type="text" class="form-control" name="nomeBusca" id="nomeBusca"
                   placeholder="Digite o nome do aluno..."
                   value="<?= htmlspecialchars($nomeBusca) ?>">
        </div>

        <div class="col-md-4">
            <select name="turmaBusca" class="selectpicker form-control" data-live-search="true" title="Filtrar por turma">
                <option value="">Todas as turmas</option>
                <?php
                $turmas_sql = "SELECT id, ano, turma FROM turma ORDER BY ano, turma";
                $turmas_res = mysqli_query($conn, $turmas_sql);
                while ($t = mysqli_fetch_assoc($turmas_res)) {
                    $selected = ($turmaBusca == $t['id']) ? 'selected' : '';
                    echo "<option value='{$t['id']}' $selected>{$t['ano']}-{$t['turma']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="col-md-1 d-grid">
            <button type="submit" class="btn btn-dark"><i class="bi bi-funnel-fill"></i></button>
        </div>
        <div class="col-md-1 d-grid">
            <a href="<?= basename($_SERVER['PHP_SELF']); ?>" class="btn btn-danger">Limpar</a>
        </div>
    </form>

    <!-- Mensagem de sucesso/erro -->
    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-<?= $_GET['msg'] == 'sucesso' ? 'success' : 'danger' ?>">
            <strong>
                <?= $_GET['msg'] == 'sucesso' ? 'Ocorrência removida com sucesso!' : 'Erro ao processar a solicitação!' ?>
            </strong>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Turma</th>
                    <th class="text-center">Qtd. Ocorrências</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Filtros dinâmicos
                $filtros = [];
                if (!empty($nomeBusca)) $filtros[] = "UPPER(a.nome) LIKE '%$nomeBusca%'";
                if (!empty($turmaBusca)) $filtros[] = "a.turma = '$turmaBusca'";
                $where = $filtros ? "WHERE " . implode(" AND ", $filtros) : "";

                $sql = "
                    SELECT a.id, a.nome, a.turma, COUNT(oa.ocorrencia_id) AS total
                    FROM alunos a
                    LEFT JOIN ocorrencia_aluno oa ON a.id = oa.alunos_id
                    $where
                    GROUP BY a.id, a.nome, a.turma
                    ORDER BY a.nome ASC
                ";

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($dados = mysqli_fetch_assoc($result)) {
                        $id = $dados['id'];
                        $nome = $dados['nome'];
                        $turma_id = $dados['turma'];
                        $total = $dados['total'];

                        $turma_sql = "SELECT ano, turma FROM turma WHERE id = '$turma_id'";
                        $res_turma = mysqli_query($conn, $turma_sql);
                        $turma_dados = mysqli_fetch_assoc($res_turma);
                        $turma_nome = $turma_dados ? $turma_dados['ano'] . '-' . $turma_dados['turma'] : 'NÃO CADASTRADA';

                        echo "
                            <tr>
                                <td>$id</td>
                                <td>$nome</td>
                                <td>$turma_nome</td>
                                <td class='text-center'>$total</td>
                                <td class='text-center'>
                                    <a href='ver-ocorrencias-aluno.php?id=$id' class='btn btn-dark btn-sm rounded-pill'>
                                        <i class='bi bi-eye-fill'></i> Ver Detalhes
                                    </a>
                                </td>
                            </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Nenhum aluno encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="text-center mt-4">
        <button id="btnExport" class="btn btn-success btn-lg px-5">
            <i class="bi bi-file-earmark-excel"></i> Exportar para Excel
        </button>
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

    // Exportar tabela para Excel
    document.getElementById('btnExport').addEventListener('click', function() {
        let table = document.querySelector('table');
        let html = table.outerHTML;
        let url = 'data:application/vnd.ms-excel,' + encodeURIComponent(html);
        let a = document.createElement('a');
        a.href = url;
        a.download = '<?= $exportFilename ?>.xls';
        a.click();
    });
});
</script>

</body>
</html>
