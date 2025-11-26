<?php
require('includes/protecao.php');
require('includes/conexao.php');

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=ocorrencias.xls");

$alunoFiltro = isset($_GET['aluno']) ? intval($_GET['aluno']) : '';
$dataInicio = isset($_GET['data_inicio']) ? $_GET['data_inicio'] : '';
$dataFim = isset($_GET['data_fim']) ? $_GET['data_fim'] : '';

$where = [];
if ($alunoFiltro) $where[] = "oa.alunos_id = $alunoFiltro";
if ($dataInicio) $where[] = "o.data >= '$dataInicio'";
if ($dataFim) $where[] = "o.data <= '$dataFim'";
$whereSql = $where ? 'WHERE ' . implode(' AND ', $where) : '';

$sql = "
    SELECT 
        o.id AS ocorrencia_id, 
        o.descricao, 
        o.data,
        GROUP_CONCAT(a.nome SEPARATOR ', ') AS alunos
    FROM ocorrencia o
    LEFT JOIN ocorrencia_aluno oa ON oa.ocorrencia_id = o.id
    LEFT JOIN alunos a ON a.id = oa.alunos_id
    $whereSql
    GROUP BY o.id, o.descricao, o.data
    ORDER BY o.id DESC
";

$res = mysqli_query($conn, $sql);

echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Data</th>
            <th>Descrição</th>
            <th>Alunos</th>
        </tr>";

while ($row = mysqli_fetch_assoc($res)) {
    $data = !empty($row['data']) ? date('d/m/Y', strtotime($row['data'])) : '-';
    echo "<tr>
            <td>{$row['ocorrencia_id']}</td>
            <td>$data</td>
            <td>{$row['descricao']}</td>
            <td>{$row['alunos']}</td>
          </tr>";
}

echo "</table>";
