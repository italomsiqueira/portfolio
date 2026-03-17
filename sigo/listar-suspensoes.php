<?php
require('includes/protecao.php');
require('includes/conexao.php');

$titulo = "Lista de Suspensões";
$exportFilename = "Lista_de_Suspensoes";

// Captura filtros
$alunoFiltro = isset($_GET['aluno']) ? intval($_GET['aluno']) : '';
$dataInicio = isset($_GET['data_inicio']) ? $_GET['data_inicio'] : '';
$dataFim = isset($_GET['data_fim']) ? $_GET['data_fim'] : '';

// Monta a query com filtros
$where = [];

if ($alunoFiltro) {
    $where[] = "sa.alunos_id = $alunoFiltro";
}

if ($dataInicio) {
    $where[] = "s.data_inicio >= '$dataInicio'";
}

if ($dataFim) {
    $where[] = "s.data_fim <= '$dataFim'";
}

$whereSql = $where ? "WHERE " . implode(" AND ", $where) : "";

$sql = "
    SELECT 
        s.id AS suspensao_id,
        s.data_inicio,
        s.data_fim,
        s.motivo,
        GROUP_CONCAT(SUBSTRING_INDEX(a.nome,' ',1) SEPARATOR ', ') AS alunos
    FROM suspensoes s
    LEFT JOIN suspensao_aluno sa ON sa.suspensao_id = s.id
    LEFT JOIN alunos a ON a.id = sa.alunos_id
    $whereSql
    GROUP BY s.id, s.data_inicio, s.data_fim, s.motivo
    ORDER BY s.id DESC
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
            <h4>
                <i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>
                Lista de Suspensões
            </h4>

            <a href="cadastrar-suspensao.php" class="btn btn-danger btn-lg">
                <i class="bi bi-plus-circle me-1"></i> Cadastrar Suspensão
            </a>
        </div>

        <!-- FILTROS -->
        <form class="row g-3 mb-4" method="GET">

            <div class="col-md-5">
                <select name="aluno" class="selectpicker form-control" data-live-search="true"
                    title="Filtrar por aluno">
                    <option value="">Todos os alunos</option>

                    <?php
                    $sqlAlunos = "SELECT id,nome FROM alunos ORDER BY nome";
                    $resAlunos = mysqli_query($conn, $sqlAlunos);

                    while ($al = mysqli_fetch_assoc($resAlunos)) {

                        $selected = ($alunoFiltro == $al['id']) ? 'selected' : '';

                        echo "<option value='{$al['id']}' $selected>{$al['nome']}</option>";
                    }
                    ?>

                </select>
            </div>

            <div class="col-md-3">
                <input type="date" name="data_inicio" class="form-control" value="<?= $dataInicio ?>"
                    placeholder="Data início">
            </div>

            <div class="col-md-3">
                <input type="date" name="data_fim" class="form-control" value="<?= $dataFim ?>" placeholder="Data fim">
            </div>

            <div class="col-md-1 d-grid">
                <button type="submit" class="btn btn-dark">
                    <i class="bi bi-funnel-fill"></i>
                </button>
            </div>

        </form>

        <?php if (isset($_GET['msg'])): ?>

            <div class="alert alert-<?= $_GET['msg'] == 'sucesso' ? 'success' : 'danger' ?>">
                <strong>
                    <?= $_GET['msg'] == 'sucesso' ? 'Deletado com sucesso!' : 'Erro ao deletar!' ?>
                </strong>
            </div>

        <?php endif; ?>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>ID</th>
                        <th>Início</th>
                        <th>Fim</th>
                        <th style="width:35%">Motivo</th>
                        <th>Alunos Suspensos</th>
                        <th class="text-center">Ações</th>

                    </tr>

                </thead>

                <tbody>

                    <?php

                    if (mysqli_num_rows($res) > 0) {

                        while ($s = mysqli_fetch_assoc($res)) {

                            $id = $s['suspensao_id'];

                            $inicio = !empty($s['data_inicio']) ? date('d/m/Y', strtotime($s['data_inicio'])) : '-';

                            $fim = !empty($s['data_fim']) ? date('d/m/Y', strtotime($s['data_fim'])) : '-';

                            $motivo = htmlspecialchars($s['motivo'] ?? '');

                            $alunos = htmlspecialchars($s['alunos'] ?? 'Nenhum');

                            echo "

<tr>

<td>$id</td>

<td>$inicio</td>

<td>$fim</td>

<td>$motivo</td>

<td>$alunos</td>

<td class='text-center'>

<a href='ver-suspensao.php?id=$id'
class='btn btn-dark btn-sm rounded-pill me-2'>

<i class='bi bi-eye-fill'></i> Ver

</a>

<a href='editar-suspensao.php?id=$id'
class='btn btn-primary btn-sm rounded-pill me-2'>

<i class='bi bi-pencil-fill'></i> Editar

</a>

<a href='acoes/excluir-suspensao.php?id=$id'
onclick=\"return confirm('Deseja realmente excluir esta suspensão?');\"

class='btn btn-danger btn-sm rounded-pill'>

<i class='bi bi-trash-fill'></i> Deletar

</a>

</td>

</tr>

";

                        }

                    } else {

                        echo "<tr><td colspan='6' class='text-center'>Nenhuma suspensão registrada.</td></tr>";

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
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css">

    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            if (typeof $ !== 'undefined' && typeof $.fn.selectpicker !== 'undefined') {
                $('.selectpicker').selectpicker();
            }

            // Exportar Excel
            document.getElementById('btnExport').addEventListener('click', function () {

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