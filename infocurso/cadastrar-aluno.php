<?php
require('includes/conexao.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/cadastro.css">
    <script src="assets/js/validacoes.js"></script>
    <link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css' />
    <script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'></script>
    <title>Cadastrar aluno</title>
</head>

<body>
    <!--menu-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php"><img src="assets/img/logo-cinza.png" width="130" height="30" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Início</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Turma
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="cadastrar-turma.php">Cadastrar turma</a>
                        <a class="dropdown-item" href="listar-turmas.php">Ver turmas</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Aluno
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="cadastrar-aluno.php">Cadastrar aluno</a>
                        <a class="dropdown-item" href="listar-alunos.php">Ver alunos</a>
                    </div>
                </li>

            </ul>
        </div>
    </nav>
    <!---------------------------------------------------------->
    <div class="container-fluid">



        <div class="row">
            <div class="offset-md-3 col-md-6 bloco-login">
                <h3>Cadastrar Aluno</h3>

                <?php

                if (isset($_GET['msg'])) {
                    $msg = $_GET['msg'];
                    if ($msg == 'sucesso') {
                        echo "
                            <div class='alert alert-success col-md-12'>
                                <strong>Salvo com sucesso!</strong>
                            </div>
                            ";
                    } else {
                        echo "
                            <div class='alert alert-danger col-md-12'>
                                <strong>Ops! Erro ao salvar!</strong>
                            </div>
                            ";
                    }
                }
                ?>


                <div class="alert alert-danger col-md-12" id="erro" hidden>

                </div>

                <form id="form-cadastro" onsubmit="return false" method="POST" action="acoes/salvar-aluno.php">

                    <div class="bloco-input">
                        <label class="form-label">Nome:</label>
                        <input type="text" class="form-control" name="nome" id="nome">
                    </div>
                    <div class="bloco-input">
                        <label class="form-label">RG:</label>
                        <input type="text" class="form-control" name="rg" id="rg">
                    </div>
                    <div class="bloco-input">
                        <label class="form-label">CPF:</label>
                        <input type="text" class="form-control" name="cpf" id="cpf">
                    </div>
                    <div class="bloco-input">
                        <label class="form-label">Endereço:</label>
                        <input type="text" class="form-control" name="endereco" id="endereco"
                            placeholder="Ex.: Rua Dom Manoel, N 251, Centro">
                    </div>
                    <div class="bloco-input">
                        <label class="form-label">Telefone:</label>
                        <input type="text" class="form-control" name="tel" id="tel" placeholder="Ex.: (00) 9.0000-0000">
                    </div>

                    <script type="text/javascript">
                        $("#tel, #celular").mask("(00) 00000-0000");
                        $('#cpf').mask("000.000.000-00");
                    </script>

                    <div class="bloco-input">
                        <label class="form-label">Escolaridade</label>
                        <select class="form-control" id="escolaridade" name="escolaridade">
                            <option value="">Selecione....</option>
                            <option value="fundamental_inc">Ensino fundamental incompleto</option>
                            <option value="fundamental">Ensino fundamental completo</option>
                            <option value="medio_inc">Ensino médio incompleto</option>
                            <option value="medio">Ensino médio completo</option>
                            <option value="superior_inc">Ensino superior incompleto</option>
                            <option value="superior">Ensino superior completo</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="bloco-input">
                                <label class="form-label">Turma</label>
                                <select class="form-control" id="turma" name="turma">
                                    <option value="">Selecione....</option>

                                    <?php
                                    $sql = "SELECT * FROM turma ORDER BY id ASC";
                                    $result = mysqli_query($conn, $sql);
                                    while ($dados = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <option value="<?php echo $dados['id']; ?>">
                                        <?php echo $dados['hora'] ?> -
                                        <?php echo $dados['dia1'] ?> -
                                        <?php echo $dados['dia2']; ?>
                                    </option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>

                        <div class="offset-md-1 col-md-10">
                            <button class="btn btn-dark col-md-12 btn-salvar" onclick="validarAluno();">Salvar</button>
                        </div>
                </form>

            </div>

        </div>
    </div>
    </div>
</body>

</html>