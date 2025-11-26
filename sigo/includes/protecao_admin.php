<?php
require('protecao.php');
if ($_SESSION['usuario_nivel'] !== 'admin') {
    header('Location: ../usuarios-index.php?msg=acessonegado');
    exit;
}
?>
