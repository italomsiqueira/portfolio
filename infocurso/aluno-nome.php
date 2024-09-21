<?php
require('includes/conexao.php');
$nomeBusca = strtoupper($_GET['nomeBusca']);
$sqlTurma = "SELECT * FROM alunos WHERE nome LIKE '$nomeBusca%'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/cadastro.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css' />
    <script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'></script>

    <title>Lista de alunos por nome</title>
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
    <div class="container">
        <div class="row">
            <div class="col-md-12 turma">


                <?php
                if (isset($_GET['msg'])) {
                    $msg = $_GET['msg'];
                    if ($msg == 'sucesso') {
                        echo "
                            <div class='alert alert-success col-md-12'>
                                <strong>Deletado com sucesso!</strong>
                            </div>
                            ";
                    } else {
                        echo "
                            <div class='alert alert-danger col-md-12'>
                                <strong>Ops! Erro ao deletar!</strong>
                            </div>
                            ";
                    }
                }
                ?>


                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">RG</th>
                            <th scope="col">CPF</th>
                            <th scope="col">ENDEREÇO</th>
                            <th scope="col">TELEFONE</th>
                            <th scope="col">TURMA</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = mysqli_query($conn, $sqlTurma);
                        while ($dados = mysqli_fetch_assoc($result)) {
                            $id = $dados['id'];
                            $nome = $dados['nome'];
                            $rg = $dados['rg'];
                            $cpf = $dados['cpf'];
                            $endereco = $dados['endereco'];
                            $tel = $dados['tel'];
                            $turma = $dados['turma'];
                            $turma_sql = "SELECT * FROM turma WHERE id = $turma";
                            $result_turma = mysqli_query($conn, $turma_sql);
                            $result_turma2 = mysqli_fetch_assoc($result_turma);
                            $turma_final = $result_turma2['hora'] . "-" . $result_turma2['dia1'] . "-" . $result_turma2['dia2'];
                            $urlDelete = "acoes/deletar-aluno.php?id=$id";
                            $urlUpdate = "editar-aluno.php?id=$id";
                            echo "
                           <tr>
                                <td>$id</td>
                                <td>$nome</td>
                                <td>$rg</td>
                                <td>$cpf</td>
                                <td>$endereco</td>
                                <td>$tel</td>
                                <td>$turma_final</td>
                                <td>
                                <a href='$urlUpdate'>
                                    <button class='btn btn-info btn-sm'>Editar</button>
                                </a></td>
                                <td>
                                <a href='$urlDelete'>
                                <button class='btn btn-danger btn-sm'>Deletar</button>
                                </a>
                                </td>
                           </tr>
                           ";
                        }

                        ?>
                    </tbody>
                </table>

                <a href="listar-alunos.php">
                    <button class='offset-md-4 col-md-4 btn btn-success btn-sm'>Voltar</button>
                </a>

            </div>
        </div>
    </div>
</body>

</html>