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
    <link rel="stylesheet" href="assets/css/cadastro.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css' />
    <script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'></script>
    <script src="assets/js/validacoes.js"></script>
    <title>Lista de turmas</title>
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
            <div class="col-md-12">

                <?php
                if (isset($_GET['msg'])) {
                    $msg = $_GET['msg'];
                    if ($msg == 'sucesso') {
                        echo "
                            <div class='alert alert-success col-md-12'>
                                <strong>Deletado com sucesso!</strong>
                            </div>
                            ";
                    } else if ($msg == 'erro') {
                        echo "
                            <div class='alert alert-danger col-md-12'>
                                <strong>Ops! Erro ao deletar!</strong>
                            </div>
                            ";
                    } else if ($msg == 'editarReserva') {
                        echo "
                            <div class='alert alert-danger col-md-12'>
                                <strong>Ops! Erro, verifique se não está tentando editar o cadastro reserva!</strong>
                            </div>
                            ";
                    } else if ($msg == 'deletarReserva') {
                        echo "
                            <div class='alert alert-danger col-md-12'>
                                <strong>Ops! Erro, verifique se não está tentando deletar o cadastro reserva!</strong>
                            </div>
                            ";
                    } else if ($msg == 'editar') {
                        echo "
                            <div class='alert alert-success col-md-12'>
                                <strong>Editado com sucesso!</strong>
                            </div>
                            ";
                    } else if ($msg == 'erroEditar') {
                        echo "
                            <div class='alert alert-danger col-md-12'>
                                <strong>Ops! Erro ao editar!</strong>
                            </div>
                            ";
                    }
                }
                ?>


                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Hora</th>
                            <th scope="col">Dia 1</th>
                            <th scope="col">Dia 2</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Excluir</th>
                            <th scope="col">Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM turma ORDER BY id ASC";
                        $result = mysqli_query($conn, $sql);
                        while ($dados = mysqli_fetch_assoc($result)) {
                            $id = $dados['id'];
                            $hora = $dados['hora'];
                            $dia1 = $dados['dia1'];
                            $dia2 = $dados['dia2'];
                            if ($id == 1) {
                                echo "
                                <script>
                                document.getElementById('btn-editar').setAttribute('disabled', true);
                                </script>
                                ";
                            }
                            $urlDelete = "acoes/deletar-turma.php?id=$id";
                            $urlUpdate = "editar-turma.php?id=$id";
                            $urlVer = "turma.php?id=$id";

                            echo "
                           <tr>
                                <td>$id</td>
                                <td>$hora</td>
                                <td>$dia1</td>
                                <td>$dia2</td>
                                <td>
                                <a href='$urlUpdate' id='editar'>
                                
                                    <button class='btn btn-info btn-sm btn-editar' id='btn-editar'>Editar</button>
                                    <script>
                                    if($id == 1){
                                    document.getElementById('btn-editar').disabled = true;
                                    }
                                    </script>                                    
                                </a></td>
                                <td>
                                <a href='$urlDelete'>
                                <button class='btn btn-danger btn-sm btn-deletar'>Deletar</button>
                                </a>
                                </td>

                                <td>
                                <a href='$urlVer'>
                                <button class='btn btn-success btn-sm btn-ver'>Ver turma</button>
                                </a>
                                </td>
                           </tr>
                           ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>