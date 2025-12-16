<?php
require('includes/protecao.php');
require('includes/conexao.php');

$titulo = "Ocorrências por Aluno";
$exportFilename = "Ocorrencias_por_Aluno";

/* =======================
   CAPTURA DE FILTROS
======================= */
$nomeBusca  = isset($_GET['nomeBusca']) ? strtoupper($_GET['nomeBusca']) : '';
$turmaBusca = isset($_GET['turmaBusca']) ? intval($_GET['turmaBusca']) : '';

/* =======================
   ORDENAÇÃO SEGURA
======================= */
$ordenarPor = 'a.nome'; // padrão

if (isset($_GET['ordem'])) {
    switch ($_GET['ordem']) {
        case 'nome':
            $ordenarPor = 'a.nome';
            break;
        case 'turma':
            $ordenarPor = 'a.turma';
            break;
        case 'qtd':
            $ordenarPor = 'total DESC';
            break;
    }
}
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
            <input type="text" class="form-control" name="nomeBusca"
                   placeholder="Digite o nome do aluno..."
                   value="<?= htmlspecialchars($nomeBusca) ?>">
        </div>

        <div class="col-md-2">
            <select name="turmaBusca" class="selectpicker form-control" data-live-search="true">
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

        <div class="col-md-2">
            <select name="ordem" class="form-select" onchange="this.form.submit()">
                <option value="nome" <?= ($_GET['ordem'] ?? '') == 'nome' ? 'selected' : '' ?>>Ordenar por Nome</option>
                <option value="turma" <?= ($_GET['ordem'] ?? '') == 'turma' ? 'selected' : '' ?>>Ordenar por Turma</option>
                <option value="qtd"   <?= ($_GET['ordem'] ?? '') == 'qtd'   ? 'selected' : '' ?>>Ordenar por Qtd. Ocorrências</option>
            </select>
        </div>

        <div class="col-md-1 d-grid">
            <button type="submit" class="btn btn-dark">
                <i class="bi bi-funnel-fill"></i>
            </button>
        </div>

        <div class="col-md-1 d-grid">
            <a href="<?= basename($_SERVER['PHP_SELF']); ?>" class="btn btn-danger">Limpar</a>
        </div>

    </form>

    <!-- TABELA -->
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
            /* =======================
               FILTROS SQL
            ======================= */
            $filtros = [];

            if (!empty($nomeBusca)) {
                $filtros[] = "UPPER(a.nome) LIKE '%$nomeBusca%'";
            }

            if (!empty($turmaBusca)) {
                $filtros[] = "a.turma = '$turmaBusca'";
            }

            $where = $filtros ? "WHERE " . implode(" AND ", $filtros) : "";

            /* =======================
               QUERY PRINCIPAL
            ======================= */
            $sql = "
                SELECT 
                    a.id,
                    a.nome,
                    a.turma,
                    COUNT(oa.ocorrencia_id) AS total,
                    CONCAT(t.ano, '-', t.turma) AS turma_nome
                FROM alunos a
                LEFT JOIN ocorrencia_aluno oa ON a.id = oa.alunos_id
                LEFT JOIN turma t ON t.id = a.turma
                $where
                GROUP BY a.id, a.nome, a.turma, t.ano, t.turma
                ORDER BY $ordenarPor
            ";

            $result = mysqli_query($conn, $sql);

            if (!$result) {
                die(mysqli_error($conn));
            }

            if (mysqli_num_rows($result) > 0) {
                while ($dados = mysqli_fetch_assoc($result)) {
                    echo "
                    <tr>
                        <td>{$dados['id']}</td>
                        <td>{$dados['nome']}</td>
                        <td>" . ($dados['turma_nome'] ?? 'NÃO CADASTRADA') . "</td>
                        <td class='text-center'>{$dados['total']}</td>
                        <td class='text-center'>
                            <a href='ver-ocorrencias-aluno.php?id={$dados['id']}' class='btn btn-dark btn-sm rounded-pill'>
                                <i class='bi bi-eye-fill'></i> Ver Detalhes
                            </a>
                        </td>
                    </tr>";
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
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    if (typeof $ !== 'undefined' && typeof $.fn.selectpicker !== 'undefined') {
        $('.selectpicker').selectpicker();
    }

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
