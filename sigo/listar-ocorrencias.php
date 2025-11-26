<?php
require('includes/protecao.php');
require('includes/conexao.php');

$titulo = "Lista de Ocorrências";
$exportFilename = "Lista_de_Ocorrencias";

// Captura filtros
$alunoFiltro = isset($_GET['aluno']) ? intval($_GET['aluno']) : '';
$dataInicio = isset($_GET['data_inicio']) ? $_GET['data_inicio'] : '';
$dataFim = isset($_GET['data_fim']) ? $_GET['data_fim'] : '';

// Monta a query com filtros
$where = [];
if ($alunoFiltro) {
    $where[] = "oa.alunos_id = $alunoFiltro";
}
if ($dataInicio) {
    $where[] = "o.data >= '$dataInicio'";
}
if ($dataFim) {
    $where[] = "o.data <= '$dataFim'";
}
$whereSql = $where ? "WHERE " . implode(" AND ", $where) : "";

$sql = "
    SELECT 
        o.id AS ocorrencia_id, 
        o.descricao, 
        o.data,
        GROUP_CONCAT(SUBSTRING_INDEX(a.nome, ' ', 1) SEPARATOR ', ') AS alunos
    FROM ocorrencia o
    LEFT JOIN ocorrencia_aluno oa ON oa.ocorrencia_id = o.id
    LEFT JOIN alunos a ON a.id = oa.alunos_id
    $whereSql
    GROUP BY o.id, o.descricao, o.data
    ORDER BY o.id DESC
";

$res = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<?php include('layout/head.php'); ?>

<body>
<?php include('layout/menu.php'); ?>
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4><i class="bi bi-journal-text me-2"></i>Lista de Ocorrências</h4>
        <a href="cadastrar-ocorrencia.php" class="btn btn-dark btn-lg">
            <i class="bi bi-plus-circle me-1"></i> Cadastrar Ocorrência 
        </a>
    </div>

    <!-- FILTROS -->
    <form class="row g-3 mb-4" method="GET">
        <div class="col-md-5">
            <select name="aluno" class="selectpicker form-control" data-live-search="true" title="Filtrar por aluno">
                <option value="">Todos os alunos</option>
                <?php
                $sqlAlunos = "SELECT id, nome FROM alunos ORDER BY nome";
                $resAlunos = mysqli_query($conn, $sqlAlunos);
                while ($al = mysqli_fetch_assoc($resAlunos)) {
                    $selected = ($alunoFiltro == $al['id']) ? 'selected' : '';
                    echo "<option value='{$al['id']}' $selected>{$al['nome']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-3">
            <input type="date" name="data_inicio" class="form-control" value="<?= $dataInicio ?>" placeholder="Data início">
        </div>
        <div class="col-md-3">
            <input type="date" name="data_fim" class="form-control" value="<?= $dataFim ?>" placeholder="Data fim">
        </div>
        <div class="col-md-1 d-grid">
            <button type="submit" class="btn btn-dark"><i class="bi bi-funnel-fill"></i></button>
        </div>
    </form>

    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-<?= $_GET['msg'] == 'sucesso' ? 'success' : 'danger' ?>">
            <strong><?= $_GET['msg'] == 'sucesso' ? 'Deletado com sucesso!' : 'Erro ao deletar!' ?></strong>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Data</th>
                    <th style="width: 40%;">Descrição</th>
                    <th>Alunos Envolvidos</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($res) > 0) {
                    while ($oc = mysqli_fetch_assoc($res)) {
                        $id = $oc['ocorrencia_id'];
                        $data = !empty($oc['data']) ? date('d/m/Y', strtotime($oc['data'])) : '-';
                        $descricao = htmlspecialchars($oc['descricao'] ?? '');
                        $alunos = htmlspecialchars($oc['alunos'] ?? 'Nenhum');
                        echo "
                            <tr>
                                <td>$id</td>
                                <td>$data</td>
                                <td>$descricao</td>
                                <td>$alunos</td>
                                <td class='text-center'>
                                    <a href='ver-ocorrencia.php?id=$id' class='btn btn-dark btn-sm rounded-pill me-2'>
                                        <i class='bi bi-eye-fill'></i> Ver
                                    </a>
                                    <a href='editar-ocorrencia.php?id=$id' class='btn btn-primary btn-sm rounded-pill me-2'>
                                        <i class='bi bi-pencil-fill'></i> Editar
                                    </a>
                                    <a href='acoes/deletar-ocorrencia.php?id=$id' onclick=\"return confirm('Deseja realmente excluir esta ocorrência?');\" class='btn btn-danger btn-sm rounded-pill'>
                                        <i class='bi bi-trash-fill'></i> Deletar
                                    </a>
                                </td>
                            </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Nenhuma ocorrência registrada.</td></tr>";
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

    // Export to Excel
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
