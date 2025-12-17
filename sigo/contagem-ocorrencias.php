<?php
require('includes/protecao.php');
require('includes/conexao.php');

$titulo = "Quantidade de Ocorrências por Aluno";
$exportFilename = "Quantidade_de_Ocorrencias_por_Aluno";

/* =======================
   CAPTURA DE FILTROS
======================= */
$anoBusca = isset($_GET['ano']) ? intval($_GET['ano']) : 0;
$nomeBusca = isset($_GET['nomeBusca']) ? trim($_GET['nomeBusca']) : '';
$turmaBusca = isset($_GET['turmaBusca']) ? intval($_GET['turmaBusca']) : 0;

/* =======================
   ORDENAÇÃO SEGURA
======================= */
$ordenarPor = "total DESC";

if (isset($_GET['ordem'])) {
    switch ($_GET['ordem']) {
        case 'nome':
            $ordenarPor = "a.nome ASC";
            break;
        case 'turma':
            $ordenarPor = "t.ano ASC, t.turma ASC";
            break;
        case 'qtd':
            $ordenarPor = "total DESC";
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

        <h3 class="text-center mb-4">Quantidade de Ocorrências por Aluno</h3>

        <!-- FILTROS -->
        <form class="row g-3 mb-4" method="GET">

            <div class="col-md-5">
                <input type="text" class="form-control" name="nomeBusca" placeholder="Digite o nome do aluno..."
                    value="<?= htmlspecialchars($nomeBusca) ?>">
            </div>

            <div class="col-md-2">
                <select name="turmaBusca" class="selectpicker form-control" data-live-search="true">
                    <option value="">Todas as turmas</option>
                    <?php
                    $sqlTurmas = "SELECT id, ano, turma FROM turma ORDER BY ano ASC, turma ASC";
                    $resTurmas = mysqli_query($conn, $sqlTurmas);

                    while ($t = mysqli_fetch_assoc($resTurmas)) {
                        $selected = ($turmaBusca == $t['id']) ? 'selected' : '';
                        echo "<option value='{$t['id']}' $selected>{$t['ano']}º - {$t['turma']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-2">
                <select name="ordem" class="form-select" onchange="this.form.submit()">
                    <option value="qtd" <?= ($_GET['ordem'] ?? '') == 'qtd' ? 'selected' : '' ?>>Qtd. Ocorrências</option>
                    <option value="nome" <?= ($_GET['ordem'] ?? '') == 'nome' ? 'selected' : '' ?>>Nome</option>
                    <option value="turma" <?= ($_GET['ordem'] ?? '') == 'turma' ? 'selected' : '' ?>>Turma</option>
                </select>
            </div>

            <div class="col-md-1">
                <select name="ano" class="form-select">
                    <?php
                    $anoAtual = date('Y');
                    $anoInicial = 2024;

                    for ($i = $anoAtual; $i >= $anoInicial; $i--) {
                        $selected = ($anoBusca == $i) ? 'selected' : '';
                        echo "<option value='$i' $selected>$i</option>";
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

                    $joinOcorrencias = "
                                        LEFT JOIN ocorrencia_aluno oa 
                                            ON oa.alunos_id = a.id
                                        LEFT JOIN ocorrencia o 
                                            ON o.id = oa.ocorrencia_id
                                    ";


                    if ($anoBusca > 0) {
                        $joinOcorrencias .= " AND YEAR(o.data) = $anoBusca";
                    }

                    /* =======================
                       WHERE DINÂMICO
                    ======================= */
                    $where = [];


                    if ($nomeBusca !== '') {
                        $nomeBusca = mysqli_real_escape_string($conn, $nomeBusca);
                        $where[] = "a.nome LIKE '%$nomeBusca%'";
                    }

                    if ($turmaBusca > 0) {
                        $where[] = "a.turma = $turmaBusca";
                    }

                    $whereSql = $where ? "WHERE " . implode(" AND ", $where) : "";

                    /* =======================
                       QUERY PRINCIPAL
                    ======================= */
                    $sql = "
                            SELECT
                                a.id,
                                a.nome,
                                CONCAT(t.ano, 'º - ', t.turma) AS turma_nome,
                                COUNT(o.id) AS total
                            FROM alunos a
                            LEFT JOIN turma t ON t.id = a.turma
                            $joinOcorrencias
                            $whereSql
                            GROUP BY a.id, a.nome, t.ano, t.turma
                            ORDER BY $ordenarPor
                        ";


                    $result = mysqli_query($conn, $sql);

                    if (!$result) {
                        die("Erro SQL: " . mysqli_error($conn));
                    }

                    if (mysqli_num_rows($result) > 0) {
                        while ($d = mysqli_fetch_assoc($result)) {
                            echo "
        <tr>
            <td>{$d['id']}</td>
            <td>{$d['nome']}</td>
            <td>{$d['turma_nome']}</td>
            <td class='text-center'>{$d['total']}</td>
            <td class='text-center'>
                <a href='ver-ocorrencias-aluno.php?id={$d['id']}'
                   class='btn btn-dark btn-sm rounded-pill'>
                    Ver Detalhes
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

    </div>

    <!-- Bootstrap-select -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css">
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof $ !== 'undefined') {
                $('.selectpicker').selectpicker();
            }
        });

    </script>

</body>

</html>