<?php
require('includes/protecao.php');
require('includes/conexao.php');

// Contagens rápidas (cards)
$total_alunos = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM alunos"))['total'] ?? 0;
$total_turmas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM turma"))['total'] ?? 0;
$total_ocorrencias = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM ocorrencia"))['total'] ?? 0;

// ========== Preparar dados do gráfico comparativo (mês atual x mês passado) ==========
// Note: tabela correta é "ocorrencia" (singular) conforme suas outras páginas.
// Ajuste aqui se a sua tabela tiver nome diferente.

$hoje = new DateTime(); // hoje
$anoAtual = (int)$hoje->format('Y');
$mesAtual = (int)$hoje->format('m');

$mesPassadoDT = (clone $hoje)->modify('-1 month');
$anoPassado = (int)$mesPassadoDT->format('Y');
$mesPassado = (int)$mesPassadoDT->format('m');

// MAPEAMENTO DE MESES EM PORTUGUÊS
$meses_pt = [
    1 => "Janeiro",
    2 => "Fevereiro",
    3 => "Março",
    4 => "Abril",
    5 => "Maio",
    6 => "Junho",
    7 => "Julho",
    8 => "Agosto",
    9 => "Setembro",
    10 => "Outubro",
    11 => "Novembro",
    12 => "Dezembro"
];

$mesAtualTexto = $meses_pt[$mesAtual] . " " . $anoAtual;
$mesPassadoTexto = $meses_pt[$mesPassado] . " " . $anoPassado;


// dias do mês atual — usamos para gerar labels (1 .. N)
$daysInCurrentMonth = cal_days_in_month(CAL_GREGORIAN, $mesAtual, $anoAtual);
$daysInPastMonth = cal_days_in_month(CAL_GREGORIAN, $mesPassado, $anoPassado);

// buscar ocorrências agrupadas por data (dia) para mês atual
$sql_atual = "
    SELECT DATE(data) as dia, COUNT(*) as total
    FROM ocorrencia
    WHERE MONTH(data) = '$mesAtual' AND YEAR(data) = '$anoAtual'
    GROUP BY DATE(data)
    ORDER BY DATE(data)
";
$res_atual = mysqli_query($conn, $sql_atual);
$dados_mes_atual = [];
while ($r = mysqli_fetch_assoc($res_atual)) {
    $dados_mes_atual[$r['dia']] = (int)$r['total'];
}

// buscar ocorrências agrupadas por data (dia) para mês passado
$sql_passado = "
    SELECT DATE(data) as dia, COUNT(*) as total
    FROM ocorrencia
    WHERE MONTH(data) = '$mesPassado' AND YEAR(data) = '$anoPassado'
    GROUP BY DATE(data)
    ORDER BY DATE(data)
";
$res_passado = mysqli_query($conn, $sql_passado);
$dados_mes_passado = [];
while ($r = mysqli_fetch_assoc($res_passado)) {
    $dados_mes_passado[$r['dia']] = (int)$r['total'];
}

// montar labels e valores alinhados por dia do mês atual (1..N)
// Para mês passado, se o mês passado tiver menos dias (ex.: fev vs mar), preenche com 0 nas posições que não existirem.
$labels = [];
$valores_atual = [];
$valores_passado = [];

for ($d = 1; $d <= $daysInCurrentMonth; $d++) {
    // label exibida no eixo (dia/mês)
    $labelDia = str_pad($d, 2, '0', STR_PAD_LEFT);
    $labels[] = $labelDia . '/' . str_pad($mesAtual, 2, '0', STR_PAD_LEFT);

    // chave data YYYY-MM-DD para buscar nos arrays
    $dataAtualKey = sprintf('%04d-%02d-%02d', $anoAtual, $mesAtual, $d);
    $valores_atual[] = $dados_mes_atual[$dataAtualKey] ?? 0;

    // dia correspondente no mês passado (se existir)
    if ($d <= $daysInPastMonth) {
        $dataPassadoKey = sprintf('%04d-%02d-%02d', $anoPassado, $mesPassado, $d);
        $valores_passado[] = $dados_mes_passado[$dataPassadoKey] ?? 0;
    } else {
        // mês passado não tem esse dia (ex.: 30/31), preenche 0
        $valores_passado[] = 0;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<?php
$titulo = "Dashboard";
include('layout/head.php');
?>
<body>
<?php include('layout/menu.php'); ?>

<div class="container mt-5">

    <!-- LOGO E TÍTULO -->
    <div class="text-center mb-4">
        <img src="assets/img/logo.png" alt="Logo" style="max-width:140px;" class="mb-3">
        <h1 class="fw-bold">Dashboard</h1>
        <p class="text-muted">Visão geral do sistema</p>
    </div>

    <!-- CARDS -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm card-home p-3">
                <div class="card-body text-center">
                    <i class="bi bi-people-fill display-4 text-primary mb-2"></i>
                    <h5>Alunos</h5>
                    <h2 class="fw-bold text-primary"><?= (int)$total_alunos ?></h2>
                    <div class="d-grid gap-2 mt-3">
                        <a href="listar-alunos.php" class="btn btn-outline-primary rounded-pill">Ver Lista</a>
                        <a href="cadastrar-aluno.php" class="btn btn-primary rounded-pill">Cadastrar Novo</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm card-home p-3">
                <div class="card-body text-center">
                    <i class="bi bi-journal-bookmark-fill display-4 text-success mb-2"></i>
                    <h5>Turmas</h5>
                    <h2 class="fw-bold text-success"><?= (int)$total_turmas ?></h2>
                    <div class="d-grid gap-2 mt-3">
                        <a href="listar-turmas.php" class="btn btn-outline-success rounded-pill">Ver Lista</a>
                        <a href="cadastrar-turma.php" class="btn btn-success rounded-pill">Cadastrar Nova</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm card-home p-3">
                <div class="card-body text-center">
                    <i class="bi bi-exclamation-circle-fill display-4 text-danger mb-2"></i>
                    <h5>Ocorrências</h5>
                    <h2 class="fw-bold text-danger"><?= (int)$total_ocorrencias ?></h2>
                    <div class="d-grid gap-2 mt-3">
                        <a href="listar-ocorrencias.php" class="btn btn-outline-danger rounded-pill">Ver Lista</a>
                        <a href="cadastrar-ocorrencia.php" class="btn btn-danger rounded-pill">Registrar Nova</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- GRÁFICO COMPARATIVO -->
    <div class="card shadow-sm p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="m-0">Comparativo: Mês Atual x Mês Passado</h4>
            <small class="text-muted">
                <?= $mesAtualTexto ?> &nbsp; vs &nbsp; <?= $mesPassadoTexto ?>
            </small>
        </div>
        <canvas id="graficoOcorrencias" height="120"></canvas>
    </div>

</div>

<!-- estilos leves -->
<style>
.card-home { border-radius: 12px; transition: transform .18s ease, box-shadow .18s ease; }
.card-home:hover { transform: translateY(-6px); box-shadow: 0 12px 28px rgba(0,0,0,.12) !important; }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const labels = <?= json_encode($labels, JSON_UNESCAPED_UNICODE); ?>;
const dadosAtual = <?= json_encode($valores_atual); ?>;
const dadosPassado = <?= json_encode($valores_passado); ?>;

const ctx = document.getElementById('graficoOcorrencias').getContext('2d');
const chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [
            {
                label: 'Mês Atual',
                data: dadosAtual,
                borderColor: '#dc3545',
                backgroundColor: 'rgba(220,53,69,0.12)',
                fill: true,
                tension: 0.35,
                borderWidth: 3,
                pointRadius: 4
            },
            {
                label: 'Mês Passado',
                data: dadosPassado,
                borderColor: '#6c757d',
                backgroundColor: 'rgba(108,117,125,0.06)',
                fill: true,
                tension: 0.35,
                borderWidth: 2,
                borderDash: [6,4],
                pointRadius: 3
            }
        ]
    },
    options: {
        responsive: true,
        interaction: { mode: 'index', intersect: false },
        plugins: {
            legend: { position: 'top' },
            tooltip: {
                callbacks: {
                    label: function(ctx) {
                        return ctx.dataset.label + ': ' + ctx.parsed.y + ' ocorrência(s)';
                    }
                }
            }
        },
        scales: {
            y: { beginAtZero: true, ticks: { precision: 0 } }
        },
        animation: { duration: 700, easing: 'easeOutQuart' }
    }
});
</script>

</body>
</html>
