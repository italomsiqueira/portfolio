<?php
require('../includes/conexao.php');
include('../includes/protecao.php');

$usuario_id = $_SESSION['usuario_id'];

if(!isset($_FILES['foto']) || $_FILES['foto']['error'] != 0) {
    header('Location: ../perfil.php?msg=Erro ao enviar foto.');
    exit;
}

$ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
$novoNome = 'uploads/foto_'.$usuario_id.'.'.$ext;
move_uploaded_file($_FILES['foto']['tmp_name'], '../'.$novoNome);

// Atualiza no banco
$sql = "UPDATE usuarios SET foto='$novoNome' WHERE id='$usuario_id'";
mysqli_query($conn, $sql);

header('Location: ../perfil.php?msg=Foto atualizada com sucesso!');
