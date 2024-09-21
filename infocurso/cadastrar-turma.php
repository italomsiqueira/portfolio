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
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'></script>
    <title>Cadastrar turma</title>
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
                <li class="nav-item active">
                    <a class="nav-link sair" href="login.php">Sair</a>
                </li>

            </ul>
        </div>
    </nav>
    <!---------------------------------------------------------->
    <div class="container-fluid">



        <div class="row">
            <div class="offset-md-3 col-md-6 bloco-login">
                <h3>Cadastrar Turma</h3>

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

                <form id="form-cadastro" onsubmit="return false" method="POST" action="acoes/salvar-turma.php">
                    <p>* A duração de cada aula é de 1 hora.</p>

                    <div class="bloco-input">
                        <label class="form-label">Horário:</label>
                        <input type="time" class="form-control" name="hora" id="hora">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="bloco-input">
                                <label class="form-label">Dia 1</label>
                                <select class="form-control" id="dia1" name="dia1">
                                    <option value="">Selecione....</option>
                                    <option value="SEG">Segunda-feira</option>
                                    <option value="TER">Terça-feira</option>
                                    <option value="QUA">Quarta-feira</option>
                                    <option value="QUI">Quinta-feira</option>
                                    <option value="SEX">Sexta-feira</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bloco-input">
                                <label class="form-label">Dia 2</label>
                                <select class="form-control" id="dia2" name="dia2">
                                    <option value="">Selecione....</option>
                                    <option value="SEG">Segunda-feira</option>
                                    <option value="TER">Terça-feira</option>
                                    <option value="QUA">Quarta-feira</option>
                                    <option value="QUI">Quinta-feira</option>
                                    <option value="SEX">Sexta-feira</option>
                                </select>
                            </div>
                        </div>

                        <div class="offset-md-1 col-md-10">
                            <button class="btn btn-dark col-md-12 btn-salvar" onclick="validarTurma();">Salvar</button>
                        </div>
                </form>

            </div>

        </div>
    </div>
    </div>
</body>

</html>