<?php
require('includes/protecao.php');
require('includes/conexao.php');

$id = $_GET['id'];
$sql = "SELECT * FROM turma WHERE id = $id";
$res = mysqli_query($conn, $sql);
$dados = mysqli_fetch_assoc($res);

$ano = $dados['ano'];
$turma = $dados['turma'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<?php
$titulo = "Editar Turma";
include('layout/head.php');
?>

<body>

    <?php include('layout/menu.php'); ?>

    <div class="container my-4">
        <div class="row justify-content-center">

            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-4">

                        <h4 class="mb-3 fw-bold text-warning">
                            <i class="bi bi-pencil-square me-2"></i>
                            Editar Turma: <?= $ano . "-" . $turma ?>
                        </h4>

                        <?php
                        if (isset($_GET['msg'])) {
                            echo ($_GET['msg'] == 'sucesso')
                                ? "<div class='alert alert-success rounded-3'>Alterado com sucesso!</div>"
                                : "<div class='alert alert-danger rounded-3'>Ops! Erro ao salvar!</div>";
                        }
                        ?>

                        <div class="alert alert-danger rounded-3" id="erro" hidden></div>

                        <form id="form-cadastro" method="POST" action="acoes/editar-turma.php" onsubmit="return false">
                            <input type="hidden" name="id" value="<?= $id ?>">

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Ano</label>
                                <select class="form-select shadow-sm" id="ano" name="ano">
                                    <option value="">Selecione...</option>
                                    <?php
                                    for ($i = 1; $i <= 9; $i++) {
                                        $sel = ($ano == $i) ? "selected" : "";
                                        echo "<option value='$i' $sel>$i</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Turma</label>
                                <select class="form-select shadow-sm" id="turma" name="turma">
                                    <option value="">Selecione...</option>
                                    <option value="A" <?= ($turma == 'A') ? 'selected' : '' ?>>A</option>
                                    <option value="B" <?= ($turma == 'B') ? 'selected' : '' ?>>B</option>
                                </select>
                            </div>

                            <button class="btn btn-warning w-100 py-2 fw-bold shadow-sm"
                                onclick="validarTurma();">
                                <i class="bi bi-save me-1"></i>Salvar alterações
                            </button>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>
