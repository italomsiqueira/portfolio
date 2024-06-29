<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with JohnDoe landing page.">
    <meta name="author" content="Devcrud">
    <title>Italo Siqueira</title>
    <!--FavIcon-->
    <link href="assets/imgs/favicon.png" rel="icon">
    <!-- font icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">
    <!-- Bootstrap + JohnDoe main styles -->
    <link rel="stylesheet" href="assets/css/johndoe.css">
    <!-- Italo styles -->
    <link rel="stylesheet" href="assets/css/italo.css">
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-white" data-spy="affix" data-offset-top="510">
        <div class="container">
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse mt-sm-20 navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="#home" class="nav-link">Demo</a>
                    </li>

                </ul>
                <ul class="navbar-nav brand">

                    <li class="brand">
                        <h5 class="brand-title">Italo Siqueira</h5>
                        <div class="brand-subtitle">Programador Junior</div>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item last-item">
                        <a href="index.html" class="nav-link">Voltar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--CORPO DO SITE-->
    <div>
        <!--CÓDIGO PHP-->
        <?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            if ($msg == 'infocurso') {
                echo "
                <div>
                <iframe class='iframeprojetos' src='https://mfe.ffit.com.br/console/prototype/59426e9f-a484-465b-acd8-658fe3bfc7b3/preview'>
                    <p>Seu navegador não suporta iframes.</p>
                  </iframe>
                </div>
                    ";
            } elseif ($msg == 'quiz') {
                echo "
                <div>
                <iframe class='iframeprojetos' src='quizwindows.c'>
                    <p>Seu navegador não suporta iframes.</p>
                  </iframe>
                </div>
                    ";


            }
        }

        #echo "
        #<div class='alert alert-danger col-md-12'>
        #    <strong>Ops! Projeto não encontrado.</strong>
        #</div>
        #";
        
        ?>


    </div>



    <footer class="footer py-3">
        <div class="container">
            <p class="small mb-0 text-light">
                &copy;
                <script>document.write(new Date().getFullYear())</script> ITL Promotor de Vendas
            </p>
        </div>
    </footer>

    <!-- core  -->
    <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>

    <!-- bootstrap 3 affix -->
    <script src="assets/vendors/bootstrap/bootstrap.affix.js"></script>

    <!-- Isotope  -->
    <script src="assets/vendors/isotope/isotope.pkgd.js"></script>

    <!-- Google mpas -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtme10pzgKSPeJVJrG1O3tjR6lk98o4w8&callback=initMap"></script>

    <!-- JohnDoe js -->
    <script src="assets/js/johndoe.js"></script>

    <!-- Enviar emails -->
    <script src="assets/js/form-submit.js"></script>

    <!-- Iframe -->
    <script>
        var iframe = window.getElementsByTagName("iframe")[0];
        alert("Frame title: " + iframe.contentWindow.title);
    </script>

</body>

</html>