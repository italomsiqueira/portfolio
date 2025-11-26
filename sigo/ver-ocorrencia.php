<?php
require('includes/protecao.php');
require('includes/conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">

<?php
$titulo = "Detalhes da Ocorrência";
include('layout/head.php');
?>

<head>
    <style>
        /* Esconde os itens da tela e mostra apenas na impressão */
        @media print {

            /* Zera margens da impressão */
            @page {
                margin: 20mm;
            }

            /* Cabeçalho da escola */
            .print-header {
                display: flex;
                align-items: center;
                gap: 15px;
                margin-bottom: 20px;
                border-bottom: 2px solid #000;
                padding-bottom: 10px;
            }

            .print-header img {
                width: 80px;
                /* logo */
            }

            .print-header h1,
            .print-header h2 {
                margin: 0;
                padding: 0;
            }

            /* Campo de assinatura */
            .print-assinatura {
                margin-top: 40px;
                text-align: center;
                font-size: 18px;
            }

            .print-assinatura .linha {
                margin-top: 60px;
                border-top: 2px solid #000;
                width: 60%;
                margin-left: auto;
                margin-right: auto;
                padding-top: 5px;
            }

            /* Elementos que NÃO devem aparecer na impressão */
            .no-print {
                display: none !important;
            }
        }

        /* Elementos apenas na impressão ficam escondidos na tela */
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
    <p></p>
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4></h4>
            <a href="cadastrar-ocorrencia.php" class="btn btn-outline-primary">
                <i class="bi bi-plus-circle me-1"></i> Cadastrar ocorrência
            </a>
        </div>

        <?php
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo "<div class='alert alert-danger'>Ocorrência não encontrada!</div>";
            exit;
        }

        $ocorrencia_id = intval($_GET['id']);

        // Busca dados da ocorrência
        $sql = "SELECT * FROM ocorrencia WHERE id = $ocorrencia_id";
        $res = mysqli_query($conn, $sql);
        $oc = mysqli_fetch_assoc($res);

        if (!$oc) {
            echo "<div class='alert alert-danger'>Ocorrência não encontrada!</div>";
            exit;
        }

        $data = date('d/m/Y', strtotime($oc['data']));
        $descricao = nl2br($oc['descricao']);
        ?>

        <div class="card shadow-lg p-4">
            <div class="print-only">

                <div class="print-header" class="align-items-center">
                    <img src="assets/img/logo_escola.png" alt="Logo da Escola">

                    <div>
                        <h5>E.E.F. PROFESSORA LAURA ALENCAR</h5>
                        <h6>Sistema Integrado de Gestão de Ocorrências</h6>
                    </div>
                </div>

            </div>

            <h3 class="text-center mb-4">Ocorrência Nº <strong><?php echo $ocorrencia_id; ?></strong></h3>

            <?php
            if (isset($_GET['msg'])) {
                $msg = $_GET['msg'];
                if ($msg == 'sucesso') {
                    echo "
                            <div class='alert alert-success col-md-12'>
                                <strong>Editado com sucesso!</strong>
                            </div>
                            ";
                } else {
                    echo "
                            <div class='alert alert-danger col-md-12'>
                                <strong>Ops! Erro ao editar!</strong>
                            </div>
                            ";
                }
            }
            ?>

            <p><strong>Data da Ocorrência:</strong> <?php echo $data; ?></p>
            <p><strong>Descrição:</strong><br><?php echo $descricao; ?></p>

            <hr>
            <h5>Alunos Envolvidos:</h5>

            <table class="table table-bordered mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th width=37%>Assinatura</th>
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
                        FROM ocorrencia_aluno oa
                        INNER JOIN alunos a ON a.id = oa.alunos_id
                        LEFT JOIN turma t ON t.id = a.turma
                        WHERE oa.ocorrencia_id = $ocorrencia_id
                        ORDER BY t.ano, t.turma, a.nome
                    ";
                    $res_alunos = mysqli_query($conn, $sql_alunos);

                    if (mysqli_num_rows($res_alunos) > 0) {
                        while ($aluno = mysqli_fetch_assoc($res_alunos)) {

                            // Monta texto da turma
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
                <a href="editar-ocorrencia.php?id=<?php echo $ocorrencia_id; ?>" class="btn btn-warning">Editar</a>
                <button class="btn btn-danger" onclick="confirmarExclusao(<?php echo $ocorrencia_id; ?>)">Excluir</button>
            </div>
        </div>
    </div>

    <script>
        function confirmarExclusao(id) {
            if (confirm("Tem certeza que deseja excluir esta ocorrência? Esta ação não pode ser desfeita.")) {
                window.location.href = "acoes/excluir-ocorrencia.php?id=" + id;
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
        }
    </style>

</body>

</html>