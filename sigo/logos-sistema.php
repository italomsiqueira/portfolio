<?php
require('includes/protecao.php');

// 🔒 BLOQUEIO DE ACESSO
if (!isset($_SESSION['usuario_login']) || $_SESSION['usuario_login'] !== 'italo') {
    header('Location: index.php');
    exit;
}

$titulo = "Logos do Sistema";
include('layout/head.php');
include('layout/menu.php');
?>

<div class="container mt-4">

    <div class="card shadow-lg border-0">
        <div class="card-body p-4">

            <h4 class="mb-4">
                <i class="bi bi-image me-2"></i>Logos do Sistema
            </h4>

            <div class="row g-4">

                <div class="row g-4">

                    <?php
                    $logos = [
                        ['arquivo' => 'logo.png', 'nome' => 'Logo Principal'],
                        ['arquivo' => 'logo-cinza.png', 'nome' => 'Logo Cinza'],
                        ['arquivo' => 'logo-cinza-simples.png', 'nome' => 'Logo Cinza Simples'],
                        ['arquivo' => 'favicon.png', 'nome' => 'Favicon PNG'],
                        ['arquivo' => 'italo-a4.jpg', 'nome' => 'Italo Retangular em pé'],
                        ['arquivo' => 'italo-quadrado.jpg', 'nome' => 'Italo Quadrado'],
                        ['arquivo' => 'favicon.ico', 'nome' => 'Favicon ICO']
                    ];

                    foreach ($logos as $logo):
                        ?>

                        <div class="col-md-4">
                            <div class="card border-0 shadow text-center p-3 h-70">

                                <img src="assets/img/<?= $logo['arquivo'] ?>" class="mb-3"
                                    style="max-height:120px; width:auto; object-fit:contain;">

                                <h6 class="fw-bold"><?= $logo['nome'] ?></h6>

                                <a href="acoes/download-logo.php?file=<?= $logo['arquivo'] ?>" class="btn btn-success mt-2">
                                    <i class="bi bi-download"></i> Baixar
                                </a>

                            </div>
                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

        </div>
    </div>

</div>