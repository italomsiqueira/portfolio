<?php
require('includes/protecao.php');
require('includes/conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<?php
$titulo = "Cadastrar Turma";
include('layout/head.php');
?>

<body>
    <?php include('layout/menu.php'); ?>

    <div class="container my-4">
        <div class="row justify-content-center">

            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-4">

                        <h4 class="mb-3 fw-bold text-primary">
                            <i class="bi bi-collection-fill me-2"></i>Cadastrar Turma
                        </h4>

                        <?php
                        if (isset($_GET['msg'])) {
                            echo ($_GET['msg'] == 'sucesso')
                                ? "<div class='alert alert-success rounded-3'>Salvo com sucesso!</div>"
                                : "<div class='alert alert-danger rounded-3'>Ops! Erro ao salvar!</div>";
                        }
                        ?>

                        <div class="alert alert-danger rounded-3" id="erro" hidden></div>

                        <form id="form-cadastro" method="POST" action="acoes/salvar-turma.php" onsubmit="return false">

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Ano</label>
                                <select class="form-select shadow-sm" id="ano" name="ano">
                                    <option value="">Selecione...</option>
                                    <?php for ($i = 1; $i <= 9; $i++) echo "<option value='$i'>$i</option>"; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Turma</label>
                                <select class="form-select shadow-sm" id="turma" name="turma">
                                    <option value="">Selecione...</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                </select>
                            </div>

                            <button class="btn btn-primary w-100 py-2 fw-bold shadow-sm"
                                onclick="validarTurma();">
                                <i class="bi bi-check-circle me-1"></i>Salvar
                            </button>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>
