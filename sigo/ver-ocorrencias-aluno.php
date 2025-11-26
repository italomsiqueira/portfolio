<?php
require('includes/protecao.php');
require('includes/conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<?php
$titulo = "Ocorrências do Aluno";
include('layout/head.php');
?>

<head>
    <style>
        /* ----------- ESTILOS DE IMPRESSÃO ----------- */
        .print-only {
            display: none !important;
        }

        @media print {

            @page {
                margin: 15mm;
            }

            .print-only {
                display: block !important;
            }

            /* Cabeçalho da escola */
            .print-header {
                text-align: center;
                margin-bottom: 20px;
                border-bottom: 2px solid #000;
                padding-bottom: 10px;
            }

            .print-header img {
                width: 90px;
                display: block;
                margin: 0 auto 5px auto;
            }

            .print-header h2 {
                margin: 0;
                font-size: 20px;
            }

            .print-header h4 {
                margin: 0;
                font-size: 15px;
            }

            /* Esconder itens que NÃO imprimem */
            .no-print {
                display: none !important;
            }

            /* Melhorar a tabela para impressão */
            table {
                width: 100%;
                border-collapse: collapse;
                font-size: 14px;
            }

            th,
            td {
                border: 1px solid #000;
                padding: 6px;
                text-align: left;
            }

            th {
                background: #eee !important;
            }

            body {
                background: white !important;
            }
        }
    </style>
</head>

<body>

    <?php include('layout/menu.php'); ?>

    <div class="container mt-4">

        <?php
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo "<div class='alert alert-danger'>Aluno não encontrado!</div>";
            exit;
        }

        $aluno_id = intval($_GET['id']);

        // Dados do aluno
        $sql_aluno = "
            SELECT a.nome, t.ano, t.turma 
            FROM alunos a 
            LEFT JOIN turma t ON a.turma = t.id 
            WHERE a.id = '$aluno_id'
        ";
        $res_aluno = mysqli_query($conn, $sql_aluno);
        $dados_aluno = mysqli_fetch_assoc($res_aluno);

        if (!$dados_aluno) {
            echo "<div class='alert alert-danger'>Aluno não encontrado no banco de dados!</div>";
            exit;
        }

        $nome_aluno = $dados_aluno['nome'];
        $turma_aluno = $dados_aluno['ano'] . '-' . $dados_aluno['turma'];
        ?>

        <!-- CABEÇALHO APENAS NA IMPRESSÃO -->
        <div class="print-header print-only">
            <img src="assets/img/logo_escola.png" alt="Logo da Escola">
            <h2>E.E.F. PROFESSORA LAURA ALENCAR</h2>
            <h4>Sistema Integrado de Gestão de Ocorrências</h4>
        </div>

        <!-- TÍTULO -->
        <h3 class="text-center mb-4">
            Ocorrências de <b><?php echo $nome_aluno; ?></b>
            (<?php echo $turma_aluno; ?>)
        </h3>

        <!-- TABELA DE OCORRÊNCIAS -->
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Data</th>
                    <th>Descrição</th>
                    <th class="no-print">Ações</th>
                </tr>
            </thead>


            <tbody>
                <?php
                $sql = "
                    SELECT o.id, o.descricao, o.data
                    FROM ocorrencia o
                    INNER JOIN ocorrencia_aluno oa ON oa.ocorrencia_id = o.id
                    WHERE oa.alunos_id = '$aluno_id'
                    ORDER BY o.data DESC
                ";
                $res = mysqli_query($conn, $sql);

                if (mysqli_num_rows($res) > 0) {
                    while ($oc = mysqli_fetch_assoc($res)) {
                        $id = $oc['id'];
                        $descricao = $oc['descricao'];
                        $data = date('d/m/Y', strtotime($oc['data']));

                        echo "
                        <tr>
                            <td>$id</td>
                            <td>$data</td>
                            <td>$descricao</td>

                            <td class='no-print'>
                                <a href='ver-ocorrencia.php?id=$id'>
                                    <button class='btn btn-sm btn-info'>Ver</button>
                                </a>
                            </td>
                        </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>Nenhuma ocorrência registrada para este aluno.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- BOTÕES (SOMENTE NA TELA) -->
        <div class="text-center mt-4 no-print">
            <a href="listar-ocorrencias.php" class="btn btn-dark">Voltar à lista</a>
            <button onclick="window.print()" class="btn btn-success">Imprimir</button>
        </div>

    </div>
</body>

</html>