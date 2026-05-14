<?php
require('includes/protecao.php');
require('includes/conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">

<?php
$titulo = "Aviso de Suspensão";
include('layout/head.php');
?>

<head>

    <style>
        body {
            background: #f5f5f5;
        }

        .aviso {
            background: #fff;
            padding: 50px;
            margin-bottom: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .print-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo {
            width: 400px;
            margin-bottom: 10px;
        }

        .texto-escola {
            font-size: 14px;
            line-height: 1.5;
        }

        .titulo-documento {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin: 40px 0;
        }

        .texto-justificado {
            text-align: justify;
            line-height: 2;
            font-size: 15px;
        }

        .assinatura {
            margin-top: 100px;
            text-align: center;
        }

        .linha-assinatura {
            border-top: 1px solid #000;
            width: 300px;
            margin: 70px auto 10px;
        }

        .no-print {
            text-align: center;
            margin: 30px 0;
        }

        @media print {

            @page {
                margin: 20mm;
            }

            body {
                background: #fff;
                font-family: "Times New Roman", serif;
                font-size: 14pt;
            }

            .no-print,
            .menu,
            nav,
            footer {
                display: none !important;
            }

            .aviso {
                box-shadow: none;
                margin: 0;
                padding: 0;
                page-break-after: always;
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

        $sql_alunos = "
SELECT 

a.nome,
a.cpf,
a.data_nascimento,
a.responsavel,

t.ano,
t.turma

FROM suspensao_aluno sa

INNER JOIN alunos a 
ON a.id = sa.alunos_id

LEFT JOIN turma t 
ON t.id = a.turma

WHERE sa.suspensao_id = $suspensao_id

ORDER BY t.ano, t.turma, a.nome
";

        $res_alunos = mysqli_query($conn, $sql_alunos);

        if (mysqli_num_rows($res_alunos) > 0) {

            while ($aluno = mysqli_fetch_assoc($res_alunos)) {

                $nome_aluno = $aluno['nome'];

                $responsavel = !empty($aluno['responsavel'])
                    ? $aluno['responsavel']
                    : "Responsável";

                $data_nascimento = !empty($aluno['data_nascimento'])
                    ? date('d/m/Y', strtotime($aluno['data_nascimento']))
                    : "____/____/________";

                $turma = "{$aluno['ano']}º ano - Turma {$aluno['turma']}";

                $dias = 1;

                $inicio = new DateTime($susp['data_inicio']);
                $fim = new DateTime($susp['data_fim']);

                $intervalo = $inicio->diff($fim);

                $dias = $intervalo->days + 1;

                ?>

                <div class="aviso">

                    <div class="print-header">

                        <img src="assets/img/logo_seduc.png" class="logo">

                        <div class="texto-escola">

                            <strong>
                                ESCOLA DE ENSINO FUNDAMENTAL PROFESSORA LAURA ALENCAR
                            </strong>
                            <br>

                            RUA CASEMIRO FIÚZA BENEVIDES S/N – MOMBAÇA-CE
                            <br>

                            INEP 23116501

                        </div>

                    </div>

                    <div class="titulo-documento">
                        AVISO DE SUSPENSÃO
                    </div>

                    <p class="texto-justificado">

                        Prezado(a) Senhor(a):
                        <strong><?php echo $responsavel; ?></strong>

                    </p>

                    <p class="texto-justificado">

                        Vimos por meio deste informar que o(a) aluno(a)

                        <strong><?php echo $nome_aluno; ?></strong>,

                        nascido(a) no dia

                        <strong><?php echo $data_nascimento; ?></strong>,

                        matriculado(a) no

                        <strong><?php echo $turma; ?></strong>,

                        do ensino fundamental, foi suspenso(a) pelo prazo de

                        <strong><?php echo $dias; ?> dia(s)</strong>,

                        contados a partir do dia

                        <strong><?php echo $data_inicio; ?></strong>,

                        em razão de:

                        <strong><?php echo strip_tags($motivo); ?></strong>

                    </p>


                    <br><br>

                    <p class="texto-justificado">

                        Mombaça, <?php echo date('d/m/Y'); ?>

                    </p>

                    <div class="assinatura">

                        Atenciosamente:

                        <div class="linha-assinatura"></div>

                        Núcleo Gestor

                    </div>

                </div>

                <?php

            }

        } else {

            echo "<div class='alert alert-warning'>Nenhum aluno vinculado.</div>";

        }

        ?>

        <div class="no-print">

            <a href="listar-ocorrencias.php" class="btn btn-secondary">
                Voltar
            </a>

            <button class="btn btn-success" onclick="window.print()">
                Imprimir
            </button>

            <a href="editar-suspensao.php?id=<?php echo $suspensao_id; ?>" class="btn btn-warning">
                Editar
            </a>

            <button class="btn btn-danger" onclick="confirmarExclusao(<?php echo $suspensao_id; ?>)">
                Excluir
            </button>

        </div>

    </div>

    <script>

        function confirmarExclusao(id) {

            if (confirm("Tem certeza que deseja excluir esta suspensão?")) {

                window.location.href =
                    "acoes/excluir-suspensao.php?id=" + id;

            }

        }

    </script>
</body>

</html>