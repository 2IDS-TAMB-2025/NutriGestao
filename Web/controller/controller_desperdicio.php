<?php
require_once '../model/model_desperdicio.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$desperdicio = new Desperdicio();
$dataFiltro = $_GET['data'] ?? null;

// Datas semanais
$hoje = new DateTime($dataFiltro ?? 'now');
$inicioSemana = clone $hoje;
$inicioSemana->modify('monday this week');
$fimSemana = clone $hoje;
$fimSemana->modify('sunday this week');

// Dados de desperdício
$dados_diario = $desperdicio->dadosDesperdiciosDiario($hoje->format('Y-m-d'));
$dados_semanais = $desperdicio->dadosDesperdiciosSemanais($inicioSemana->format('Y-m-d'), $fimSemana->format('Y-m-d'));
$dados_mensais = $desperdicio->dadosDesperdiciosMensais($hoje->format('m'), $hoje->format('Y'));

// Buscar dados para a tabela (histórico)
$dados = $desperdicio->buscarDadosParaTabela($dataFiltro);
?>