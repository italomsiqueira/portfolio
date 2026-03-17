<?php
require('includes/protecao.php');
require('includes/conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">

<?php
$titulo = "Detalhes da Suspensão";
include('layout/head.php');
?>

<head>
    <style>
        @media print {

            @page {
                margin: 10mm;
            }

            body {
                font-size: 12px;
            }

            .print-header {
                display: flex;
                align-items: center;
                gap: 15px;
                margin-bottom: 20px;
                border-bottom: 1px solid #000;
                padding-bottom: 10px;
            }

            .print-header img {
                width: 80px;
            }

            .print-assinatura {
                margin-top: 40px;
                text-align: center;
                font-size: 15px;
            }

            .print-assinatura .linha {
                margin-top: 60px;
                border-top: 2px solid #000;
                width: 60%;
                margin-left: auto;
                margin-right: auto;
                padding-top: 5px;
            }

            .no-print {
                display: none !important;
            }

        }

        .print-only {
            display: none;
        }

        @media print {
            .print-only {
                display: block;
            }
        }
    </style>
</head>

<body>

    <?php include('layout/menu.php'); ?>

    <div class="container mt-4">

        <?php

        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo "<div class='alert alert-danger'>Suspensão não encontrada!</div>";
            exit;
        }

        $suspensao_id = intval($_GET['id']);

        $sql = "SELECT * FROM suspensoes WHERE id=$suspensao_id";
        $res = mysqli_query($conn, $sql);
        $susp = mysqli_fetch_assoc($res);

        if (!$susp) {
            echo "<div class='alert alert-danger'>Suspensão não encontrada!</div>";
            exit;
        }

        $data_inicio = date('d/m/Y', strtotime($susp['data_inicio']));
        $data_fim = date('d/m/Y', strtotime($susp['data_fim']));
        $motivo = nl2br($susp['motivo']);

        ?>

        <div class="card shadow-lg p-4">

            <div class="print-only">

                <div class="print-header">
                    <img src="assets/img/logo_escola.png">

                    <div>
                        <h5>E.E.F. PROFESSORA LAURA ALENCAR</h5>
                        <h6>Sistema Integrado de Gestão de Ocorrências</h6>
                    </div>

                </div>

            </div>

            <h3 class="text-center mb-4">
                <i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>
                Suspensão Nº <strong><?php echo $suspensao_id; ?></strong>
            </h3>

            <p><strong>Data de Início:</strong> <?php echo $data_inicio; ?></p>
            <p><strong>Data de Fim:</strong> <?php echo $data_fim; ?></p>

            <p><strong>Motivo:</strong><br><?php echo $motivo; ?></p>

            <hr>

            <h5>Alunos Suspensos:</h5>

            <table class="table table-bordered mt-3">

                <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th width="37%">Assinatura</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                    $sql_alunos = "
SELECT 
a.nome,
a.cpf,
t.ano,
t.turma

FROM suspensao_aluno sa
INNER JOIN alunos a ON a.id=sa.alunos_id
LEFT JOIN turma t ON t.id=a.turma

WHERE sa.suspensao_id=$suspensao_id

ORDER BY t.ano,t.turma,a.nome
";

                    $res_alunos = mysqli_query($conn, $sql_alunos);

                    if (mysqli_num_rows($res_alunos) > 0) {

                        while ($aluno = mysqli_fetch_assoc($res_alunos)) {

                            $turma = "";

                            if (!empty($aluno['ano']) || !empty($aluno['turma'])) {
                                $turma = "{$aluno['ano']}{$aluno['turma']} - ";
                            }

                            echo "

<tr>
<td>$turma {$aluno['nome']}</td>
<td>{$aluno['cpf']}</td>
<td></td>
</tr>

";

                        }

                    } else {

                        echo "<tr><td colspan='3' class='text-center'>Nenhum aluno vinculado.</td></tr>";

                    }

                    ?>

                </tbody>
            </table>

            <div class="text-center mt-4 no-print">

                <a href="listar-ocorrencias.php" class="btn btn-secondary">Voltar</a>

                <button class="btn btn-success" onclick="window.print()">Imprimir</button>

                <a href="editar-suspensao.php?id=<?php echo $suspensao_id; ?>" class="btn btn-warning">
                    Editar
                </a>

                <button class="btn btn-danger" onclick="confirmarExclusao(<?php echo $suspensao_id; ?>)">
                    Excluir
                </button>

            </div>

        </div>
    </div>

    <script>

        function confirmarExclusao(id) {

            if (confirm("Tem certeza que deseja excluir esta suspensão? Esta ação não pode ser desfeita.")) {
                window.location.href = "acoes/excluir-suspensao.php?id=" + id;
            }

        }

    </script>

    <style>
        @media print {

            body * {
                visibility: hidden;
            }

            .card,
            .card * {
                visibility: visible;
            }

            .card {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            .no-print {
                display: none !important;
            }

            .card,
            .shadow,
            .shadow-sm,
            .shadow-lg {
                box-shadow: none !important;
                border-radius: 0 !important;
            }

        }
    </style>

</body>

</html>