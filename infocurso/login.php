<?php
require ('includes/conexao.php');
?>

<html>

<head>

    <script src="assets/js/validacoes.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/login.css">
    <script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'></script>
    <title> Login de Usuário </title>
</head>

<body>



    <div class="container-fluid">
        <div class="row">
            <div class="offset-md-3 col-md-6 bloco-login">
                <div class="row">
                    <div class="col-md-6 bloco-info">
                        <center>
                            <img src="assets/img/logo-cinza.png" class="logo" min-width="100%">

                            <div class="col-md-10">
                                <h4>Sistema para gerenciamento de cursos</h4>
                            </div>

                        </center>
                    </div>

                    <div class="col-md-6 bloco-form">


                        <form id="form-login" onsubmit="return false" method="POST" action="acoes/login.php">


                            <div class="login">

                                <div class="alert alert-danger col-md-12" id="erro" hidden> </div>
                                <?php

                                if (isset($_GET['msg'])) {
                                    $msg = $_GET['msg'];
                                    if ($msg == 'sucesso') {
                                        echo "
                                        <div class='alert alert-success col-md-12'>
                                            <strong>Logado com sucesso! Aguarde</strong>
                                        </div>
                                        ";
                                        header('Location: ../infocurso/index.php');
                                    } else if ($msg == 'errologin') {
                                        echo "
                                        <div class='alert alert-danger col-md-12'>
                                            <strong>Usuário incorreto!</strong>
                                        </div>
                                        ";
                                    } else if ($msg == 'errosenha') {
                                        echo "
                                        <div class='alert alert-danger col-md-12'>
                                            <strong>Senha incorreta!</strong>
                                        </div>
                                        ";
                                    } else {
                                        echo "
                                        <div class='alert alert-danger col-md-12'>
                                            <strong>ERRO!</strong>
                                        </div>
                                        ";
                                    }
                                }
                                ?>

                                <div class="offset-md-1 col-md-10 bloco-input">
                                    <label class="form-label">Login:</label>
                                    <input type="text" class="form-control" name="login" id="login">
                                </div>

                                <div class="offset-md-1 col-md-10 bloco-input">
                                    <label class="form-label">Senha:</label>
                                    <input type="password" class="form-control" name="senha" id="senha">
                                </div>

                                <div class="offset-md-1 col-md-10">
                                    <a href="principal.html">
                                        <button class="btn btn-success col-md-12 btn-salvar"
                                            onclick="validarLogin();">Entrar no sistema</button>
                                    </a>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




</body>

</html>