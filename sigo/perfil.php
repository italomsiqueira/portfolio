<?php
require('includes/conexao.php');
include('includes/protecao.php');

$usuario_id = $_SESSION['usuario_id'];

// Pega dados do usuário usando prepared statement
$stmt = $conn->prepare("SELECT id, nome, login, nivel, foto FROM usuarios WHERE id=?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

// Foto padrão se não existir ou arquivo não existir
$usuario['foto'] = ($usuario['foto'] && file_exists($usuario['foto'])) ? $usuario['foto'] : 'assets/img/user-placeholder.png';

$msg = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Meu Perfil - SIGO</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <style>
        .card-profile {
            border-radius: 1rem;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card-profile:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #fff;
        }

        .btn-save {
            width: 100%;
        }

        .form-label i {
            margin-right: 5px;
        }

        #strengthMessage {
            font-size: 0.9rem;
        }
    </style>
    <script>
        function previewFoto(event) {
            const output = document.getElementById('fotoPreview');
            output.src = URL.createObjectURL(event.target.files[0]);
        }

        function checkSenha() {
            const senhaInput = document.getElementById('senha');
            const strengthMsg = document.getElementById('strengthMessage');
            const val = senhaInput.value;

            strengthMsg.style.fontWeight = "bold"; // negrito

            if (val.length === 0) {
                strengthMsg.textContent = '';
                strengthMsg.style.color = "";
            } else if (val.length < 6) {
                strengthMsg.textContent = 'Senha fraca';
                strengthMsg.style.setProperty('color', 'red', 'important');
            } else if (val.match(/[A-Z]/) && val.match(/\d/)) {
                strengthMsg.textContent = 'Senha forte';
                strengthMsg.style.setProperty('color', 'green', 'important');
            } else {
                strengthMsg.textContent = 'Senha média';
                strengthMsg.style.setProperty('color', 'gold', 'important'); // amarelo
            }
        }
    </script>
</head>

<body>
    <?php include('layout/menu.php'); ?>

    <div class="container mt-4">
        <h2 class="mb-4">Meu Perfil</h2>

        <?php if ($msg): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($msg) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        <?php endif; ?>

        <div class="row g-3">
            <!-- Card da foto -->
            <div class="col-md-4 mb-3">
                <div class="card card-profile shadow-sm text-center p-3">
                    <img id="fotoPreview" src="<?= htmlspecialchars($usuario['foto']) ?>" class="profile-img mb-3" alt="Foto do usuário">
                    <form action="acoes/alterar-foto.php" method="POST" enctype="multipart/form-data">
                        <input type="file" name="foto" class="form-control mb-2" accept="image/*" onchange="previewFoto(event)" required>
                        <button type="submit" class="btn btn-primary btn-save"><i class="bi bi-camera-fill"></i> Alterar Foto</button>
                    </form>
                </div>
            </div>

            <!-- Card dos dados -->
            <div class="col-md-8">
                <div class="card shadow-sm card-profile p-4">
                    <form action="acoes/alterar-perfil.php" method="POST">
                        <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-person-fill"></i> Nome</label>
                            <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-person-badge-fill"></i> Login</label>
                            <input type="text" class="form-control" value="<?= htmlspecialchars($usuario['login']) ?>" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-shield-lock-fill"></i> Nível</label>
                            <input type="text" class="form-control" value="<?= ucfirst($usuario['nivel']) ?>" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-key-fill"></i> Nova Senha</label>
                            <input type="password" name="senha" id="senha" class="form-control" placeholder="Digite a nova senha se quiser alterar" oninput="checkSenha()">
                            <div id="strengthMessage" class="text-muted"></div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success btn-save"><i class="bi bi-check-lg"></i> Salvar Alterações</button>
                            <a href="index.php" class="btn btn-secondary btn-save"><i class="bi bi-x-lg"></i> Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>