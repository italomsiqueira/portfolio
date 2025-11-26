<?php
require('includes/protecao.php');
require('includes/conexao.php');

$titulo = "Lista de Turmas";
include('layout/head.php');
include('layout/menu.php');

$sql = "
    SELECT t.*, 
           COUNT(a.id) AS total_alunos
    FROM turma t
    LEFT JOIN alunos a ON a.turma = t.id
    GROUP BY t.id
    ORDER BY t.ano ASC, t.turma ASC
";

?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4><i class="bi bi-journal-text me-2"></i>Turmas Cadastradas</h4>
        <a href="cadastrar-turma.php" class="btn btn-dark btn-lg">
            <i class="bi bi-plus-circle me-1"></i> Cadastrar Turma
        </a>
    </div>

    <?php if(isset($_GET['msg'])): ?>
        <?php
        $alert = '';
        $msg = $_GET['msg'];
        if($msg == 'sucesso') $alert = 'Deletado com sucesso!';
        elseif($msg == 'erro') $alert = 'Ops! Erro ao deletar!';
        elseif($msg == 'editarReserva') $alert = 'Ops! Erro, não é permitido editar cadastro reserva!';
        elseif($msg == 'deletarReserva') $alert = 'Ops! Erro, não é permitido deletar cadastro reserva!';
        elseif($msg == 'editar') $alert = 'Editado com sucesso!';
        elseif($msg == 'erroEditar') $alert = 'Ops! Erro ao editar!';
        ?>
        <div class="alert alert-<?= in_array($msg,['sucesso','editar']) ? 'success' : 'danger' ?>">
            <strong><?= $alert ?></strong>
        </div>
    <?php endif; ?>

    <div class="card shadow-lg border-0">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Ano</th>
                            <th>Turma</th>
                            <th>Qtd de alunos</th>
                            <th style="width: 160px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = mysqli_query($conn, $sql);
                        while($turma = mysqli_fetch_assoc($result)):
                            $id = $turma['id'];
                            $ano = $turma['ano'];
                            $nomeTurma = $turma['turma'];

                            $urlEditar = "editar-turma.php?id=$id";
                            $urlDeletar = "acoes/deletar-turma.php?id=$id";
                            $urlVer = "turma.php?id=$id&ano=$ano&turma=$nomeTurma";
                        ?>
                        <tr>
                            <td><?= $id ?></td>
                            <td><?= $ano ?></td>
                            <td><?= $nomeTurma ?></td>
                            <td><?= $turma['total_alunos'] ?></td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?= $urlEditar ?>" class="btn btn-primary btn-sm rounded-circle p-2" title="Editar">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <a href="<?= $urlDeletar ?>" 
                                       onclick="return confirm('Deseja realmente deletar esta turma?');"
                                       class="btn btn-danger btn-sm rounded-circle p-2" title="Deletar">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                    <a href="<?= $urlVer ?>" class="btn btn-success btn-sm rounded-circle p-2" title="Ver Alunos">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-4">
                <button id="btnExport" class="btn btn-success btn-lg px-5">
                    <i class="bi bi-file-earmark-excel"></i> Exportar para Excel
                </button>
            </div>

        </div>
    </div>

</div>
