<?php
// Variáveis definidas na página que inclui o menu
$usuarioNome = $_SESSION['usuario_nome'] ?? 'Usuário';
$usuarioNivel = $_SESSION['usuario_nivel'] ?? 'usuario';
$usuarioFoto = $_SESSION['usuario_foto'] ?? 'assets/img/user-placeholder.png';
?>
<!-- Navbar Bootstrap 5 Premium -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container-fluid">
    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <img src="assets/img/logo-cinza-simples.png" alt="Logo" width="90" height="30">
    </a>

    <!-- Botão mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu principal + perfil -->
    <div class="collapse navbar-collapse" id="navbarMain">
      <!-- Menu principal à esquerda -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="index.php"><i class="bi bi-house-door-fill me-1"></i>Início</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-people-fill me-1"></i>Turma
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="cadastrar-turma.php"><i class="bi bi-plus-circle me-1"></i>Cadastrar turma</a></li>
            <li><a class="dropdown-item" href="listar-turmas.php"><i class="bi bi-list-ul me-1"></i>Ver turmas</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-fill me-1"></i>Aluno
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="cadastrar-aluno.php"><i class="bi bi-plus-circle me-1"></i>Cadastrar aluno</a></li>
            <li><a class="dropdown-item" href="listar-alunos.php"><i class="bi bi-list-ul me-1"></i>Ver alunos</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-exclamation-circle-fill me-1"></i>Ocorrências
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="cadastrar-ocorrencia.php"><i class="bi bi-plus-circle me-1"></i>Cadastrar ocorrência</a></li>
            <li><a class="dropdown-item" href="contagem-ocorrencias.php"><i class="bi bi-bar-chart-fill me-1"></i>Qtd ocorrência</a></li>
            <li><a class="dropdown-item" href="listar-ocorrencias.php"><i class="bi bi-list-ul me-1"></i>Ver todas</a></li>
          </ul>
        </li>

        <!-- Link para gerenciar usuários, visível apenas para administradores -->
        <?php if ($usuarioNivel === 'admin'): ?>
          <li class="nav-item">
            <a class="nav-link" href="usuarios-listar.php">
              <i class="bi bi-shield-lock-fill me-1"></i>Gerenciar Usuários
            </a>
          </li>
        <?php endif; ?>
      </ul>


      <!-- Perfil do usuário à direita -->
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="<?= $usuarioFoto ?>" class="rounded-circle me-2" width="35" height="35" alt="Foto">
            <div class="d-flex flex-column">
              <span class="fw-bold text-white"><?= $usuarioNome ?></span>
              <small class="text-light"><?= ucfirst($usuarioNivel) ?></small>
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="perfil.php"><i class="bi bi-person-circle me-1"></i>Meu perfil</a></li>
            <li><a class="dropdown-item" href="acoes/logout.php"><i class="bi bi-box-arrow-right me-1"></i>Sair</a></li>
          </ul>
        </li>
      </ul>


    </div>
  </div>
</nav>

<!-- Bootstrap 5 CSS e JS Bundle -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">